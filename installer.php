<?php
/**
 * BLVWA One-Click Remote Installer
 * This script downloads the latest code from GitHub and extracts it.
 */

$github_repo = "Amegh3/Burger-Lab-Vulnerable-Web-Application-BLVWA-";
$zip_url = "https://github.com/$github_repo/archive/refs/heads/main.zip";
$save_to = "blvwa_latest.zip";

echo "<h1>🍔 BLVWA Auto-Installer</h1>";

if (isset($_GET['run'])) {
    echo "<p>⏳ Downloading latest code from GitHub...</p>";
    
    // Download ZIP
    $content = file_get_contents($zip_url);
    if ($content === false) {
        die("<p style='color:red;'>❌ Error: Could not download from GitHub. Make sure the repo is Public.</p>");
    }
    file_put_contents($save_to, $content);
    
    echo "<p>📦 Extracting files...</p>";
    
    $zip = new ZipArchive;
    if ($zip->open($save_to) === TRUE) {
        $zip->extractTo(__DIR__);
        $zip->close();
        
        // Move files out of the subfolder if necessary
        $subfolder = "Burger-Lab-Vulnerable-Web-Application-BLVWA--main";
        if (is_dir($subfolder)) {
            $files = scandir($subfolder);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    rename("$subfolder/$file", "./$file");
                }
            }
            rmdir($subfolder);
        }
        
        unlink($save_to);
        echo "<p style='color:green;'>✅ <b>Success!</b> BLVWA has been installed.</p>";
        echo "<p>👉 <a href='/index.php'>Go to Homepage</a> (Don't forget to delete this installer.php file for security!)</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: Could not extract ZIP file. Make sure your hosting supports ZipArchive.</p>";
    }
} else {
    echo "<p>This will download the latest code from your GitHub repo into this folder.</p>";
    echo "<form><input type='hidden' name='run' value='1'><button type='submit' style='padding:10px 20px; background:#E63946; color:white; border:none; border-radius:5px; cursor:pointer;'>🚀 START INSTALLATION</button></form>";
}
?>
