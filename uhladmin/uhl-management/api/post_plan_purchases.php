<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once "common_api_header.php";
require_once "../../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once "../include/autoloader.inc.php";
require_once "../include/db-connection.php";

$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents("php://input");
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw, __FILE__, __LINE__);
$data = json_decode($data_raw, true);
$response = [];

if (isset($data["Name"]) && isset($data["PlanID"]) && isset($data["ContactNumber"]) && isset($data["Email"])) {
    $PolicyCustomer_obj = new PolicyCustomer($conn);
    $master = new PolicyCustomer($master_conn);
    $prefix = "UHL";
    $randomNumber = mt_rand(100000, 999999);

    $PolicyNumber = $prefix . $randomNumber;
    $data["CreatedTime"] = date("H:i:s");
    $data["CreatedDate"] = date("Y-m-d");
    $data["CreatedBy"] = isset($_SESSION["dwd_email"]) ? $_SESSION["dwd_email"] : "FromApp";
    $data["PolicyNumber"] = $PolicyNumber;
    $data["email"]= $data["Email"];
    $data["poc_contact_number"]= $data["ContactNumber"];
    // Check for duplicate email or phone number
    if ($PolicyCustomer_obj->checkDuplicatePolicyCustomer($data)) {
        $response["error"] = true;
        $response["message"] = "Duplicate phone number or email found. Please use a different one.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }

    // Prepare master data
    $masterData = [
        "name" => $data["Name"],
        "email" => $data["Email"],
        "phone_number" => $data["ContactNumber"],
        "OrgID" => 1,
        "password" => $data["DateOfBirth"],
    ];

    // Insert into master table
    $masterResponse = $master->InsertMasterPolicyUser($masterData);
    if (!isset($masterResponse["last_insert_id"])) {
        $response["error"] = true;
        $response["message"] = "Failed to insert master policy user.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }

    // Assign role to the user
    $userId = $masterResponse["last_insert_id"];
    $roleInserted = $PolicyCustomer_obj->InsertUserRole($userId);
    if (!$roleInserted) {
        $response["error"] = true;
        $response["message"] = "Failed to assign user role.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }

    // Prepare policy_customer data
    $rowData = [
        "UserId" => $userId, // Use the last_insert_id from master insertion
        "PolicyNumber" => $PolicyNumber,
        "PlanID" => $data["PlanID"],
        "Name" => $data["Name"],
        "ContactNumber" => $data["ContactNumber"],
        "Gender" => $data["Gender"],
        "DateOfBirth" => $data["DateOfBirth"],
        "Email" => $data["Email"],
        "Address" => $data["Address"],
        "State" => $data["State"],
        "Pincode" => $data["Pincode"],
        "BuyingFor" => $data["BuyingFor"],
        "CreatedDate" => $data["CreatedDate"],
        "CreatedTime" => $data["CreatedTime"],
        "CreatedBy" => $data["CreatedBy"],
    ];

    // Insert into policy_customer table
    $policyResult = $PolicyCustomer_obj->_InsertTableRecords_prepare(
        $conn,
        "policy_customer",
        $rowData
    );
    if (!$policyResult) {
        $response["error"] = true;
        $response["message"] = "Failed to insert into policy_customer.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }
    $encrypt = new Encryption();
    $Policy_ID = $encrypt->encrypt_message($policyResult['last_insert_id']);
    // Success response
    $response["error"] = false;
    $response["data"] = [
        "policyResult" => $policyResult,
        "PolicyNumber" => $PolicyNumber,
        "EncPolicyID" => $Policy_ID,
    ];
} else {
    // Return error for missing fields
    $response["error"] = true;
    $response["message"] = "Missing Required Fields";
}

$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
