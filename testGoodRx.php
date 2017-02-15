<?php
function base64url_encode($data) { 
    return strtr(base64_encode($data), '+/', '__'); 
} 

// Report all errors
error_reporting(E_ALL);

$myApiKey = "e6f0409f1e";
$secretKey = "7MsNWulBajxleiqMWO64TQ==";
$searchQuery = "Viagra";

// Initialize the CURL package. This is the thing that sends HTTP requests
$ch = curl_init();

// Create the URL and the hash
$url = "https://api.goodrx.com/drug-search?";

$queryString="query=" . $searchQuery . "&api_key=" . $myApiKey;

$tempSig = hash_hmac('sha256', $queryString, $secretKey, true);
$sig = base64url_encode( $tempSig );

$url = $url . $queryString . "&sig=" . $sig;

// set some curl options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_VERBOSE, TRUE);

// run the query
$response = curl_exec($ch);

echo($response);


?>