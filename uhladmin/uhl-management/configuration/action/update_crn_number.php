<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");

	if(isset($_POST['crn']))
	{
		$crn = $_POST['crn'];
		$setting = new Clientsetting($conn);
        $response = $setting->UpdateCRNNumber($crn);
		
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>