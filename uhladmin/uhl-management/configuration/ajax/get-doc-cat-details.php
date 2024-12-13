<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$data = array();
$data['ID'] = $_POST['ID'];
$service_obj = new Service($conn);
$service_details = $service_obj->GetCatDetails($data);
echo json_encode($service_details);
?>