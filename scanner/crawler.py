#!/usr/bin/env python3
"""
BLVWA Crawler — Discovers all routes, forms, and endpoints.
"""

import asyncio
import json
import re
from datetime import datetime
from pathlib import Path
from urllib.parse import urljoin, urlparse

import httpx
from bs4 import BeautifulSoup
from rich.console import Console
from rich.table import Table

from config import TARGET_URL, CREDENTIALS, REQUEST_TIMEOUT

console = Console()


class BLVWACrawler:
    def __init__(self, base_url: str):
        self.base_url = base_url.rstrip("/")
        self.visited = set()
        self.forms = []
        self.api_endpoints = []
        self.links = set()
        self.js_endpoints = []
        self.params_found = {}
        self.cookies = {}

    async def authenticate(self, client: httpx.AsyncClient):
        """Login to get session cookies."""
        resp = await client.post(
            f"{self.base_url}/login",
            data=CREDENTIALS["guest"],
            follow_redirects=True,
            timeout=REQUEST_TIMEOUT,
        )
        self.cookies = dict(client.cookies)
        self.cookies.update(dict(resp.cookies))
        console.print(f"[green]✓ Authenticated ({len(self.cookies)} cookies)[/green]")

    async def crawl_page(self, client: httpx.AsyncClient, url: str, depth: int = 0):
        """Crawl a single page and extract links, forms, and endpoints."""
        if depth > 3 or url in self.visited:
            return
        self.visited.add(url)

        try:
            resp = await client.get(url, cookies=self.cookies, follow_redirects=True, timeout=REQUEST_TIMEOUT)
            if resp.status_code != 200:
                return

            soup = BeautifulSoup(resp.text, "html.parser")

            # Extract links
            for a in soup.find_all("a", href=True):
                href = a["href"]
                full_url = urljoin(url, href)
                parsed = urlparse(full_url)
                if parsed.netloc == urlparse(self.base_url).netloc:
                    clean_url = f"{parsed.scheme}://{parsed.netloc}{parsed.path}"
                    if clean_url not in self.visited:
                        self.links.add(clean_url)
                    # Track params
                    if parsed.query:
                        self.params_found[parsed.path] = parsed.query

            # Extract forms
            for form in soup.find_all("form"):
                action = form.get("action", "")
                method = form.get("method", "GET").upper()
                inputs = []
                for inp in form.find_all(["input", "textarea", "select"]):
                    inputs.append({
                        "name": inp.get("name", ""),
                        "type": inp.get("type", "text"),
                        "value": inp.get("value", ""),
                    })
                self.forms.append({
                    "page": url.replace(self.base_url, ""),
                    "action": action,
                    "method": method,
                    "inputs": inputs,
                })

            # Extract JS endpoints from inline scripts
            for script in soup.find_all("script"):
                if script.string:
                    # Find fetch/ajax URLs
                    urls_in_js = re.findall(r"""(?:fetch|axios|get|post)\s*\(\s*['"]([^'"]+)['"]""", script.string)
                    for ep in urls_in_js:
                        if ep.startswith("/"):
                            self.js_endpoints.append(ep)

            # Recurse into discovered links
            for link in list(self.links):
                if link not in self.visited:
                    await self.crawl_page(client, link, depth + 1)

        except Exception as e:
            pass

    async def discover_api_endpoints(self, client: httpx.AsyncClient):
        """Probe known API patterns."""
        api_paths = [
            "/api/v1/wallet/balance",
            "/api/v1/wallet/balance?uid=1",
            "/api/v1/coupons/validate",
            "/api/v1/users/1",
            "/api/cart/validate",
            "/api/checkout/price-quote",
            "/api/checkout/create-order",
            "/api/orders/track",
            "/api/orders/1",
            "/api/payments/intent",
        ]
        for path in api_paths:
            try:
                resp = await client.get(
                    f"{self.base_url}{path}",
                    cookies=self.cookies,
                    timeout=REQUEST_TIMEOUT,
                )
                if resp.status_code != 404:
                    self.api_endpoints.append({
                        "path": path,
                        "status": resp.status_code,
                        "content_type": resp.headers.get("content-type", ""),
                    })
            except:
                pass

    async def run(self):
        """Execute the full crawl."""
        console.rule("[bold red]BLVWA Crawler[/bold red]")
        console.print(f"[cyan]Target:[/cyan] {self.base_url}\n")

        async with httpx.AsyncClient(verify=False) as client:
            await self.authenticate(client)

            # Seed URLs
            seed_urls = [
                "/", "/menu", "/track", "/search", "/help", "/careers",
                "/booking", "/franchise", "/contact", "/reviews",
                "/wallet", "/coupons", "/profile", "/notifications",
                "/ai-insights", "/cart", "/admin_p0rtal_secret_path",
                "/admin/diagnostics", "/admin/users", "/admin/logs",
                "/admin/export", "/admin/backup", "/admin/analytics",
                "/staff/dashboard", "/staff/inventory", "/staff/refunds",
                "/login", "/register",
                "/privacy", "/refund-policy", "/legal-disclaimer", "/faq",
            ]

            console.print("[yellow]Crawling pages...[/yellow]")
            for path in seed_urls:
                url = f"{self.base_url}{path}"
                await self.crawl_page(client, url)

            console.print("[yellow]Probing API endpoints...[/yellow]")
            await self.discover_api_endpoints(client)

        self.print_results()
        self.save_results()

    def print_results(self):
        """Print crawl results."""
        console.print(f"\n[green]Pages discovered: {len(self.visited)}[/green]")
        console.print(f"[green]Forms found: {len(self.forms)}[/green]")
        console.print(f"[green]API endpoints: {len(self.api_endpoints)}[/green]")
        console.print(f"[green]JS endpoints: {len(self.js_endpoints)}[/green]")
        console.print(f"[green]Parameters: {len(self.params_found)}[/green]")

        # Forms table
        if self.forms:
            table = Table(title="Discovered Forms")
            table.add_column("Page")
            table.add_column("Action")
            table.add_column("Method")
            table.add_column("Fields")
            for form in self.forms:
                fields = ", ".join(i["name"] for i in form["inputs"] if i["name"])
                table.add_row(form["page"][:40], form["action"][:30], form["method"], fields[:50])
            console.print(table)

        # API table
        if self.api_endpoints:
            table = Table(title="API Endpoints")
            table.add_column("Path")
            table.add_column("Status")
            table.add_column("Content-Type")
            for ep in self.api_endpoints:
                table.add_row(ep["path"], str(ep["status"]), ep["content_type"][:40])
            console.print(table)

    def save_results(self):
        """Save crawl results to JSON."""
        output = {
            "target": self.base_url,
            "timestamp": datetime.now().isoformat(),
            "pages": sorted(list(self.visited)),
            "forms": self.forms,
            "api_endpoints": self.api_endpoints,
            "js_endpoints": self.js_endpoints,
            "parameters": self.params_found,
        }
        out_path = Path(__file__).parent / "evidence" / "crawl_results.json"
        with open(out_path, "w") as f:
            json.dump(output, f, indent=2)
        console.print(f"\n[green]📄 Crawl results saved: {out_path}[/green]")


if __name__ == "__main__":
    crawler = BLVWACrawler(TARGET_URL)
    asyncio.run(crawler.run())
