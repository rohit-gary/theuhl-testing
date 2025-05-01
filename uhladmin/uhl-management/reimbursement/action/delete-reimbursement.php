<?php
@session_start();

require_once "../../include/autoloader.inc.php";
include "../../include/get-db-connection.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'debug.log');

// Check if user is logged in
if (!isset($_SESSION["dwd_email"])) {
    echo json_encode([
        "error" => true,
        "message" => "Please login to continue"
    ]);
    exit;
}

// Check if ID is provided
if (!isset($_POST["id"]) || empty($_POST["id"])) {
    echo json_encode([
        "error" => true,
        "message" => "Invalid reimbursement ID"
    ]);
    exit;
}

$id = intval($_POST["id"]);

// Get user type
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

// Check if user has permission to delete
if ($UserType != "Admin" && $UserType != "Client Admin" && $UserType != "Policy Customer") {
    echo json_encode([
        "error" => true,
        "message" => "You don't have permission to delete reimbursement records"
    ]);
    exit;
}

try {
    // Create reimbursement object
    $reimbursement = new Reimbursement($conn);
    
    // Check if record exists and belongs to the user (for non-admin users)
    if ($UserType != "Admin" && $UserType != "Client Admin") {
        $record = $reimbursement->GetReimbursementByID($conn, "customer_reimbursement", $id);
        if (!$record) {
            echo json_encode([
                "error" => true,
                "message" => "Reimbursement record not found"
            ]);
            exit;
        }
        
        // Check if the record belongs to the logged-in user
        $policyCustomer = new PolicyCustomer($conn);
        $policyNumbers = $policyCustomer->PolicyDetailsByUserID($_SESSION["dwd_UserID"]);
        $userPolicyNumbers = array_map(function($policy) {
            return $policy["PolicyNumber"];
        }, $policyNumbers);
        
        if (!in_array($record["PolicyNumber"], $userPolicyNumbers)) {
            echo json_encode([
                "error" => true,
                "message" => "You don't have permission to delete this record"
            ]);
            exit;
        }
    }
    
    // Delete the record (soft delete by setting IsActive = 0)
    $result = $reimbursement->DeleteReimbursement($conn, "customer_reimbursement", $id);
    
    if ($result) {
        echo json_encode([
            "error" => false,
            "message" => "Reimbursement record deleted successfully"
        ]);
    } else {
        echo json_encode([
            "error" => true,
            "message" => "Error deleting reimbursement record"
        ]);
    }
} catch (Exception $e) {
    error_log("Error in delete-reimbursement.php: " . $e->getMessage());
    echo json_encode([
        "error" => true,
        "message" => "An error occurred: " . $e->getMessage()
    ]);
}
?> 