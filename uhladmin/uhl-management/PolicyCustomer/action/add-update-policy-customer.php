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
		$form_action = $_POST['form_action'];
        $data['CreatedBy'] = $_SESSION['dwd_email'];

        if($form_action == "add")
		{ 

			$duplicateResponce=	$PolicyCustomer->checkDuplicatePolicyCustomer($data);

			if(!$duplicateResponce)
			{

			                
                 
                 $data['name']=$_POST['poc_name'];
				$data['phone_number']=$_POST['poc_contact_number'];
				$data['OrgID']=1;
				$data['password']=$_POST['dob'];

				$masterResponce=$master->InsertMasterPolicyUser($data);

				$data['UserID']=$masterResponce['last_insert_id'];
                
				$response = $PolicyCustomer->InsertPolicyCustomerForm($data);
                


               $PolicyCustomer->InsertUserRole($masterResponce['last_insert_id']);

				if($response['error'] == false)
				{
					$PolicyID=$response['last_insert_id'];
					$encryptedPolicyID = base64_encode($PolicyID); 
					$response['message'] = " Policy Customer Saved !";
					$response['last_insert_id']= $encryptedPolicyID;
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}else{
				$response['error'] = true;
				$response['message'] = " There is already a Health Plan Issued with this number or Email.";
			}
		}
		else 
		{
			
			
			$response['error'] = false;
			$response['message'] = " Policy Customer updated.";
		}	
	   
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>