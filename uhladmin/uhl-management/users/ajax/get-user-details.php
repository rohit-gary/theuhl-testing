<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$data = array();
$data['UserID'] = $_POST['UserID'];
$user = new CMUsers($conn);
$user_details = $user->GetUserDetails($data);
echo json_encode($user_details);
?>