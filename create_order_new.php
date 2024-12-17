<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require('vendor/autoload.php');

use Razorpay\Api\Api;


// $keyId = 'rzp_live_ByoIjLl32Tm8w1';
// $keySecret = 'QgIJaeh9XCDfQdJm2wAAC8z7';

$keyId = 'rzp_test_VHcUYxXlN9UYgv';
$keySecret = 'cBj7elTcBMqd3h3jIQXvvFE8';
$api = new Api($keyId, $keySecret);

$input = json_decode(file_get_contents('php://input'), true);
    

$amount = $input['amount'] * 100; 
$currency = $input['currency'];
$receipt = $input['receipt'];



$orderData = [
    'receipt'         => strval($receipt), 
    'amount'          => $amount, 
    'currency'        => 'INR',
    'payment_capture' => 1 
];

try {
    $order = $api->order->create($orderData);
    
    echo json_encode(['orderId' => $order['id']]);
} catch (Exception $e) {
    // Handle error
    echo json_encode(['error' => $e->getMessage()]);
}
?>
