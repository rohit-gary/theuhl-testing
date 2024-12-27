<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$response[]='';
$data = array();
$data['ID'] = $_POST['ID'];
$test_obj = new Test($conn);
$test_details = $test_obj->DeleteTestCat($data);

if($test_details){
	$response['message']="Test Category Deleted";
	$response['error']=false;
}

echo json_encode($response);
?>