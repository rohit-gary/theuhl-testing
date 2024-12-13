<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");

	if(isset($_POST['Name']))
	{
		$Plans = new Plans($conn);
		$data = $_POST;
		$data['CreatedBy'] = $_SESSION['dwd_email'];
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		$form_action = $_POST['form_action'];

        if($form_action == "add")
		{
			// $response = $Plans->DuplicatePlans_pass($data);

			if(true)
			{
				$response = $Plans->InsertPlanForm($data);
				if($response['error'] == false)
				{
					$response['message'] = "Plan Saved !";
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}else{
				$response['error'] = true;
				$response['message'] = "Plan Already Added.";
			}
		}
		else 
		{
			$response = $Plans->UpdatePlanForm($data);
			
			$response['error'] = false;
			$response['message'] = "Plan updated.";
		}	
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>