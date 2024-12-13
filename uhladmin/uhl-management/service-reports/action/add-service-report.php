<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['CompanyID']))
	{
        $logs = new Logs();
        $logs->SetCurrentAPILogFile();
		$Servicereport = new Servicereport($conn,$logs);
		$data = $_POST;
		$data['CreatedDate'] = date("Y-m-d");
		$data['CreatedTime'] = date("H:i:s");
		$data['CreatedBy'] = $_SESSION['dwd_email'];
        $data['username'] = $_SESSION['dwd_email'];
        $data['source'] = "web";
		if($data['form_action'] != "Update")
		{
			
            $data['action'] = "Draft";
			$service_report_response = $Servicereport->InitiateServiceReport($data);
			if($service_report_response['error'] == false)
			{	
                $data['ReportID'] = $service_report_response['last_insert_id'];
                $response = $Servicereport->PostGeneralServiceReportDetails($data);
                $response_images = $Servicereport->PostGeneralServiceReportImages($data);
                if($response['error'] == false)
			    {			
				   $response['message'] = "Service Report Saved!";
                   $response['report_id'] = $service_report_response['last_insert_id'];
                }
			}
			else
			{
				$service_report_response['error'] = true;
				$service_report_response['message'] = "Some Technical Error ! Please Try Again.";
			}
		}else{
			$data['action'] = "";
			$data['ReportID'] = $_POST['ReportID'];
			$response = $Servicereport->PostGeneralServiceReportDetails($data);
			if($response['error'] == false){
				$response_images = $Servicereport->PostGeneralServiceReportImages($data);
				$response['error'] = false;
				$response['message'] = "Service Report Details Updated!";
			}else{
				$response['error'] = true;
				$response['message'] = "Some Technical Error ! Please Try Again.";
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