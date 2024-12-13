<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require('vendor/autoload.php');

use Razorpay\Api\Api;


$keyId = 'rzp_test_ZHHIr27UIU5Lbo';
$keySecret = '5O6YEYOTV4kstBWMYdBQaWxd';
$api = new Api($keyId, $keySecret);


$razorpayPaymentId = $_POST['razorpay_payment_id'];
$razorpayOrderId = $_POST['razorpay_order_id'];
$razorpaySignature = $_POST['razorpay_signature'];


try {
    $attributes = [
        'razorpay_order_id' => $razorpayOrderId,
        'razorpay_payment_id' => $razorpayPaymentId,
        'razorpay_signature' => $razorpaySignature
    ];

    $api->utility->verifyPaymentSignature($attributes);

    
    echo json_encode(['status' => 'success', 'message' => 'Payment verified successfully!']);
} catch(\Razorpay\Api\Errors\SignatureVerificationError $e) {
    
    echo json_encode(['status' => 'failed', 'message' => 'Payment verification failed!']);
}
?>
