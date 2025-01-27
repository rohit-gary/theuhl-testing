<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");
$cart_id = -1;
if (isset($_SESSION['cart_id'])) {
  $cart_id = $_SESSION['cart_id'];
} else {
  echo json_encode(['error' => true, 'message' => 'Cart ID not found in session.']);
  exit;
}
$Cart_obj = new Cart($conn);
$cart_items = $Cart_obj->GetCartItemByCartID($cart_id);
header('Content-Type: application/json');
echo json_encode($cart_items);
?>