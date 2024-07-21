<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the URL from user input
    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

    // Check if URL is valid
    if (!$url) {
        echo json_encode(['error' => 'Invalid URL']);
        exit;
    }

    // Prepare API URL
    $apiKey = 'DL3k8vhy58Z7IPc4DCpreBw1w7cpHTAK';
    $apiUrl = 'https://ipqualityscore.com/api/json/url/' . $apiKey . '/' . urlencode($url);

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo json_encode(['error' => curl_error($ch)]);
    } else {
        $responseData = json_decode($response, true);
        echo json_encode($responseData);
    }

    // Close cURL session
    curl_close($ch);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
