<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$response = array();
$response['error'] = true;

if (isset($_POST)) {
    // Decrypt the Policy ID
    $encrypt = new Encryption();
    $PolicyID = $idParam = $_POST['Id'] ?? $_GET['Id'];

    try {
        // Decrypt the PolicyID
        //$PolicyID = $encrypt->decrypt_message($idParam);

        //echo $PolicyID;
       
    } catch (Exception $e) {
        // If decryption fails, fallback to original ID
      /*  $PolicyID = $idParam;
        echo $PolicyID;
        die();*/
    }

    // Now that we have the decrypted PolicyID, let's get the payment status
    $PolicyCustomer = new PolicyCustomer($conn);
    $response_data = $PolicyCustomer->checkPaymentStatusByPolicyNumber($PolicyID);
    //print_r($response_data);

    if ($response_data == true) {
        $response['error'] = false;
       
    } else {
        $response['message'] = "Payment is not yet completed. Policy doc will be generated after the payment is completed";
    }
} else {
    $response['message'] = "Some technical error occurred! Please try again.";
}

// Return the response as JSON
echo json_encode($response);
?>
