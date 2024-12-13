<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['CompanySiteID']))
	{
		$company = new Company($conn);
		$data = $_POST;
		$CompanySiteID = $_POST['CompanySiteID'];
		$where = " where CompanySiteID = $CompanySiteID";
		$reports_associated_with_company_site = $core->_getTotalRows($conn,'service_reports',$where);
		if($reports_associated_with_company_site > 0)
		{
			$response['error'] = true;
			$response['message'] = "Kindly delete all the Reports associated with the company site first";
		}
		else
		{
			$response = $company->DeleteCompanySite($data);
			if($response['error'] == false)
			{
				$response['message'] = "Company Site is deleted!";
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