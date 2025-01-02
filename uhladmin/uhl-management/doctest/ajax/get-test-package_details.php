<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$data = array();
$data['ID'] = $_POST['ID'];
$test_obj = new Test($conn);
$test_details = $test_obj->GetTestPackageDetails($data);
echo json_encode($test_details);
?>