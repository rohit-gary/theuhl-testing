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
if(isset($data['token']))
{
	$jwt = $data['token'];

	try
	{
		$token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
    
        
		$username = $token_decoded->data->username;
		$userId = $token_decoded->data->user_id;
    
		   $data['username'] = $username;
		   $data['ID'] = $userId;     
		    $Reimbursement_obj = new Reimbursement($conn);
            $filter="Where UserID='$userId'";
           $result = $Reimbursement_obj->GetAllReimbursementByUser($conn,'customer_reimbursement',$filter);
           
                  
    
		$response['error'] = false;
	
		$response['data'] = $result;
	}
	catch (Exception $e) {
	    
	        $logs->WriteLog($e->getMessage(), __FILE__, __LINE__);  
	    $response['error'] = true;
	    $response['message'] = "Invalid Token".$e->getMessage();
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