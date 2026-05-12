<?php
/**
 * Simulated WordPress Login Portal
 * Vulnerable to Brute Force and Username Enumeration
 */
if (isset($_POST['log'])) {
    $user = $_POST['log'];
    $pass = $_POST['pwd'];
    
    // Simulate username enumeration
    if ($user !== 'admin') {
        echo "<div id='login_error'>Invalid username.</div>";
    } else {
        if ($pass === 'password123') {
            echo "Login Success! Welcome to wp-admin.";
        } else {
            echo "<div id='login_error'>The password you entered for the username <strong>admin</strong> is incorrect.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Log In &lsaquo; Burger Labs WordPress &#8212; WordPress</title></head>
<body class="login">
    <div id="login">
        <form name="loginform" id="loginform" action="wp-login.php" method="post">
            <p><label for="user_login">Username or Email Address<br /><input type="text" name="log" id="user_login" class="input" value="" size="20" /></label></p>
            <p><label for="user_pass">Password<br /><input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label></p>
            <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" /></p>
        </form>
    </div>
</body>
</html>
