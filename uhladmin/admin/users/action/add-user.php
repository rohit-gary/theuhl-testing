<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	$dbh = new Dbh();
	$conn = $dbh->_connectodb();
	$authentication = new Authentication($conn);
    $authenticated = $authentication->SessionCheck();

	if(isset($_POST['user_name']))
	{
		$user = new Users($conn);
		$data = $_POST;
		$data['CreatedDate'] = date("Y-m-d");
		$data['CreatedTime'] = date("H:i:s");
		$data['CreatedBy'] = $_SESSION['dwd_email'];
		$duplicate_user_pass = $user->DuplicateUser_pass($data);
		if($duplicate_user_pass)
		{
			$response = $user->InsertUser($data);
			$response['error'] = false;
			$response['message'] = "User Created Successfully !";
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "Same email or phonumber has already been used!";
		}
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>