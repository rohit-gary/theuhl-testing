<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../include/autoloader.inc.php');
include("../../include/db-connection.php");
$Cart_obj = new Cart($conn);
$cart_id = -1;
if (isset($_SESSION['cart_id'])) {
  $cart_id = $_SESSION['cart_id'];
}
$cart_items = $Cart_obj->GetCartItemByCartID($cart_id);
$cart_count = count($cart_items);
echo json_encode(['cart_count' => $cart_count]);
?>