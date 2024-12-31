<?php
var_dump($_POST);   
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();
// var_dump($_FILES); // For debugging the uploaded files
// die(); // Temporarily halt the script to check the output

if (isset($_POST['PolicyNumber'])) {
    $policycustomer_obj = new PolicyCustomer($conn);
    $data = $_POST;
    $policyID = '';
    
    // var_dump($data);
    // die();

    // Handle the form data (e.g., family member, document type, etc.)
    if ($data['form_action'] != "Update") {
        $data['CreatedDate'] = date("Y-m-d");
        $data['CreatedTime'] = date("H:i:s");
        $data['CreatedBy'] = $_SESSION['dwd_email'];

        // Handle file uploads
        $uploadedFiles = [];
        $policyNumber = $data['PolicyNumber'];
        $policyID = $data['policy_ID'];
        $uploadDirectory = '../documents/';

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Loop through the uploaded files and move them to the server
        foreach ($_FILES['policy_documents']['tmp_name'] as $index => $tmpName) {
            if ($_FILES['policy_documents']['error'][$index] == UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($_FILES['policy_documents']['name'][$index], PATHINFO_EXTENSION);
                $uniqueFileName = $policyNumber . '_' . uniqid() . '.' . $fileExtension;
                $targetFilePath = $uploadDirectory . $uniqueFileName;

                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    $uploadedFiles[] = $uniqueFileName;  // Store only the file name
                }
            }
        }

        // Convert the array of uploaded files to JSON for storage
        $data['documents'] = json_encode($uploadedFiles);

        // Save the data to the database
        $response = $policycustomer_obj->InsertPolicyDocuments($data);

        if ($response['error'] == false) {
            $response['message'] = "Documents Uploaded!";
        } else {
            $response['error'] = true;
            $response['message'] = "Some technical error! Please try again.";
        }
    } else {
        $response = $service_obj->UpdateServiceDetails($data);
    }
} else {
    $response['error'] = true;
    $response['message'] = "Some technical error! Please try again.";
}

echo json_encode($response);
?>
