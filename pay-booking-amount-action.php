<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();
// include("includes/db-common.php");
// $conn = _connectodb();
require_once('../include/autoloader.inc.php');
$dbh = new Dbh();
        $core = new Core();
        $conn = $dbh->_connectodb();

if (isset($_POST['name'], $_POST['phone'], $_POST['amount'])) {
    
    $transactionId_temp = date('dmYhmi') . rand(111111, 999999);
    $amount = $_POST['amount'];
    
    $phone = $_POST['phone'];
    $ID = $_POST['ID'];

    $transactionId = $transactionId_temp . "-" .$ID;
    // echo $transactionId;
    // die();

    function generateUniqueMerchantUserId() {
        
        $uniqueId = uniqid('', true) . bin2hex(random_bytes(8));
        return $uniqueId;
    }
    
    // Example usage
    $merchantUserId = generateUniqueMerchantUserId();

    // Construct the payload for PhonePe
   $eventPayload = [
    'merchantId' => 'GOODLIFEFACIONLINE',
    'merchantTransactionId' => $transactionId,
    'merchantUserId' => $merchantUserId,
    'amount' => $amount * 100,
    'redirectUrl' => 'https://goodlifefacilities.com/payment-status.php',
    'redirectMode' => 'POST',
    'callbackUrl' => 'https://goodlifefacilities.com/payment-status.php',
    'mobileNumber' => $phone,
    'paymentInstrument' => [
        'type' => 'PAY_PAGE',
    ],
];


    // Encode payload to base64
    $encodedPayload = base64_encode(json_encode($eventPayload));
     

    // Set API Key and Index
    // $saltKey = '51778fc0-016b-48fe-b509-108277bfa5e2'; //  new test
    // $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399'; // test
    $saltKey = 'a5cfe459-0fd3-4d96-b5a6-0454ab66ad43';  // orignal
    $saltIndex = 1;

    // Construct X-VERIFY header
    $string = $encodedPayload . '/pg/v1/pay' . $saltKey;
   $sha256 = hash('SHA256', $string);
    $finalXHeader = $sha256 . '###' . $saltIndex;

    
    // Set headers for the request
    $headers = [
        'Content-Type: application/json',
        'X-VERIFY: ' . $finalXHeader,
    ];

    print_r($headers);
    die();

    

    // Define PhonePe API URL
    // $phonePayUrl = 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay'; // For Development
     // $phonePayUrl = 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay'; // For Development
    $phonePayUrl = 'https://api.phonepe.com/apis/hermes/pg/v1/pay'; // For Production

    // Prepare data for the request
    $data = [
        'request' => $encodedPayload,
    ];

    // Set options for the HTTP request
    $options = [
        'http' => [
            'method' => 'POST',
            'content' => json_encode($data),
            'header' => implode("\r\n", $headers),
        ],
    ];

    // Create a stream context
    $context = stream_context_create($options);

    // Make the request to PhonePe API
    $response = file_get_contents($phonePayUrl, false, $context);
// $response = file_get_contents($phonePayUrl, false, $context);
if ($response === FALSE) {
    error_log('Error occurred while making API request');
    die('Error occurred while making API request');
}

$result = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('Error decoding JSON response: ' . json_last_error_msg());
    die('Error decoding JSON response');
}

// Log the full result for debugging
error_log('API Response: ' . print_r($result, true));

if (isset($result['data']['instrumentResponse']['redirectInfo']['url'])) {
    $redirectUrl = $result['data']['instrumentResponse']['redirectInfo']['url'];
    header("Location: $redirectUrl");
    exit();
} else {
    error_log('Invalid response data structure');
    die('Invalid response data structure');
}

    // Decode the response
    $result = json_decode($response, true);

    // Extract the redirect URL for payment
    $redirectUrl = $result['data']['instrumentResponse']['redirectInfo']['url'];

    // Redirect the user to PhonePe for payment
    header("Location: $redirectUrl");
    exit();
} else {
    // Handle invalid form submission
    echo "400 Bad Request";
}
?>