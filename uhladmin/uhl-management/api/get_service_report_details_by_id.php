<?php
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");

$conf = new Configuration();
$conf->SetMediaURLs();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$data = json_decode($data_raw,true);
$response = array();
if(isset($data['token']) && isset($data['ID']))
{
	$jwt = $data['token'];
	try
	{
		$token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
		
		$company_obj = new Company($conn);
		$company_array = $company_obj->setCompanyArraybyID();
		$company_site_array = $company_obj->setCompanySiteArraybyID();

		$service_obj = new Service($conn);
		$service_array = $service_obj->setServicesArraybyID();

		$service_report_obj = new Servicereport($conn,$logs);
		$service_report = $service_report_obj->GetServiceReportByID($data);
		
		$service_report['CompanyName'] = $company_array[$service_report['CompanyID']]['CompanyName'];
		$service_report['CompanySiteName'] = $company_site_array[$service_report['CompanySiteID']]['CompanySite'];
		$service_report['ServiceName'] = $service_array[$service_report['ServiceID']]['ServiceName'];
		if($service_report['Status'] != 'Initiated')
		{
			if($service_report['ClientSignature'] != "")
			{
				$service_report['ClientSignature'] = $conf->signature_url."/".$service_report['ClientSignature'];
			}
			if(isset($service_report['report_images']))
			{
				if(sizeof($service_report['report_images']) > 0)
				{
					foreach($service_report['report_images'] as $key=>$report_image)
					{
						$service_report['report_images'][$key] = $conf->asset_url."/".$report_image;
					}
				}
			}
		}
		$response['error'] = false;
		$response['data'] = $service_report;
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