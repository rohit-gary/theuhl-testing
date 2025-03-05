<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once "common_api_header.php";
require_once "../../vendor/autoload.php";
require_once "../include/autoloader.inc.php";
require_once "../include/db-connection.php";

$logs = new Logs();
$logs->SetCurrentAPILogFile();

// Get raw POST data
$data_raw = file_get_contents("php://input");
$logs->WriteLog($data_raw, __FILE__, __LINE__);
$data = json_decode($data_raw, true);
$response = [];

// Validate required fields
if (isset($data["Name"]) && isset($data["PhoneNumber"])) {
     $PolicyCustomer_obj = new PolicyCustomer($conn);
     $master = new PolicyCustomer($master_conn);
    // Set default email if empty
    $data['email'] = isset($data['Email']) && !empty(trim($data['Email'])) ? $data['Email'] : " ";
    $data['username'] = $data["Name"];
    $data['name']=$data["Name"];
    $data['phone_number']=$data["PhoneNumber"];
    $data['OrgID']=1;
    $data['password']=1234;


    $masterResponse = $master->InsertMasterPolicyUser($data);

    if (!isset($masterResponse["last_insert_id"])) {
        $response["error"] = true;
        $response["message"] = "Failed to insert master policy user.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }

    $userId = $masterResponse["last_insert_id"];
    
    $roleInserted = $PolicyCustomer_obj->InsertUserRole($userId);
    if (!$roleInserted) {
        $response["error"] = true;
        $response["message"] = "Failed to assign user role.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }

    $response['error'] = false;
    $response['message'] = "User Inserted Successfully";
    $response['last_insert_id'] = $userId;
} else {
    $response["error"] = true;
    $response["message"] = "Missing required fields.";
}

// Log and output response
$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
