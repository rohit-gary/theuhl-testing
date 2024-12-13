<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['s_company']))
	{
		$company = new Company($conn);
		$data = $_POST;
		if($data['form_action'] != "Update")
		{
			$data['CreatedDate'] = date("Y-m-d");
			$data['CreatedTime'] = date("H:i:s");
			$data['CreatedBy'] = $_SESSION['dwd_email'];
			$response = $company->InsertCompanySite($data);
			if($response['error'] == false)
			{				
				$response['message'] = "Company Site Record Created!";
			}
			else
			{
				$response['error'] = true;
			}
		}
		else
		{
			$response = $company->UpdateCompanySiteDetails($data);
		}
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>