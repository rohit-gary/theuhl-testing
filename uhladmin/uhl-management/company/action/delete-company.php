<?php
	@session_start();
	require_once('../../include/autoloader.inc.php');
	// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
	include("../../include/get-db-connection.php");
	$core = new Core();
	$core->setTimeZone();
	if(isset($_POST['CompanyID']))
	{
		$company = new Company($conn);
		$data = $_POST;
		$CompanyID = $_POST['CompanyID'];
		$where = " where CompanyID = $CompanyID";
		$company_sites_rows = $core->_getTotalRows($conn,'company_sites',$where);
		if($company_sites_rows > 0)
		{
			$response['error'] = true;
			$response['message'] = "Kindly delete all the Company Sites associated with the company first";
		}
		else
		{
			$reports_associated_with_company = $core->_getTotalRows($conn,'service_reports',$where);
			if($reports_associated_with_company > 0)
			{
				$response['error'] = true;
				$response['message'] = "Kindly delete all the service reports associated with the company first ";
			}
			else
			{
				$response = $company->DeleteCompany($data);
				if($response['error'] == false)
				{
					$response['message'] = "Company is deleted!";
				}
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