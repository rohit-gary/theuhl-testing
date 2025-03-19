<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");

    
	if(isset($_POST['poc_name']))
	{
		$master = new PolicyCustomer($master_conn);
		$PolicyCustomer = new PolicyCustomer($conn);
		$data = $_POST;
		
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		$form_action = $_POST['form_test_action'];
        $data['CreatedBy'] = $_SESSION['dwd_email'];

        if($form_action !== "Update")
		{ 

			// $duplicateResponce=	$PolicyCustomer->checkDuplicatePolicyCustomer($data);

			if(true)
			{
         
                $data['name']=$_POST['poc_name'];
				$data['phone_number']=$_POST['test_poc_contact_number'];
				$data['OrgID']=1;
				$data['password']=1234;
				$masterResponce=$master->InsertMasterPolicyUser($data);
				$data['UserID']=$masterResponce['last_insert_id'];
                $_SESSION['customer_test_form'] = $_POST;
                $PolicyCustomer->InsertUserRole($masterResponce['last_insert_id']);
				if($masterResponce['error'] == false)
				{
					$UserID=$masterResponce['last_insert_id'];
					$response['error']=false;
					$response['UserID']=$masterResponce['last_insert_id'];
					$_SESSION['UserID'] = $masterResponce['last_insert_id'];
					$_SESSION['action'] ='Update';
					$encryptedUserID = base64_encode($UserID); 
					$response['message'] = " User Information Saved. Kindly proceed to next step!";
					$response['last_insert_id']= $encryptedUserID;
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}else{
				$response['error'] = true;
				$response['message'] = "User Already exist";
			}
		}
		else 
		{
			
			// $response = $PolicyCustomer->UpdateCustomerForm($data);
			$response['error'] = false;
			$response['message'] = " Customer updated.";
		}	
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>