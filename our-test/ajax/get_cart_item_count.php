<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");
require_once('./init_cart.php');
$Cart_obj = new Cart($conn);

$cart_id = getOrCreateCart();

$cart_items = $Cart_obj->GetCartItemByCartID($cart_id);


$cart_count = count($cart_items);

// Return the count as JSON
echo json_encode(['cart_count' => $cart_count]);
?>