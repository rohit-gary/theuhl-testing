<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require('../vendor/autoload.php');
require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");

$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$test = new Test($conn);


use Razorpay\Api\Api;


// $keyId = 'rzp_live_ByoIjLl32Tm8w1';
// $keySecret = 'QgIJaeh9XCDfQdJm2wAAC8z7';

$keyId = 'rzp_live_CIaXiqWSJYoxsg';
$keySecret = 'pPZ48IMCPtHagldcYr9UVJTq';
$api = new Api($keyId, $keySecret);

// Decode the JSON payload from the request body
$input = json_decode(file_get_contents('php://input'), true);

// var_dump(expression)

$razorpayPaymentId = $input['razorpay_payment_id'];
$razorpayOrderId = $input['razorpay_order_id'];
$razorpaySignature = $input['razorpay_signature'];

$amount = $input['amount'] ?? 0;
$name = $input['name'] ?? '';
$phone = $input['phone'] ?? '';
$cart_id = $input['cart_id'] ?? 0;


$data['razorpayPaymentId'] = $razorpayPaymentId;
$data['razorpayOrderId'] = $razorpayOrderId;
$data['razorpaySignature'] = $razorpaySignature;
$data['amount'] = $amount;
$data['name'] = $name;
$data['phone'] = $phone;
$data['cartID'] = $cart_id;

try {
  $attributes = [
    'razorpay_order_id' => $razorpayOrderId,
    'razorpay_payment_id' => $razorpayPaymentId,
    'razorpay_signature' => $razorpaySignature
  ];
  $api->utility->verifyPaymentSignature($attributes);
  $response = $test->UpdateTestPaymentData($data);
  if ($response['error'] == false) {
    unset($_SESSION['cart_id']);
  }
  echo json_encode(['status' => 'success', 'message' => 'Payment verified successfully!']);
} catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {

  echo json_encode(['status' => 'failed', 'message' => 'Payment verification failed!']);
}
?>