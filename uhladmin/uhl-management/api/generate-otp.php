<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
require_once('../include/autoloader.inc.php');
require_once('../controllers/common_controller.php');
$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$data = json_decode($data_raw,true);
$response = array();
if(isset($data['PhoneNumber']))
{

   $MobileNumber=$data['PhoneNumber'];
   $dbh = new Dbh();
   $conn = $dbh->_connectodb();
   $authentication = new Authentication($conn);
    $phonenumber = $data['PhoneNumber'];
   $otp = generateOTP($phonenumber);
   
	InsertTempOTP($conn,$phonenumber,$otp);
     $data['phonenumber'] = $phonenumber;
	$data['otp'] = $otp;
    
	$response["error"] = false;
	$response["message"] = "Kindly Enter the OTP sent to your phone number";
   $response['otp']=$data['otp'];
   $smsdata=array(
                  "variables_values" =>$otp,
                  "route" => "otp",
                  "numbers" => $MobileNumber,
                  );
   sendSmsOtp($smsdata);
  
}
else
{
    $response['error'] = true;
    $response['message'] = "Missing User Fields!";
}
$logs->WriteLog(json_encode($response),__FILE__,__LINE__);
echo json_encode($response);
?>