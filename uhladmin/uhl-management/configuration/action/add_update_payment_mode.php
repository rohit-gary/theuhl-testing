<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['payment_mode']))
	{
		$payment_mode = $_POST['payment_mode'];
		$form_action = $_POST['form_action'];
		$data = $_POST;
		$data['CreatedDate'] = date("Y-m-d");
		$data['CreatedTime'] = date("H:i:s");
		$data['CreatedBy'] = $_SESSION['dwd_email'];
		$setting = new Clientsetting($conn);
		if($form_action == "add")
		{
			$response = $setting->InsertPaymentMode($data);
			if($response['error'] == false)
			{
				$response['message'] = "Payment Mode Saved !";
			}
			else
			{
				$response['error'] = true;
				$response['message'] = "Some Technical Error ! Please Try Again.";
			}
		}
		else 
		{
			$response = $setting->UpdatePaymentMode($data);
		}	
       
		
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>