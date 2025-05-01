<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '../../logs/php-error.log');

// Create logs directory if it doesn't exist
$logDir = '../../logs';
if (!file_exists($logDir)) {
    mkdir($logDir, 0777, true);
}

require_once "../../include/autoloader.inc.php";
include "../../include/get-db-connection.php";

header('Content-Type: application/json');

// Log the start of the script
error_log("=== Starting update-reimbursement-status.php ===");
error_log("POST data received: " . print_r($_POST, true));

// Check if user is logged in and has appropriate permissions
try {
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();
    
    if ($UserType != "Admin" && $UserType != "Client Admin") {
        error_log("Unauthorized access attempt by user type: " . $UserType);
        echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
        exit;
    }
} catch (Exception $e) {
    error_log("Authentication error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Authentication error']);
    exit;
}

// Validate input
if (!isset($_POST['ReimbursementID']) || !isset($_POST['Status'])) {
    error_log("Missing required parameters. POST data: " . print_r($_POST, true));
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

// Decrypt the ReimbursementID
try {
    $encrypt = new Encryption();
    $ReimbursementID = $encrypt->decrypt_message($_POST['ReimbursementID']);
    error_log("Decrypted ReimbursementID: " . $ReimbursementID);
} catch (Exception $e) {
    error_log("Error decrypting ReimbursementID: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Invalid reimbursement ID']);
    exit;
}

$status = $_POST['Status'];
$comments = isset($_POST['Comment']) ? trim($_POST['Comment']) : '';

error_log("Processing update with:");
error_log("Status: " . $status);
error_log("Comments: " . $comments);

// Validate status
if (!in_array($status, ['Complete', 'Rejected'])) {
    error_log("Invalid status received: " . $status);
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
    exit;
}

// Update the reimbursement status
try {
    $reimbursement = new Reimbursement($conn);
    $result = $reimbursement->UpdateReimbursementStatus($conn, $ReimbursementID, $status, $comments);
    
    if ($result) {
        error_log("Update successful for ReimbursementID: " . $ReimbursementID);
        echo json_encode(['success' => true]);
    } else {
        error_log("Failed to update status for ReimbursementID: " . $ReimbursementID);
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} catch (Exception $e) {
    error_log("Error in update-reimbursement-status.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

error_log("=== End of update-reimbursement-status.php ===");