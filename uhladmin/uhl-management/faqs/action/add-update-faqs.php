<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");

	if(isset($_POST['Question']))
	{
		$Faqs = new Faqs($conn);
		$data = $_POST;
		$data['CreatedBy'] = $_SESSION['dwd_email'];
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		$form_action = $_POST['form_action'];

        if($form_action == "add")
		{
			// $response = $Faqs->DuplicateFaqs_pass($data);

			if(true)
			{
				$response = $Faqs->InsertFaqsForm($data);
				if($response['error'] == false)
				{
					$response['message'] = "Faqs Saved !";
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}else{
				$response['error'] = true;
				$response['message'] = "Faqs Already Added.";
			}
		}
		else 
		{
			$response = $Faqs->UpdateFaqsForm($data);
			$response['error'] = false;
		}	
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>