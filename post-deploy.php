<?php
// Script untuk dijalankan manual setelah CI/CD deployment
echo "<h2>🚀 Post-Deployment Setup</h2>";

// Clear cache
if (file_exists('bootstrap/cache/config.php')) {
    unlink('bootstrap/cache/config.php');
    echo "<p>✅ Config cache cleared</p>";
}

if (file_exists('bootstrap/cache/routes-v7.php')) {
    unlink('bootstrap/cache/routes-v7.php');
    echo "<p>✅ Route cache cleared</p>";
}

// Set permissions
chmod('storage', 0755);
chmod('bootstrap/cache', 0755);
echo "<p>✅ Permissions set</p>";

echo "<p><strong>Deployment completed! Delete this file for security.</strong></p>";
?>