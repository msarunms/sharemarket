<?php
require '../../../vendor/autoload.php';

use KiteConnect\KiteConnect;

$api_key = "h3lgesv019usfgxp";       // Replace with your API Key
$api_secret = "bxeao6r78g01wht7gmyl5h9d5zulx1ib"; // Replace with your API Secret
$kite = new KiteConnect($api_key);

// Read the request token from the file
$request_token_file = 'request_token.txt';
if (file_exists($request_token_file)) {
    $request_token = trim(file_get_contents($request_token_file));

    // Generate access token using the request token
    try {
        $session = $kite->generateSession($request_token, $api_secret);
        $access_token = $session['access_token'];

        // Save the access token for future use
        file_put_contents('access_token.txt', $access_token);
        echo "Access Token generated and saved successfully: $access_token\n";

        // Fetch user details
        $user_details = $kite->getProfile();
        echo "User Details:\n";
        print_r($user_details);

    } catch (Exception $e) {
        echo "Error generating access token: " . $e->getMessage() . "\n";
    }
} else {
    echo "Error: Request token file not found.\n";
}
?>
