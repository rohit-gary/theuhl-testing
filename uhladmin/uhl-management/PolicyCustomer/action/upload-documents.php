<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

if (isset($_POST['policy_number'])) {
    $policycustomer_obj = new PolicyCustomer($conn);
    $data = $_POST;

    // print_r($_POST);
    // die();

    if ($data['form_action'] != "Update") {
        $data['CreatedDate'] = date("Y-m-d");
        $data['CreatedTime'] = date("H:i:s");
        $data['CreatedBy'] = $_SESSION['dwd_email'];

        // Handle file uploads
        $uploadedFiles = [];
        $policyNumber = $data['policy_number'];
        $policyID = $data['policy_ID'];
        $uploadDirectory = '../documents/';

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        foreach ($_FILES['policy_documentss']['tmp_name'] as $index => $tmpName) {
            if ($_FILES['policy_documentss']['error'][$index] == UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($_FILES['policy_documentss']['name'][$index], PATHINFO_EXTENSION);
                $uniqueFileName = $policyNumber . '_' . uniqid() . '.' . $fileExtension;
                $targetFilePath = $uploadDirectory . $uniqueFileName;

                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    $uploadedFiles[] = $uniqueFileName;  // Store only the file name

                }
            }
        }

        $data['documents'] = json_encode($uploadedFiles);  // Convert file names to JSON for storage
        $response = $policycustomer_obj->InsertPolicyDocuments($data);

        if($response['error']==false){
            $familyMemberID=$data['familyMemberSelect'];
             if (!isset($_SESSION['family_member_documents'][$familyMemberID])) {
                    $_SESSION['family_member_documents'][$familyMemberID] = [];
                }
              $_SESSION['family_member_documents'][$familyMemberID] = array_merge($_SESSION['family_member_documents'][$familyMemberID], $uploadedFiles); 
        }

        if ($response['error'] == false) {
            $response['message'] = "Documents Uploded!";
        } else {
            $response['error'] = true;
            $response['message'] = "Some Technical Error! Please Try Again.";
        }
    } else {
        $response = $service_obj->UpdatePolicyDocuments($data);
    }
} else {
    $response['error'] = true;
    $response['message'] = "Some Technical Error! Please Try Again.";
}

echo json_encode($response);
?>
