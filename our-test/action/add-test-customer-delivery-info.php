<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");
$response = [];
if (isset($_POST['user_id'])) {
  $test_customer = new Test($conn);
  $data = $_POST;
  $data['CreatedDate'] = date('Y-m-d');
  $data['CreatedTime'] = date('H:i:s');
  $data['OrderID'] = 'UHLTEST' . rand(100000, 999999);
  $Info_response = $test_customer->InsertTestCustomerDeliveryInfo($data);
  $InfoID = $Info_response['last_insert_id'];
  if ($Info_response['error'] == false) {
    $data['CustomerInfoID'] = $InfoID;
    $data['CreatedDate'] = date('Y-m-d');
    $data['CreatedTime'] = date('H:i:s');
    $data['Status'] = 'Pending';
    $data['PaymentID'] = '';
    $data['UserID'] = $_POST['user_id'];
    $order_info = $test_customer->IndertOrderDetails($data);
    if ($order_info['error'] == false) {
      $response['message'] = "Customer delivery info added successfully";
      $response['error'] = false;
      $response['InfoID'] = $InfoID;
    } else {
      $response['message'] = "Order details failed to add";
      $response['error'] = true;
    }
  } else {
    $response['message'] = "Customer delivery info failed to add";
    $response['error'] = true;
  }
} else {
  $response['message'] = "missing User Field";
  $response['error'] = true;
}

echo json_encode($response);
?>