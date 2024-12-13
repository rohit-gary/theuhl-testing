<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");

	if(isset($_POST['payment_receipt_number']))
	{
		$payment_receipt_number = $_POST['payment_receipt_number'];
		$setting = new Clientsetting($conn);
        $response = $setting->UpdatePaymentReceiptNumber($payment_receipt_number);
		
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>