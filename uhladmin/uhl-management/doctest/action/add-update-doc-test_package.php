<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');

	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();

	if(isset($_POST['test_Package_name']))
	{
		$test_obj = new Test($conn);
		$data = $_POST;
   
	
		    if (isset($_POST['test_Package_cat']) && is_array($_POST['test_Package_cat'])) 
		    {
            $data['test_Package_cat'] = implode(',', $_POST['test_Package_cat']);
            }
            

            if (isset($_POST['package_test_name']) && is_array($_POST['package_test_name'])) 
		    {
            $data['package_test_name'] = implode(',', $_POST['package_test_name']);
            }
            

		if($data['form_action_test_Package'] != "Update")
		{
			$data['CreatedDate'] = date("Y-m-d");
			$data['CreatedTime'] = date("H:i:s");
			$data['CreatedBy'] = $_SESSION['dwd_email'];

			$response = $test_obj->InsertDocTestPackage($data);
			if($response['error'] == false)
			{				
				$response['message'] = "Test Record Created!";
			}
			else
			{
				$response['error'] = true;
				$response['message'] = "Some Technical Error ! Please Try Again.";
			}
		}
		else
		{
			$response = $test_obj->UpdateTestPackageDetails($data);
		}
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>