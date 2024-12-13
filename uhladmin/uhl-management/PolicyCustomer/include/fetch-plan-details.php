<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");

    
	if(isset($_POST['plan_id']))
	{

		// print_r($_POST);
		// die();
		
		$Plans_obj = new Plans($conn);
		$data = $_POST;
		$plan_id=$data['plan_id'];
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		// $form_action = $_POST['form_action'];
        $data['CreatedBy'] = $_SESSION['dwd_email'];
	
	    $AllPlansIds= $Plans_obj->GetPlanDetailsbyID($plan_id);
	    $response=$AllPlansIds;
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>