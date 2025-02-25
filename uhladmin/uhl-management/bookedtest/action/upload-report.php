<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

if (isset($_POST['report'])) {
  $test_obj = new Test($conn);
  $data = $_POST;

  print_r($_POST);
  die();

  if ($data['form_action'] != "Update") {
    $data['CreatedDate'] = date("Y-m-d");
    $data['CreatedTime'] = date("H:i:s");
    $data['CreatedBy'] = $_SESSION['dwd_email'];

    // Handle file uploads
    $uploadedFiles = [];
    $testID = $data['test_ID'];
    $uploadDirectory = '../bookedreport/';

    if (!is_dir($uploadDirectory)) {
      mkdir($uploadDirectory, 0777, true);
    }

    foreach ($_FILES['report']['tmp_name'] as $index => $tmpName) {
      if ($_FILES['report']['error'][$index] == UPLOAD_ERR_OK) {
        $fileExtension = pathinfo($_FILES['report']['name'][$index], PATHINFO_EXTENSION);
        $uniqueFileName = $testID . '_' . uniqid() . '.' . $fileExtension;
        $targetFilePath = $uploadDirectory . $uniqueFileName;

        if (move_uploaded_file($tmpName, $targetFilePath)) {
          $uploadedFiles[] = $uniqueFileName;  // Store only the file name
        }
      }
    }

    $data['documents'] = json_encode($uploadedFiles);  // Convert file names to JSON for storage
    $response = $test_obj->InsertTestReport($data);

    if ($response['error'] == false) {
      $response['message'] = "Documents Uploded!";
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
-