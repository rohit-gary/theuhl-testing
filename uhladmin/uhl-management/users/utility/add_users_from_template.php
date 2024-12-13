<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
include("../../include/get-db-connection.php");
$filename = '../templates/Technician.csv';
$file = fopen($filename, 'r');
while (($row = fgetcsv($file)) !== false) 
{
	if($row[5] == "")
		continue;
	$data = array();
	$user = new CMUsers($conn);
	$master = new Master($master_conn);
	if(1)
	{
		$data['user_username'] = $row[2];
		$data['user_email'] = $row[4];
		$data['user_name'] = $row[1];
		$data['user_phone_number'] = $row[5];
		$data['password'] = $row[3];
		$data['user_type'] = "Technician";
		$data['ta_address'] = "";
		$data['user_aadhar'] = "";
		$data['user_pan'] = "";
		$response = $master->CheckDuplicateUser($data);
		if($response['error'] == false)
		{
			$data['CreatedDate'] = date("Y-m-d");
			$data['CreatedTime'] = date("H:i:s");
			$data['CreatedBy'] = $_SESSION['dwd_email'];
			$data['OrgID'] = $_SESSION['dwd_OrgID'];
			$response_insert_global_user = $master->InsertMasterUser($data);
			if($response_insert_global_user['error'] == false)
			{
				$data['UserID'] = $response_insert_global_user['last_insert_id'];
				$response = $user->InsertUser($data);
				if($response['error'] == false)
				{
					$response['error'] = false;
					$response['message'] = "User Created Successfully !";
				}
				else
				{
					$response['error'] = true;
					$response['message'] = "Some Technical Error ! Please Try Again.";
				}
			}
			else
			{
				$response['error'] = true;
				$response['message'] = "Some Technical Error ! Please Try Again.";
			}
		}
	}
}
?>