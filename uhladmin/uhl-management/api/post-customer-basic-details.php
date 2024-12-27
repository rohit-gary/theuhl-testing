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
if (
    isset($data["Name"]) &&
    isset($data["ContactNumber"]) &&
    isset($data["Gender"]) &&
    isset($data["DateOfBirth"]) &&
    isset($data["Email"]) &&
    isset($data["State"])&&
    isset($data["Pincode"])&&
    isset($data["PresentAddress"])&&
    isset($data["PermanentAddress"])
) {


    $PolicyCustomer_obj = new PolicyCustomer($conn);
     $master = new PolicyCustomer($master_conn);
       // Prepare master data
    $masterData = [
        "name" => $data["Name"],
        "phone_number" => $data["ContactNumber"],
        "email" => $data["Email"],
        "OrgID" => 1,
        "password" => $data["DateOfBirth"],
    ];
     
     $masterResponse = $master->InsertMasterPolicyUser($masterData);
     $userId='-1';
    if (!isset($masterResponse["last_insert_id"])) {
        $response["error"] = true;
        $userId=$masterResponse["last_insert_id"];
        $response["message"] = "Failed to insert master policy user.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }


    $userId=$masterResponse["last_insert_id"];
    $roleInserted = $PolicyCustomer_obj->InsertUserRole($userId);
    if (!$roleInserted) {
        $response["error"] = true;
        $response["message"] = "Failed to assign user role.";
        $logs->WriteLog(json_encode($response), __FILE__, __LINE__);
        echo json_encode($response);
        exit();
    }

    // Prepare row data 
    $userId=$masterResponse["last_insert_id"];    
    $rowData = [
        "UserID"=>$userId,
        "Name" => $data["Name"],
        "ContactNumber" => $data["ContactNumber"],
        "Gender" => $data["Gender"],
        "DateOfBirth" => $data["DateOfBirth"],
        "Email" =>$data["Email"],// Set the calculated age
        "State" => $data["State"],
        "Address" => $data["PresentAddress"],
        "PermanentAddress" => $data["PermanentAddress"],
        "Pincode" => $data["Pincode"],   
        "CreatedBy" => isset($_SESSION["dwd_email"]) ? $_SESSION["dwd_email"] : "App",
        "CreatedDate" => date("Y-m-d"),
        "CreatedTime" => date("H:i:s")
        
    ];



    // Insert into database
    
    $insertResult = $PolicyCustomer_obj->_InsertTableRecords_prepare(
        $conn,
        "all_customer", // Replace with your actual table name
        $rowData
    );

    if ($insertResult) {
        // Success response
        $response["error"] = false;
        $response['CustomerID']=$insertResult['last_insert_id'];
        $response["message"] = "Customer Basic Details Inserted successfully.";
    } else {
        // Handle insertion failure
        $response["error"] = true;
        $response["message"] = "Failed to Insert Customer Basic Details.";
    }
} else {
    // Return error for missing fields
    $response["error"] = true;
    $response["message"] = "Missing required fields..";
}

// Log and output response
$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
