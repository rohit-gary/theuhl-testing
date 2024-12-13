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
if(isset($data['token']) && isset($data['imageData']) && isset($data['ReportID']))
{
	$jwt = $data['token'];
	$token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
	$user_id = $token_decoded->data->user_id;
	$username = $token_decoded->data->username;
	$imageData = $data['imageData'];
	$ReportID = $data['ReportID'];
	$data['username'] = $username;
	$imageData = base64_decode($imageData);
	// Generate a unique filename for the image

	$filename = "mi_".$ReportID."_".uniqid().'.jpg';
	$data['filename'] = $filename;
	// Define the storage directory where the image will be saved
	$storageDirectory = '../service-reports/media/service_image/';

	file_put_contents($storageDirectory . $filename, $imageData);

	$service_report_obj = new Servicereport($conn,$logs);
	$response = $service_report_obj->UpdateReportMedia($data);
	if($response['error'] == false)
	{
		$response['message'] = "Report Image Updated";
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