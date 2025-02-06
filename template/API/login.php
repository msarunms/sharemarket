<?php
require '../../../vendor/autoload.php';

use KiteConnect\KiteConnect;

$api_key = "h3lgesv019usfgxp";  // Replace with your API Key
$kite = new KiteConnect($api_key);

// Generate the login URL
$login_url = $kite->getLoginURL();
echo "Login URL: $login_url\n";

// Automatically open the URL in the default browser
if (PHP_OS_FAMILY === 'Windows') {
    exec("start $login_url");
} elseif (PHP_OS_FAMILY === 'Darwin') {
    exec("open $login_url");
} elseif (PHP_OS_FAMILY === 'Linux') {
    exec("xdg-open $login_url");
} else {
    echo "Please manually open this URL in your browser: $login_url\n";
}
?>
