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


   $customer_Policydetails = $core->_getTableDetails($conn,'customerpolicy','where CustomerID = '. $customer_details['ID']);
  
   // print_r($customer_Policydetails);
   // die();
	if($customer_Policydetails != null)
	{
		$step = $step+1;
	}
     

    $member_details = $core->_getTableDetails($conn,'policy_member_details',  "where PolicyNumber = '" . $customer_Policydetails['PolicyNumber'] . "'");
	if($member_details != null)
	{
		$step = $step+1;
	}

    $customerpolicyamount = $core->_getTableDetails($conn,'customerpolicyamount',  "where PolicyNumber = '" . $customer_Policydetails['PolicyNumber'] . "'");
	if($customerpolicyamount != null)
	{
		$step = $step+1;
	}


	$response['step'] = $step;
	echo json_encode($response);
}