<?php 
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$PolicyCustomer = new PolicyCustomer($conn);
$core = new Core();
$response = array();
if(isset($_POST['ID']))
{
	$ID = $_POST['ID'];
	$step = 0;
	$PolicyNumber = "";
	// Check for STEP 1
	$customer_details = $core->_getTableDetails($conn,'all_customer','where ID = '.$ID);
	if($customer_details != null)
	{
		$step = $step+1;
		$customer_form = array();
		$customer_form['form_action'] = "";
		$customer_form['poc_name'] = $customer_details['Name'];
		$customer_form['poc_contact_number'] = $customer_details['ContactNumber'];
		$customer_form['gender'] = $customer_details['Gender'];
		$customer_form['dob'] = $customer_details['DateOfBirth'];
		$customer_form['email'] = $customer_details['Email'];
		$customer_form['state'] = $customer_details['State'];
		$customer_form['pincode'] = $customer_details['Pincode'];
		$customer_form['address'] = $customer_details['Address'];
		$customer_form['p_address'] = $customer_details['PermanentAddress'];
		$_SESSION['customer_form'] = $customer_form;
		$_SESSION['customer_id'] = $ID;
		$_SESSION['action'] = "Update";
	}

	// Check for STEP 2
	if($step == 1)
	{
		$customer_Policydetails = $core->_getTableRecords($conn,'customerpolicy','where CustomerID = '. $ID);
		if($customer_Policydetails != null)
		{
			$step = $step+1;
			$policy_form = array();
			$policy_form['customer_id'] = $ID;
			$policy_form['plans']  = array();
			foreach ($customer_Policydetails as $i_plan) 
			{
				$PolicyNumber = $i_plan['PolicyNumber'];
			 	array_push($policy_form['plans'],$i_plan['PlanID']);
			}
			$_SESSION['policy_form'] = $policy_form;
			$_SESSION['PolicyNumber'] = $PolicyNumber;
			$_SESSION['policy_form_action'] = "Update"; 
		}
	}
	if($step == 2)
	{
		if($PolicyNumber != "")
		{
			// check for STEP 3
			$family_member = array();
			$where = " where PolicyNumber = '$PolicyNumber'";
			$family_member_records = $core->_getTableRecords($conn,'policy_member_details',$where);
			if($family_member_records != null)
			{
				$step = $step+1;
				foreach($family_member_records as $family_member_record)
				{
					array_push($family_member,$family_member_record);
				}
				$_SESSION['family_member'] = $family_member;
			}

		}
	}



	$response['step'] = $step;
	echo json_encode($response);
}