<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");
$response = [];
if (isset($_POST['name'])) {
  $data = $_POST;
  $data['OrgID'] = 1;
  $PolicyCustomer = new PolicyCustomer($conn);
  $master = new PolicyCustomer(conn: $master_conn);
  $masterResponce = $master->InsertMasterPolicyUser($data);
  $data['UserID'] = $masterResponce['last_insert_id'];
  $response_user_role = $PolicyCustomer->InsertUserRole($masterResponce['last_insert_id']);
  if ($response_user_role['error'] == false) {
    $response['message'] = "Customer created successfully";
    $response['error'] = false;
    $response['user_id'] = $masterResponce['last_insert_id'];
  } else {
    $response['message'] = "Customer creation failed";
    $response['error'] = true;
  }
} else {
  $response['message'] = "missing User Field";
  $response['error'] = true;
}

echo json_encode($response);
?>