<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");
	
	$authentication = new Authentication($conn);
    $authenticated = $authentication->SessionCheck();
	if(isset($_POST['PlanCoordinator']))
	{
		$Plans = new Plans($conn);
		$data = $_POST;
		$response = $Plans->UpdatePlanCoordinator($data);
        $response['error'] = false;
		$response['message'] = "Plan Lead Updated !";
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>