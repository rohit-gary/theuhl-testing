<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');

	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['test_category_name']))
	{
		$test_obj = new Test($conn);
		$data = $_POST;
		if($data['form_action_test_cat'] != "Update")
		{
			$data['CreatedDate'] = date("Y-m-d");
			$data['CreatedTime'] = date("H:i:s");
			$data['CreatedBy'] = $_SESSION['dwd_email'];
			$response = $test_obj->InsertTestCat($data);
			if($response['error'] == false)
			{				
				$response['message'] = "Test Category Record Created!";
			}
			else
			{
				$response['error'] = true;
				$response['message'] = "Some Technical Error ! Please Try Again.";
			}
		}
		else
		{
			$response = $test_obj->UpdateTestCatsDetails($data);
		}
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>