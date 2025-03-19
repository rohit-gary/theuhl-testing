<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../include/autoloader.inc.php');
include("../../include/db-connection.php");
require_once('../ajax/init_cart.php');

$Cart_obj = new Cart($conn);
@session_start();
$session_id = session_id();
$user_id = null;
$user_id = isset($_SESSION['UserID']) ? $_SESSION['UserID'] : null;
    
$cart_id = getOrCreateCart($session_id, $user_id);
$_SESSION['cart_id'] = $cart_id;
$response = [];

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = 1; // Default quantity



$item = $Cart_obj->GetcartItem($cart_id, $product_id);

if ($item) {

    $new_quantity = $item['quantity'] + $quantity;



    $response = $Cart_obj->UpdatecartitemQunatity($new_quantity, $item['id']);

} else {


    $data['cart_id'] = $cart_id;
    $data['product_id'] = $product_id;
    $data['product_name'] = $product_name;
    $data['product_price'] = $product_price;
    $data['quantity'] = $quantity;

    $response = $Cart_obj->InsertTestCartItem($data);
    if ($response['error'] == false) {
        $response['error'] = false;
        $response['message'] = 'Item added successfully';
        $response['cart_id'] = $cart_id;
    }
}

echo json_encode($response);
?>