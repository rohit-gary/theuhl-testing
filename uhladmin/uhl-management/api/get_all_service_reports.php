<?php
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");

$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$data = json_decode($data_raw,true);
$response = array();
if(isset($data['token']) && isset($data['start_counter']) && isset($data['no_of_records']))
{
	$jwt = $data['token'];
	try
	{
		$token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
		$username = $token_decoded->data->username;
		$data['username'] = $username;
		$company_obj = new Company($conn);
		$company_array = $company_obj->setCompanyArraybyID();
		$company_site_array = $company_obj->setCompanySiteArraybyID();

		$service_obj = new Service($conn);
		$service_array = $service_obj->setServicesArraybyID();

		$service_report_obj = new Servicereport($conn,$logs);
		$service_reports_raw = $service_report_obj->GetAllServiceReports($data);

		$service_reports = array();
		foreach($service_reports_raw as $service_report)
		{
			$service_report['CompanyName'] = $company_array[$service_report['CompanyID']]['CompanyName'];
			$service_report['CompanySiteName'] = $company_site_array[$service_report['CompanySiteID']]['CompanySite'];
			$service_report['ServiceName'] = $service_array[$service_report['ServiceID']]['ServiceName'];

			array_push($service_reports,$service_report);
		}

		$response['error'] = false;
		$response['data'] = $service_reports;
	}
	catch (Exception $e) {
	    // Invalid token
	    $response['error'] = true;
	    $response['message'] = "Invalid Token";
	}
}
else
{
	$response['error'] = true;
    $response['message'] = "Missing User Field";
}
$logs->WriteLog(json_encode($response),__FILE__,__LINE__);
echo json_encode($response);