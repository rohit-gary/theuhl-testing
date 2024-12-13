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
if(isset($data['token']) && isset($data['ReportID']) && isset($data['action']))
{
	$jwt = $data['token'];
	try
	{
		$token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
		$user_id = $token_decoded->data->user_id;
		$username = $token_decoded->data->username;
		$data['username'] = $username;
		$service_report_obj = new Servicereport($conn,$logs);
		$response = $service_report_obj->PostGeneralServiceReport($data);

		if($data['action'] == "submit" && $response['error'] == false)
		{
			$conf = new Configuration();
			$conf->SetGenerateReportURL();
			$core = new Core();
			$data_api["ID"] = $data['ReportID'];
			$core->sendCurlRequest($data_api,$conf->generate_report_url);
			$response['message'] = "Report updated and email with the report pdf has been sent to email";
		}
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
?>