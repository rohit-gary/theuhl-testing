<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../../include/autoloader.inc.php');
include("../../include/db-connection.php");


header('Content-Type: application/json');

$cart_id = isset($_SESSION['cart_id']) ? $_SESSION['cart_id'] : '';


echo json_encode(["cart_id" => $cart_id]);
?>
