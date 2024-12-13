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
    isset($data["PolicyCustomerID"]) &&
    isset($data["PolicyNumber"]) &&
    isset($data["Name"]) &&
    isset($data["DateOfBirth"]) &&
    isset($data["Gender"]) &&
    isset($data["Relationship"])
) {
    // Calculate age from DateOfBirth
    $dob = new DateTime($data["DateOfBirth"]);
    $today = new DateTime();
    $age = $dob->diff($today)->y; // Calculate the difference in years to get the age

    // Prepare row data
    $rowData = [
        "PolicyCustomerID" => $data["PolicyCustomerID"],
        "PolicyNumber" => $data["PolicyNumber"],
        "Name" => $data["Name"],
        "DateOfBirth" => $data["DateOfBirth"],
        "Age" => $age, // Set the calculated age
        "Gender" => $data["Gender"],
        "Relationship" => $data["Relationship"],
        "CreatedDate" => date("Y-m-d"),
        "CreatedTime" => date("H:i:s"),
        "CreatedBy" => isset($_SESSION["dwd_email"]) ? $_SESSION["dwd_email"] : "admin@uhl",
    ];

    // Insert into database
    $PolicyCustomer_obj = new PolicyCustomer($conn);
    $insertResult = $PolicyCustomer_obj->_InsertTableRecords_prepare(
        $conn,
        "policy_member_details", // Replace with your actual table name
        $rowData
    );

    if ($insertResult) {
        // Success response
        $response["error"] = false;
        $response["message"] = "Member inserted successfully.";
    } else {
        // Handle insertion failure
        $response["error"] = true;
        $response["message"] = "Failed to insert member.";
    }
} else {
    // Return error for missing fields
    $response["error"] = true;
    $response["message"] = "Missing required fields. Ensure 'PolicyCustomerID', 'PolicyNumber', 'Name', 'DateOfBirth', 'Gender', and 'Relationship' are provided.";
}

// Log and output response
$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
