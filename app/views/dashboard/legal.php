<!-- app/views/dashboard/legal.php -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Outfit:wght@800&family=Inter:wght@400;600;700&display=swap');

    .lab-root {
        background-color: #ffffff;
        color: #1e293b;
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        min-height: 100vh;
    }

    .lab-grid-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
        background-size: 32px 32px;
        z-index: 0;
        pointer-events: none;
        opacity: 0.5;
    }

    .lab-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 100px 40px;
        position: relative;
        z-index: 1;
    }

    .lab-header {
        border-left: 8px solid #E63946;
        padding-left: 40px;
        margin-bottom: 80px;
    }

    .lab-header h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 4.5rem;
        color: #0f172a;
        letter-spacing: -3px;
        margin: 0;
        line-height: 1.1;
    }

    .lab-header .sub-header {
        font-family: 'Inter', sans-serif;
        color: #E63946;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        display: block;
        margin-bottom: 15px;
    }

    .action-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #0f172a;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        background: #f1f5f9;
        padding: 12px 24px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .action-link:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
    }

    .research-panel {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 2px;
        padding: 50px;
        margin-bottom: 60px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
    }

    .panel-tag {
        font-family: 'Inter', sans-serif;
        background: #f1f5f9;
        color: #475569;
        padding: 4px 12px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 25px;
        display: inline-block;
    }

    .category-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        color: #0f172a;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 15px;
    }

    .category-title span {
        color: #E63946;
        font-weight: 300;
    }

    .vuln-grid-v3 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .vuln-item-v3 {
        background: #fff;
        border: 1px solid #f1f5f9;
        padding: 14px 20px;
        font-family: 'Space Mono', monospace;
        font-size: 0.85rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.2s ease;
    }

    .vuln-item-v3:hover {
        background: #fdfdfd;
        border-color: #E63946;
        color: #0f172a;
        transform: scale(1.01);
    }

    .vuln-item-v3 .id {
        color: #E63946;
        font-weight: 700;
    }

    .severity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #e2e8f0;
    }

    .vuln-item-v3:hover .severity-dot {
        background: #E63946;
    }

    .solutions-area-v3 {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 60px;
        text-align: center;
        margin-top: 100px;
    }

    .solutions-area-v3 h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem;
        color: #0f172a;
        margin-bottom: 15px;
    }

    .solutions-area-v3 .email-cta {
        font-family: 'Space Mono', monospace;
        font-size: 1.8rem;
        color: #E63946;
        font-weight: 700;
        text-decoration: none;
        display: block;
        margin-top: 20px;
    }

    .legal-footer-v3 {
        text-align: center;
        padding-top: 80px;
        color: #94a3b8;
        font-size: 0.85rem;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.8;
    }
</style>

<div class="lab-root">
    <div class="lab-grid-bg"></div>

    <div class="lab-container">
        <header class="lab-header"
            style="border-left: none; padding-left: 0; margin-bottom: 100px; text-align: center;">
            <h1
                style="font-family: 'Outfit', sans-serif; font-size: 5rem; line-height: 0.95; color: #0f172a; margin-bottom: 30px;">
                Burger Labs <br>
                <span
                    style="background: linear-gradient(90deg, #E63946, #D62828); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Legal
                    Disclaimer</span>
            </h1>

            <p
                style="color: #64748b; font-size: 1.35rem; max-width: 850px; margin: 0 auto 40px; font-weight: 400; line-height: 1.6;">
                Welcome to <strong style="color: #0f172a;">Burger Labs</strong>, a production-grade, high-fidelity
                e-commerce platform designed exclusively for <strong style="color: #0f172a;">Cybersecurity Research and
                    Penetration Testing</strong>. This platform contains <span
                    style="color: #E63946; font-weight: 800;">100+ intentional vulnerabilities</span> scattered across
                its molecularly-inspired architecture.
            </p>

            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="https://www.linkedin.com/in/ameghayiratt/" target="_blank" class="action-link"
                    style="background: #0f172a; color: white; padding: 14px 28px; border-radius: 12px; display: flex; align-items: center; gap: 10px; font-weight: 600; transition: 0.3s; box-shadow: 0 10px 20px rgba(15, 23, 42, 0.1);">
                    <i class="fab fa-linkedin" style="font-size: 1.2rem;"></i> LinkedIn
                </a>
                <a href="mailto:ttariyahgema@gmail.com" class="action-link"
                    style="background: white; border: 1px solid #e2e8f0; color: #0f172a; padding: 14px 28px; border-radius: 12px; display: flex; align-items: center; gap: 10px; font-weight: 600; transition: 0.3s;">
                    <i class="fa fa-envelope" style="color: #E63946;"></i> Email Support
                </a>
            </div>
        </header>

        <!-- Mission -->
        <div class="research-panel"
            style="border: none; background: #ffffff; box-shadow: 0 40px 100px rgba(0,0,0,0.04); border-radius: 32px; padding: 60px; position: relative; overflow: hidden;">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #E63946, transparent);">
            </div>
            <h2
                style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: #0f172a; margin-bottom: 25px; letter-spacing: -1px;">
                Mission</h2>
            <p style="font-size: 1.2rem; color: #475569; line-height: 1.8; max-width: 900px;">
                Burger Labs is built for security testing to provide a realistic, professional target for students and
                security professionals. It simulates a modern web application with a complex multi-step checkout,
                persistent wallet system, and interactive dashboard, while maintaining deep-seated security flaws.
            </p>
        </div>

        <!-- Inventory -->
        <div class="inventory-section">
            <div style="text-align: center; margin-bottom: 60px;">
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: #0f172a;">vulnerabilities</h2>
                <p style="color: #94a3b8;">100+ Security Flaws</p>
            </div>

            <!-- Cat 1 -->
            <div style="margin-bottom: 60px;">
                <div class="category-title"><span>01</span> Injection & Scripting</div>
                <div class="vuln-grid-v3">
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">01</span> SQL Injection: Authentication Bypass
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">02</span> SQL Injection: UNION-based
                        Exfiltration
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">03</span> SQL Injection: Boolean-blind
                        Exploitation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">04</span> Stored XSS: Victim-side execution
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">05</span> Reflected XSS: Parameter Reflection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">06</span> Parameter Injection: Hidden Totals
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">07</span> NoSQL-style Injection Bypass
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">08</span> SMTP Header Injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">09</span> HTML Injection in Customer Reviews
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">10</span> OS Command Injection: RCE
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">11</span> Log Injection: Entry Forgery
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">12</span> CSV Injection in Exports
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">13</span> Attribute Injection: Roles
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">14</span> Client-side Template Injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">15</span> CRLF Injection: Header Injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">16</span> LDAP Injection (Simulated)
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">17</span> XPath Injection in XML Catalog
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">18</span> GraphQL Injection: Introspection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">19</span> SSI Injection (Server-Side)
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">20</span> Host Header Injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">21</span> SQLi: Time-based blind
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">22</span> XSS: Event handler injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">23</span> XSS: URI-based (javascript:)
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">24</span> SQLi: Order-by manipulation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">25</span> SQLi: Limit-offset manipulation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">26</span> SQLi: Insert-based injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">27</span> XSS: Document.referrer reflection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">28</span> XSS: Hash-based reflection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">29</span> SQLi: Second-order injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">30</span> XSS: CSS-based injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">31</span> SQLi: Group-by manipulation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">32</span> NoSQL: Array-based login bypass
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">33</span> XSS: Meta-tag injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">34</span> Email Injection: CC/BCC field
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">35</span> SQLi: Truncation-based attack
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">36</span> XSS: Polyglot payload
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">37</span> XSS: SVG-based (onload)
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">38</span> XSS: Mouseover injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">39</span> SQLi: Update-based injection
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">40</span> XSS: Print-dialog trigger
                    </div>
                </div>
            </div>

            <!-- Cat 2 -->
            <div style="margin-bottom: 60px;">
                <div class="category-title"><span>02</span> Access Control & IDOR</div>
                <div class="vuln-grid-v3">
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">41</span> IDOR: History Access
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">42</span> IDOR: Profile Mod
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">43</span> Broken Access: Administrative Portal
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">44</span> Directory Traversal (LFI)
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">45</span> Unrestricted PHP Upload (RCE)
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">46</span> Mass Assignment Privilege Elevation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">47</span> IDOR: Session/Cart Takeover
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">48</span> Forced Browsing: Rewards
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">49</span> BOLA on User Statistics
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">50</span> LFI in Page Parameter
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">51</span> IDOR: Account Deletion
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">52</span> IDOR: Cart Clearing
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">53</span> Horizontal Privilege Escalation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">54</span> Vertical Privilege Escalation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">55</span> Session Fixation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">56</span> Broken Function Authorization
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">57</span> Log Data Information Disclosure
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">58</span> IDOR: Private Ticket Access
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">59</span> IDOR: Wallet ID Modification
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">60</span> Improper Asset Management
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">61</span> RFI via External Proxy
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">62</span> Server Information Disclosure
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">63</span> Remember-Me Cookie Bypass
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">64</span> Excessive Data Exposure in API
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">65</span> IDOR: Delivery Hijack
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">66</span> WAF Bypass via Headers
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">67</span> IDOR: Complaint Resolution
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">68</span> Property Level Authorization
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">69</span> IDOR: Hidden KYC Data Access
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">70</span> Internal Server Log Access
                    </div>
                </div>
            </div>

            <!-- Cat 3 -->
            <div style="margin-bottom: 60px;">
                <div class="category-title"><span>03</span> Business Logic & Flow</div>
                <div class="vuln-grid-v3">
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">71</span> Price Tampering via GET Parameter
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">72</span> Negative Price Inflation Attack
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">73</span> Logical Flaw: Coupon Reuse
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">74</span> Inventory Oversell Race Condition
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">75</span> Double Refund Exploit
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">76</span> Table Conflict DoS Logic
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">77</span> Floating Point Rounding Error
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">78</span> Brute-forceable Promo Codes
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">79</span> Wallet Transfer Validation Bypass
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">80</span> Lockout Bypass via IP Rotation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">81</span> Self-referral Point Loop
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">82</span> Checkout Workflow Step Skip
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">83</span> Item Duplication via API Logic
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">84</span> Guest Booking Logic Bypass
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">85</span> Weak Password Policy Failure
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">86</span> Coupon Stacking Logic Flaw
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">87</span> Negative Transfer Balance Theft
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">88</span> Empty Address Validation Bypass
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">89</span> Pricing Update Race Condition
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">90</span> Verification-less Account Change
                    </div>
                </div>
            </div>

            <!-- Cat 4 -->
            <div>
                <div class="category-title"><span>04</span> Cryptography & Config</div>
                <div class="vuln-grid-v3">
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">91</span> Weak MD5 Hashing without Salt
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">92</span> Predictable Sequential Token IDs
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">93</span> Hardcoded Database Credentials
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">94</span> Missing Security Headers
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">95</span> Production Stack Trace Exposure
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">96</span> Insecure Wildcard CORS Policy
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">97</span> Environment Variable Disclosure
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">98</span> Missing Cookie Security Flags
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">99</span> Cache Poisoning via Unkeyed Headers
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">100</span> Lack of Rate Limiting (Brute-force)
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">101</span> XXE Injection: Franchise Portal
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">102</span> Insecure SSL/TLS Renegotiation
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">103</span> Use of Vulnerable JS Dependencies
                    </div>
                    <div class="vuln-item-v3">
                        <div class="severity-dot"></div> <span class="id">104</span> Broken Object Level Authorization
                    </div>

                </div>
            </div>
        </div>

        <!-- Solutions -->
        <div class="solutions-area-v3" style="border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.03);">
            <h3 style="letter-spacing: -1px;">Get the Walkthrough</h3>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 700px; margin: 0 auto 20px;">
                Technical documentation detailing the exploitation and remediation of all 100+ flaws is available upon
                request.
            </p>
            <p style="color: #0f172a; font-weight: 700; font-size: 0.95rem; margin-bottom: 5px;">Mail to this email ID
                for the Walkthrough</p>
            <a href="mailto:ttariyahgema@gmail.com" class="email-cta"
                style="font-size: 2.2rem; transition: 0.3s; display: inline-block;">ttariyahgema@gmail.com</a>
        </div>

        <p class="legal-footer-v3">
            Burger Labs is not an original brand, restaurant, or registered company. It is a strictly fictional entity
            created for cybersecurity training. Do not use this platform for actual financial transactions or store
            real-world sensitive data.
        </p>

    </div>
</div>