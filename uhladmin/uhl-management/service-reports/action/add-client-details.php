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
		$data['ReportID'] = $_POST['ReportID'];
		$response = array();

		if($data['form_action'] != "Update")
		{
			
		    $data['action'] = "submit";
			$response = $Servicereport->PostGeneralServiceReportClientDetails($data);
			if($response['error'] == false)
			{
                $response_images = $Servicereport->PostGeneralServiceClientSignature($data);
                if($response['error'] == false)
			    {			
				   $response['message'] = "Client Details Updated!";
                   $conf = new Configuration();
                    $conf->SetGenerateReportURL();
                    $core = new Core();
                    $data_api["ID"] = $data['ReportID'];
                    $data_api["source"] = "web";
                    $core->sendCurlRequest($data_api,$conf->generate_report_url);
                   $response['message'] = "Report updated and email with the report pdf has been sent to email";
                }
			}
			else
			{
				$response['error'] = true;
				$response['message'] = "Some Technical Error ! Please Try Again.";
			}
		}else{
			$data['action'] = "";
			$response = $Servicereport->PostGeneralServiceReportClientDetails($data);
			if($response['error'] == false){
				$response_images = $Servicereport->PostGeneralServiceClientSignature($data);
				$response['error'] = false;
			    $response['message'] = "Client Representative Details Updated!";
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