<?php

// URL of the script you want to test
$url = 'https://new.intellai.org/api/tasks/verify/index.php'; // Adjust this path to your actual `index.php` location

// Define the parameters to pass to the script
$params = [
    'task' => 'https://www.youtube.com/watch?v=yYKEvxFPy5Q', // Example task slug
    'user_id' => '7217194044',   // Example user ID
];

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Output the response from the server
    echo 'Response: ' . $response;
}

// Close cURL session
curl_close($ch);

?>
