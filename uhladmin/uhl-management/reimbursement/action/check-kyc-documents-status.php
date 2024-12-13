<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

$PolicyID = $_GET['policyID']; 

$policyCustomer = new PolicyCustomer($conn);
$PolicyMemberDetails = $policyCustomer->getPolicyCustomerMemberDetailsByPolicyID($PolicyID);
$PolicyDocumentsDetails = $policyCustomer->getPolicyDocumentsDetailsByPolicyID($PolicyID);

// Initialize response
$response = ['error' => false, 'message' => 'Documents are valid.'];

if (empty($PolicyMemberDetails)) {
    // If no member details found, check for PolicyDocumentsDetails
    if (empty($PolicyDocumentsDetails)) {
        $response['error'] = true;
        $response['message'] = "Please upload documents for KYC.";
    } 
} else {
    // If member details are found, check each member for document status
    foreach ($PolicyMemberDetails as $member) {
        // If any member document is missing (NULL), return an error response
        if ($member['Document'] == NULL) {
            $response['error'] = true;
            $response['message'] = "Please upload all documents for KYC.";
            break; // Stop further checking once we find a missing document
        }
    }
    
    // If PolicyDocumentsDetails is empty, also set error response
    if (empty($PolicyDocumentsDetails)) {
        $response['error'] = true;
        $response['message'] = "Please upload documents for KYC.";
    }
}

// Send the JSON response back to the frontend
echo json_encode($response);
?>
