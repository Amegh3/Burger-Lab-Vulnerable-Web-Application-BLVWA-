import json

vulns = []
lab_types = ["rce", "sqli", "xss", "lfi", "idor", "jwt"]

for i in range(1, 106):
    ltype = lab_types[i % len(lab_types)]
    vid = f"V-{i:03d}"
    
    if ltype == "rce":
        name = f"RCE Impact — Command Exec Lab #{i}"
        url = f"/lab/rce/{vid}?cmd=id"
        payload = "uid="
    elif ltype == "sqli":
        name = f"SQLi Impact — Data Leak Lab #{i}"
        url = f"/lab/sqli/{vid}?uid=1' OR '1'='1"
        payload = "admin"
    elif ltype == "xss":
        name = f"XSS Impact — Script Injection Lab #{i}"
        url = f"/lab/xss/{vid}?p=<script>alert('EXPLOIT-{i}')</script>"
        payload = f"EXPLOIT-{i}"
    elif ltype == "lfi":
        name = f"LFI Impact — File Disclosure Lab #{i}"
        url = f"/lab/lfi/{vid}?file=/etc/passwd"
        payload = "root:x:"
    elif ltype == "idor":
        name = f"IDOR Impact — Private Data Lab #{i}"
        url = f"/lab/idor/{vid}?target=1"
        payload = "admin@burgerlabs.htb"
    elif ltype == "jwt":
        name = f"JWT Impact — Auth Bypass Lab #{i}"
        url = f"/lab/jwt/{vid}"
        # Payload is a base64 encoded JSON mimicking the vulnerable Auth.php logic
        payload = "eyJpZCI6IDEsICJyb2xlIjogImFkbWluIn0=" # {"id": 1, "role": "admin"}
    
    vulns.append({
        "id": vid,
        "name": name,
        "category": ltype.upper(),
        "severity": "Critical" if ltype in ["rce", "sqli", "jwt"] else "High",
        "url": url,
        "payload": payload,
        "detect": {"type": "body_contains", "value": "Admin Panel" if ltype == "jwt" else payload},
        "auth_required": False,
        "screenshot": True
    })

with open('scanner/vulns.json', 'w') as f:
    json.dump(vulns, f, indent=2)

print(f"Generated {len(vulns)} high-impact vulnerabilities.")
