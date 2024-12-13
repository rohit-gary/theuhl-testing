<?php
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
require_once('../include/autoloader.inc.php');
$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$data = json_decode($data_raw,true);
$response = array();
if(isset($data['username']) && isset($data['password']))
{
   $dbh = new Dbh();
   $conn = $dbh->_connectodb();
   $authentication = new Authentication($conn);
   $data['email'] = $data['username'];
   $response_login = $authentication->login($data);
   if($response_login['error'] == false)
   {
      $core = new Core();
      $where = " where OrgID = 1";
      $org_module_details = $core->_getTableDetails($conn,'org_module_mapping',$where);
      $router = new Router($org_module_details);
      $conn_client = $router->_connectodb();
      $roles = $router->Client_GetUserRole($response_login['data']['UserID']);
      $response['message'] = "Authentication done";
      //print_r($roles);
      $user_data = array(
          "user_id" => $response_login['data']['UserID'],
          "username" => $response_login['username']
      );
      $expiration_time = time() + (100 * 365 * 24 * 60 * 60);
      // Generate JWT
      $token = array(
          "iss" => "rpm.digitalworkdesk.com",
          "aud" => "RPM",
          "iat" => time(),
          "exp" => $expiration_time,
          "data" => $user_data
      );
      $jwt = JWT::encode($token, $secret_key,'HS512');
      $response['token'] = $jwt;
      $response['role'] =  $roles[0]['Role'];
   }
   else
   {
      $response['error'] = true;
      $response['message'] = "Invalid Credentials";
   }
}
else
{
    $response['error'] = true;
    $response['message'] = "Missing User Fields!";
}
$logs->WriteLog(json_encode($response),__FILE__,__LINE__);
echo json_encode($response);
?>