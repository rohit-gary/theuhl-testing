<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['ipd_category']))
	{
		$ipd_category = $_POST['ipd_category'];
		$form_action = $_POST['form_action'];
		$data = $_POST;
		$data['CreatedDate'] = date("Y-m-d");
		$data['CreatedTime'] = date("H:i:s");
		$data['CreatedBy'] = $_SESSION['dwd_email'];
		$setting = new Clientsetting($conn);
		if($form_action == "add")
		{
			$response = $setting->InsertIPDCategory($data);
			if($response['error'] == false)
			{
				$response['message'] = "OPD Category Saved !";
			}
			else
			{
				$response['error'] = true;
				$response['message'] = "Some Technical Error ! Please Try Again.";
			}
		}
		else 
		{
			$response = $setting->UpdateIPDCategory($data);
		}	
       
		
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>