<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");
$response = [];
if (isset($_POST['UserID'])) {
  $data = $_POST;
  $test = new Test($conn);
  $response = $test->updatecartuserID($data);
} else {
  $response['message'] = "missing User Field";
  $response['error'] = true;
}

echo json_encode($response);
?>