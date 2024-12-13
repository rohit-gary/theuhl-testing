<?php
header('Content-Type: application/json');

require('../vendor/autoload.php');

use Razorpay\Api\Api;


$keyId = 'rzp_test_ZHHIr27UIU5Lbo';
$keySecret = '5O6YEYOTV4kstBWMYdBQaWxd';
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
    // Pass order id to the frontend
    echo json_encode(['orderId' => $order['id']]);
} catch (Exception $e) {
    // Handle error
    echo json_encode(['error' => $e->getMessage()]);
}
?>
