<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");

    
	if(isset($_POST['plans']))
	{

		// print_r($_POST);
		// die();
		$master = new PolicyCustomer($master_conn);
		$PolicyCustomer = new PolicyCustomer($conn);
		$data = $_POST;
		
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		$form_action = $_POST['form_action'];
        $data['CreatedBy'] = $_SESSION['dwd_email'];

        if($form_action !== "Update")
		{ 

			// $duplicateResponce=	$PolicyCustomer->checkDuplicatePolicyCustomer($data);

			if(true)
			{
                
				$response = $PolicyCustomer->InsertPolicyForm($data);

				$_SESSION['policy_form'] = $_POST;
          
				if($response['error'] == false)
				{
					
					$response['error']=false;
					$response['ID']=$response['last_insert_id'];
					$_SESSION['policy_form_Id']=$response['last_insert_id'];
					$response['PolicyNumber']=$response['PolicyNumber'];
					$_SESSION['PolicyNumber']=$response['PolicyNumber'];
					$response['message'] = " Policy Saved !";
					$_SESSION['policy_form_action'] ='Update';
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}else{
				$response['error'] = true;
				$response['message'] = "Policy Already exist";
			}
		}
		else 
		{
			
			// $response = $PolicyCustomer->UpdateCustomerForm($data);
			$response['error'] = false;
			$response['message'] = " Policy updated.";
		}	
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>