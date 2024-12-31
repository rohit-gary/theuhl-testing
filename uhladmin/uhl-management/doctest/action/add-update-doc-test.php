<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');

	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['test_name']))
	{
		$test_obj = new Test($conn);
		$data = $_POST;
   
		// var_dump($data);
        // die();
		    if (isset($_POST['test_cat']) && is_array($_POST['test_cat'])) 
		    {
            $data['test_cat'] = implode(',', $_POST['test_cat']);
            }
            

		if($data['form_action_test'] != "Update")
		{
			$data['CreatedDate'] = date("Y-m-d");
			$data['CreatedTime'] = date("H:i:s");
			$data['CreatedBy'] = $_SESSION['dwd_email'];

			$response = $test_obj->InsertDocTest($data);
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
			$response = $test_obj->UpdateTestDetails($data);
		}
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>