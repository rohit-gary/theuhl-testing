<?php

error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['user_name']))
	{
		$user = new CMUsers($conn);
		$data = $_POST;
		$master = new Master($master_conn);
		if($data['form_action'] != "Update")
		{
			$response = $master->CheckDuplicateUser($data);
			if($response['error'] == false)
			{
				$data['CreatedDate'] = date("Y-m-d");
				$data['CreatedTime'] = date("H:i:s");
				$data['CreatedBy'] = $_SESSION['dwd_email'];
				$data['OrgID'] = $_SESSION['dwd_OrgID'];
				$response_insert_global_user = $master->InsertMasterUser($data);
				if($response_insert_global_user['error'] == false)
				{
					$data['UserID'] = $response_insert_global_user['last_insert_id'];
					$response = $user->InsertUser($data);
					if($response['error'] == false)
					{
						$response['error'] = false;
						$response['message'] = "User Created Successfully !";
					}
					else
					{
						$response['error'] = true;
						$response['message'] = "Some Technical Error ! Please Try Again.";
					}
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}
		}
		else
		{
			$response_update_master_user = $master->UpdateMasterUserDetails($data);
			if($response_update_master_user['error'] == false)
			{
				$response = $user->UpdateUserDetails($data);
				if($response['error'] == true)
				{
					$response['message'] = "Technical Error, please try again!";
				}
			}
			else
			{
				$response['error'] = true;
				$response['message'] = "Technical Error! Please try again!";
			}
			
		}
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>