<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

$response = ['error' => true, 'message' => "Some Technical Error! Please Try Again."]; // Default response

if (isset($_POST['policy_id'])) {
    $data = $_POST;
    
    // Initialize the Transaction object
    $Transaction_obj = new Transaction($conn);
    
    // Call insertPaymentsDetails method and capture the response
    $response = $Transaction_obj->insertPaymentsDetails($data);
    print_r($response);
    die();
    
    // Check if there was no error and update the response accordingly
    if ($response['error'] == false) {
        $response['message'] = "Payment Details Saved!";
        $response['error'] = false;
    } else {
        $response['message'] = isset($response['message']) ? $response['message'] : "Some error occurred while saving the payment details.";
    }
}

// Output the response as JSON
echo json_encode($response);
?>
