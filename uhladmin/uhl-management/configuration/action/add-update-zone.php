<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['zone_name']))
	{
		$Zone = new Zone($conn);
		$data = $_POST;
		if($data['zone_form_action'] != "Update")
		{
			$data['CreatedDate'] = date("Y-m-d");
			$data['CreatedTime'] = date("H:i:s");
			$data['CreatedBy'] = $_SESSION['dwd_email'];
            $is_unique = $Zone->DuplicateZone_pass($data);
			if($is_unique)
			{
                $response = $Zone->InsertZone($data);
                if($response['error'] == false)
                {				
                    $response['message'] = "Zone Created!";
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
                $response['message'] = "Zone Already Added!";
            }  
		}
		else
		{
			$response = $Zone->UpdateZoneDetails($data);
            if($response['error'] == false)
			{				
				$response['message'] = "Zone Updated!";
			}
		}
	}
	else
	{
		$response['error'] = true;
		$response['message'] = "Some Technical Error ! Please Try Again.";
	}
	echo json_encode($response);
?>