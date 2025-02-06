<?php
// File to store the request token
$request_token_file = 'request_token.txt';

// Check if the request token exists in the URL
if (isset($_GET['request_token'])) {
    $request_token = $_GET['request_token'];

    // Validate the request token
    if (!empty($request_token)) {
        // Save the request token to a file
        if (file_put_contents($request_token_file, $request_token)) {
            echo "Request Token saved successfully: $request_token\n";

            // Redirect to the next step to process the token and fetch user details
            header("Location: process_token.php");
            exit();
        } else {
            echo "Error: Unable to write to file `$request_token_file`.\n";
        }
    } else {
        echo "Error: Received an empty request token.\n";
    }
} else {
    echo "Error: `request_token` not found in the URL.\n";
}
?>
