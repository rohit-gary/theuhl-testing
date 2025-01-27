<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");
$Cart_obj = new Cart($conn);
$data = json_decode(file_get_contents('php://input'), true);
$itemId = $data['id'];
$cart_id = $_SESSION['cart_id'];
if ($itemId) {

    $result = $Cart_obj->RemoveItemFromCart($itemId, $cart_id);
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>