<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");
	require_once("../../controllers/send-welcome-email.php");
    $user = new CMUsers($conn);
	if(isset($_POST['name']))
	{
		$master = new ChannelPartner($master_conn);
		$ChannelPartner = new ChannelPartner($conn);
		$data = $_POST;
		$data['CreatedBy'] = $_SESSION['dwd_email'];
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		$form_action = $_POST['form_action'];
		$data['OrgID'] = $_SESSION['dwd_OrgID'];
        $data['CreatedBy'] = $_SESSION['dwd_email'];
		

				$postdata = [
					"email" => $data['email'],
					"password" => $data['password']
			];
	

        if($form_action == "Add")
		{
			// $response = $ChannelPartner->DuplicateDoctors_pass($data);
			$response = $master->CheckDuplicateChannelPartner($data);
			if($response['error'] == false)
			{
			 $response_insert_global_user = $master->InsertMasterUserChannelPartner($data);
			 $data['UserID'] = $response_insert_global_user['last_insert_id'];

			if($response_insert_global_user['error'] == false)
			{
				$response = $ChannelPartner->InsertChannelPartnerForm($data);
				
				if($response['error'] == false)
				{
					sendWelcomeEmail($postdata);
					$response['message'] = "Channel Partner Created!";
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}else{
				$response['error'] = true;
				$response['message'] = "Some Technical Error  ! Please Try Again.";
			}
		}else{
				$response['error'] = true;
				$response['message'] = "Channel Partner  Already Added.";
			}

	}
		else 
		{
			$response = $ChannelPartner->UpdateChannelPartnerForm($data);
			
			$response['error'] = false;
			$response['message'] = "Channel Partner  updated.";
		}	
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>