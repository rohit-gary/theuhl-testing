<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	@session_start();
	require_once('../../include/autoloader.inc.php');
	include("../../include/get-db-connection.php");

    
	if(isset($_POST['policy_number']))
	{

		// print_r($_POST);
		// die();
		$master = new PolicyCustomer($master_conn);
		$PolicyCustomer = new PolicyCustomer($conn);
		$data = $_POST;
		$PolicyNumber=$data['policy_number'];
		$data['CreatedTime'] = date('H:i:s');
		$data['CreatedDate']= date('Y-m-d');
		// $form_action = $_POST['form_action'];
        $data['CreatedBy'] = $_SESSION['dwd_email'];
	
	    $AllPlansIds= $PolicyCustomer->GetCustomerAllPlansIDByPolicyNumber($PolicyNumber);
	    // print_r($AllPlansIds);
	    // die();
	    $response= $AllPlansIds;
	    // $response['familyMembersCovered']=$AllPlansIds['PlanFamilyMember'];
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>