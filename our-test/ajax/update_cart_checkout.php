<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");

if (isset($_SESSION['cart_id'])) {
  $cart_id = $_SESSION['cart_id'];

}


$Cart_obj = new Cart($conn);
$cart = $Cart_obj->GertCartDetails($cart_id);
// var_dump($cart);
// die();
$cartitem = $cart[0];
$data['cart_id'] = $cartitem['id'];
$data['user_id'] = $cartitem['user_id'];
$data['CreatedDate'] = date('Y-m-d H:i:s');
$data['CreateTime'] = date('H:i:s');
$cart_items = $Cart_obj->InsertCartDetails($data);

if ($cart_items['error'] == false) {
  $cart_items_delete = $Cart_obj->DeleteCart($cart_id);

}
if ($cart_items['error'] == false) {
   unset($_SESSION['cart_id']);
  echo json_encode(['error' => false, 'message' => 'Cart Updated']);


} else {
  echo json_encode(['error' => true, 'message' => 'Cart Not Updated']);
}
?>