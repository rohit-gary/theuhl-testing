<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$response = array();
$response['error'] = true;

if (isset($_POST)) {
    // Decrypt the Policy ID
    $encrypt = new Encryption();
    $idParam = $_POST['PolicyID'] ?? $_GET['PolicyID'];

    try {
        // Decrypt the PolicyID
        $PolicyID = $encrypt->decrypt_message($idParam);
       
    } catch (Exception $e) {
        // If decryption fails, fallback to original ID
        $PolicyID = $idParam;
        print_r($PolicyID);
        die();
    }

    // Now that we have the decrypted PolicyID, let's get the payment status
    $PolicyCustomer = new PolicyCustomer($conn);
    $response_data = $PolicyCustomer->checkPaymentStatusByPolicyID($PolicyID);

    
    
    if ($response_data == true) {
        $response['error'] = false;
        $response['message'] = "Payment successful!";  // Payment success message
    } else {
        $response['message'] = "Payment not completed yet or failed.";
    }
} else {
    $response['message'] = "Some technical error occurred! Please try again.";
}

// Return the response as JSON
echo json_encode($response);
?>
