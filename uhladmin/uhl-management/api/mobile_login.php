<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
require_once('../include/autoloader.inc.php');
require_once('../controllers/common_controller.php');
require_once("../include/db-connection.php");
$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw, __FILE__, __LINE__);
$data = json_decode($data_raw, true);
$response = array();
if (isset($data['PhoneNumber']) && isset($data['OTP'])) {

    $dbh = new Dbh();
    $master_conn = $dbh->_connectodb();

    $authentication = new Authentication($master_conn);
    $data['PhoneNumber'] = $data['PhoneNumber'];
    $data['OTP'] = $data['OTP'];
    $response = checkOTP($master_conn, $data['PhoneNumber'], $data['OTP']);

    if ($response['error'] == false) {
        $response_login = $authentication->mobilelogin($data);
        if ($response_login['error'] == false) {
            $core = new Core();
            $where = " where OrgID = 1";
            $org_module_details = $core->_getTableDetails($master_conn, 'org_module_mapping', $where);
            $router = new Router($org_module_details);
            $conn_client = $router->_connectodb();
            $roles = $router->Client_GetUserRole($response_login['data']['UserID']);

            $user_ID = $response_login['data']['UserID'];

            $sql = "SELECT * FROM `all_customer` ac LEFT JOIN `customerpolicy` cp ON ac.ID = cp.CustomerID WHERE ac.UserID =  $user_ID  ";

            $barcodedata = $core->_getSQLDetails($conn, $sql);
            $response['message'] = "Authentication done";
            //print_r($roles);
            $user_data = array(
                "user_id" => $response_login['data']['UserID'],
                "username" => $response_login['username'],
                "IsBarcode" => $barcodedata['IsBarcode']
            );
            $expiration_time = time() + (100 * 365 * 24 * 60 * 60);
            // Generate JWT
            $token = array(
                "iss" => "uhl.digitalworkdesk.com",
                "aud" => "uhl",
                "iat" => time(),
                "exp" => $expiration_time,
                "data" => $user_data
            );
            $jwt = JWT::encode($token, $secret_key, 'HS512');
            $response['token'] = $jwt;
            $response['role'] = $roles[0]['Role'];
            $response['IsBarcode'] = $barcodedata['IsBarcode'];

        } else {
            $response['error'] = true;
            $response['message'] = "Invalid Credentials";
        }

    }

} else {
    $response['error'] = true;
    $response['message'] = "Missing User Fields!";
}
$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>