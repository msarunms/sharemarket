<?php
$url = "https://developers.kite.trade/login"; // Replace with the token endpoint
$username = "pradeepm465@gmail.com";
$password = "Saibaba01$";

$data = [
    "username" => $username,
    "password" => $password,
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
} else {
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode === 200) {
        $responseData = json_decode($response, true);
        $token = $responseData['token']; // Adjust based on the API response
        echo "Token: $token";
    } else {
        echo "Failed to get token. HTTP Code: $httpCode";
    }
}

curl_close($ch);
?>
