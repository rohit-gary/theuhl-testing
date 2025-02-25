<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$core = new Core();
$core->setTimeZone();

if (isset($_POST['id'])) {
  $test_obj = new Test($conn);
  $data = $_POST;

  $deleteResult = $test_obj->DeleteTestReportFile($data);


  // Ensure response is always an array
  $response = [
    'error' => !$deleteResult, // false if success, true if failed
    'message' => $deleteResult ? "Report Deleted Successfully!" : "Some Technical Error! Please Try Again."
  ];

  echo json_encode($response);
}


?>