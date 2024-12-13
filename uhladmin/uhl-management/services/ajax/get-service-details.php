<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$data = array();
$data['ServiceID'] = $_POST['ServiceID'];
$service_obj = new Service($conn);
$service_details = $service_obj->GetServiceDetails($data);
echo json_encode($service_details);
?>