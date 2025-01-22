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

header('Content-Type: application/json');
echo json_encode($cart_items);
?>