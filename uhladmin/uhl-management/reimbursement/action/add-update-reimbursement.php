<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

if (isset($_POST['policy_number'])) {
    $reimbursement_obj = new Reimbursement($conn);
    $data = $_POST;

    if ($data['form_action'] != "Update") {
        $data['CreatedDate'] = date("Y-m-d");
        $data['CreatedTime'] = date("H:i:s");
        $data['CreatedBy'] = $_SESSION['dwd_email'];

        // Handle file uploads
        $uploadedFiles = [];
        $policyNumber = $data['policy_number'];
        $uploadDirectory = '../../reimbursement-media/';

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        foreach ($_FILES['checkup_documents']['tmp_name'] as $index => $tmpName) {
            if ($_FILES['checkup_documents']['error'][$index] == UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($_FILES['checkup_documents']['name'][$index], PATHINFO_EXTENSION);
                $uniqueFileName = $policyNumber . '_' . uniqid() . '.' . $fileExtension;
                $targetFilePath = $uploadDirectory . $uniqueFileName;

                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    $uploadedFiles[] = $uniqueFileName;  // Store only the file name
                }
            }
        }

        $data['documents'] = json_encode($uploadedFiles);  // Convert file names to JSON for storage
        $response = $reimbursement_obj->InsertReimbursementForm($data);

        if ($response['error'] == false) {
            $response['message'] = "Reimbursement Record Created!";
        } else {
            $response['error'] = true;
            $response['message'] = "Some Technical Error! Please Try Again.";
        }
    } else {
        $response = $service_obj->UpdateServiceDetails($data);
    }
} else {
    $response['error'] = true;
    $response['message'] = "Some Technical Error! Please Try Again.";
}

echo json_encode($response);
?>
