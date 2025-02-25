<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

if (isset($_POST['order_ID'])) {
  $test_obj = new Test($conn);
  $data = $_POST;
  if ($data['form_action'] != "Update") {
    $data['CreatedDate'] = date("Y-m-d");
    $data['CreatedTime'] = date("H:i:s");
    $data['CreatedBy'] = $_SESSION['dwd_email'];
    $uploadedFiles = [];
    $testID = $data['order_ID'];
    $bookingID = $data['booking_ID'];
    $uploadDirectory = '../bookedreport/';
    if (!is_dir($uploadDirectory)) {
      mkdir($uploadDirectory, 0777, true);
    }
    if (isset($_FILES['report']) && $_FILES['report']['error'] == UPLOAD_ERR_OK) {
          $fileExtension = pathinfo($_FILES['report']['name'], PATHINFO_EXTENSION);
          $uniqueFileName = $bookingID . '_' . uniqid() . '.' . $fileExtension;
          $targetFilePath = $uploadDirectory . $uniqueFileName; 

          if (move_uploaded_file($_FILES['report']['tmp_name'], $targetFilePath)) {
              $uploadedFile = $targetFilePath; 
          } else {
              echo json_encode(["error" => true, "message" => "Failed to upload file."]);
              exit;
          }
      } else {
          $uploadedFile = ""; 
      }

    $data['documents'] = $uniqueFileName;
    $response = $test_obj->InsertTestReportFile($data);

    if ($response['error'] == false) {
       $response['message'] = "Documents Uploded!";
       $response['error'] = false;
    }
     else {
      $response['error'] = true;
      $response['message'] = "Some Technical Error! Please Try Again.";
    }
  } 
  else {
    $response = $service_obj->UpdateServiceDetails($data);
  }
} 
else {
  $response['error'] = true;
  $response['message'] = "Some Technical Error! Please Try Again.";
}

echo json_encode($response);
?>