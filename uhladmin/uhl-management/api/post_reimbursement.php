<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);

// Include required files
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");

// Initialize configuration and utility objects
$conf = new Configuration();
$core = new Core();
$core->setTimeZone();
$secret_key = $conf->getJWTKey();
$logs = new Logs();
$logs->SetCurrentAPILogFile();

// Read and log raw input data
$data_raw = file_get_contents('php://input');
$logs->WriteLog($data_raw, __FILE__, __LINE__);

// Decode JSON input into an associative array
$data = json_decode($data_raw, true);

// Initialize response
$response = ["error" => true, "message" => "An unknown error occurred."];



// Validate required fields individually using isset()
if (isset($data['token'])&&
    isset($data['HospitalName']) && !empty($data['HospitalName']) &&
    isset($data['PolicyNumber']) && !empty($data['PolicyNumber']) &&
    isset($data['CheckupDate']) && !empty($data['CheckupDate']) &&
    isset($data['CheckupCost']) && !empty($data['CheckupCost']) &&
    isset($data['Reason']) && !empty($data['Reason'])
   
) {

    $jwt = $data['token'];        
    // Add created time and date
    $data["CreatedTime"] = date("H:i:s");
    $data["CreatedDate"] = date("Y-m-d");

     $TempImageID='';
    if(isset($data['TempImageID']))
        {
          
            {
                $TempImageID = $data['TempImageID'];
            }
           
        }

    try {
        

         $token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
         $username = $token_decoded->data->username;
         $userId = $token_decoded->data->user_id;
    
           $data['username'] = $username;
           $data['ID'] = $userId;
            $rowData = [
            "HospitalName"    => $data["HospitalName"],
            "PolicyNumber"      => $data["PolicyNumber"],
            "CheckupDate"          => $data["CheckupDate"],
            "CheckupCost"     => $data["CheckupCost"],
            "Reason"           => $data["Reason"],
            "CreatedDate"     => $data["CreatedDate"],
            "CreatedTime"     => $data["CreatedTime"],
            "TempImageID"    =>  $TempImageID
        ];

        // Insert data into the database
        $result = $core->_InsertTableRecords_prepare($conn, "customer_reimbursement", $rowData);

        // Respond with success
        $response['error'] = false;
        $response['data'] = $result;
        $response['message'] = "Record successfully inserted.";
    } catch (Exception $e) {
       $response['error'] = true;
        $response['message'] = "Invalid Token";
    }
} else {
   $response['error'] = true;
    $response['message'] = "Missing User Field";
}

// Log and return the response
$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
