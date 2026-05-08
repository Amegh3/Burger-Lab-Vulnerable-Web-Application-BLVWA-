#!/usr/bin/env python3
"""
BLVWA Scanner — Main Entry Point
==================================
Usage:
  python scanner/run.py crawl        — Crawl the application
  python scanner/run.py scan         — Run vulnerability scan
  python scanner/run.py chains       — Run attack chain validation
  python scanner/run.py screenshots  — Capture exploit screenshots
  python scanner/run.py full         — Run everything
"""

import sys
import os
import asyncio

# Add scanner dir to path
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))


def main():
    if len(sys.argv) < 2:
        print(__doc__)
        sys.exit(1)

    command = sys.argv[1].lower()

    if command == "crawl":
        from crawler import BLVWACrawler
        from config import TARGET_URL
        crawler = BLVWACrawler(TARGET_URL)
        asyncio.run(crawler.run())

    elif command == "scan":
        from engine import run_scan
        asyncio.run(run_scan())

    elif command == "chains":
        from chains import run_all_chains
        asyncio.run(run_all_chains())

    elif command == "screenshots":
        from screenshots import capture_vuln_evidence
        asyncio.run(capture_vuln_evidence())

    elif command == "full":
        print("═" * 60)
        print("  BLVWA FULL SCAN — Crawl + Scan + Chains + Screenshots")
        print("═" * 60 + "\n")

        from crawler import BLVWACrawler
        from config import TARGET_URL
        from engine import run_scan
        from chains import run_all_chains

        async def run_all():
            # 1. Crawl
            crawler = BLVWACrawler(TARGET_URL)
            await crawler.run()

            # 2. Scan
            results = await run_scan()

            # 3. Attack chains
            chain_results = await run_all_chains()

            # 4. Screenshots (optional — needs playwright)
            try:
                from screenshots import capture_vuln_evidence
                await capture_vuln_evidence()
            except Exception as e:
                print(f"\n⚠️ Screenshot capture skipped: {e}")

            print("\n" + "═" * 60)
            print("  FULL SCAN COMPLETE")
            print("═" * 60)

        asyncio.run(run_all())

    else:
        print(f"Unknown command: {command}")
        print(__doc__)
        sys.exit(1)


if __name__ == "__main__":
    main()
