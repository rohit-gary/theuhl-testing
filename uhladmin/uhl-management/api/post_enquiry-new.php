<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
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
if(isset($data['Name']) && isset($data['Email']) && isset($data['MobileNumber']) && isset($data['Message']))
{ 

	    $CreatedDate = $UpdatedDate = date("Y-m-d");
		$CreatedTime = $UpdatedTime = date("H:i:s");

	
	
		$PolicyCustomer_obj = new PolicyCustomer($conn,$logs);
		$response = $PolicyCustomer_obj->PostEnqiryNew($data);
        
		
	
}
else
{
	$response['error'] = true;
    $response['message'] = "Missing User Field";
}
$logs->WriteLog(json_encode($response),__FILE__,__LINE__);
echo json_encode($response);
?>