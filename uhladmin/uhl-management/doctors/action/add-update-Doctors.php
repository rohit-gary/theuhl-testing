<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");

	if(isset($_POST['Name']))
	{
		$Doctor = new Doctors($conn);
		$data = $_POST;
		$data['CreatedBy'] = $_SESSION['dwd_email'];
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		$form_action = $_POST['form_action'];

        if($form_action == "add")
		{
			// $response = $Doctors->DuplicateDoctors_pass($data);

			if(true)
			{
				$response = $Doctor->InsertDoctorForm($data);
				if($response['error'] == false)
				{
					$response['message'] = "Doctor Saved !";
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}else{
				$response['error'] = true;
				$response['message'] = "Doctor Already Added.";
			}
		}
		else 
		{
			$response = $Doctor->UpdateDoctorForm($data);
			
			$response['error'] = false;
			$response['message'] = "Doctor updated.";
		}	
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>