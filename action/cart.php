<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");

$Test_obj = new Test($conn);


if (!isset($_SESSION['temp_user_id'])) {
    $_SESSION['temp_user_id'] = uniqid('guest_');
}
// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_POST['action'] === 'add') {
    // Get product details
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $user_id = $_SESSION['user_id'] ?? -1; 
    $temp_user_id = $_SESSION['temp_user_id'];

    $data['productId']=$productId;
    $data['productPrice']=$productPrice;
    $data['productName']=$productName;
    $data['user_id']= $user_id;
    $data['temp_user_id']=$temp_user_id;
    $data['CreatedTime'] = date('H:i:s');
    $data['CreatedDate']= date('Y-m-d');
     $data['CreatedBy']= '';

    $response = $Test_obj->InsertTestCart($data);
    if($response['error']==false){
        $response['message']="Item add to cart";
    }

   
}
echo json_encode($response);
    
?>
