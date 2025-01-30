<?php
@session_start();
require_once('../../include/autoloader.inc.php');

include("../../include/get-db-connection.php");
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$core = new Core();
$core->setTimeZone();

if (true) {
  $test_obj = new Test($conn);
  $data = $_POST;

  if ($data['form_action_test_cat'] != "Update") {
    $data['CreatedDate'] = date("Y-m-d");
    $data['CreatedTime'] = date("H:i:s");
    $data['CreatedBy'] = $_SESSION['dwd_email'];

    if (isset($_FILES['import_file']) && $_FILES['import_file']['error'] == 0) {
      $fileName = $_FILES['import_file']['name'];
      $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

      if ($file_ext === 'csv') {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];

        // Open the CSV file
        if (($handle = fopen($inputFileNamePath, "r")) !== FALSE) {
          $firstRow = true;
          $msg = false;

          // Read each line of the CSV file
          while (($row = fgetcsv($handle)) !== FALSE) {
            if (!$firstRow) {  // Skip the header row
              // Assuming TestCategoryName is in the third column (index 2)
              $TestCategoryName = mysqli_real_escape_string($conn, $row[2]);

              $TestCatQuery = "INSERT INTO test_category (TestCategoryName) VALUES ('$TestCategoryName')";
              if (mysqli_query($conn, $TestCatQuery)) {
                $msg = true;
              }
            } else {
              $firstRow = false;
            }
          }
          fclose($handle);

          if ($msg) {
            $_SESSION['message'] = "Successfully Imported";
          } else {
            $_SESSION['message'] = "No Data Imported";
          }
        } else {
          $_SESSION['message'] = "Error Reading CSV File";
        }
        header('Location: ../view-configuration');
        exit();
      } else {
        $_SESSION['message'] = "Please Upload CSV File Only";
        header('Location: ../view-configuration');
        exit();
      }
    } else {
      $_SESSION['message'] = "File Upload Error";
      header('Location: ../view-configuration');
      exit();
    }
  } else {
    $response = $test_obj->UpdateTestCatsDetails($data);
  }
} else {
  $response = [
    'error' => true,
    'message' => "Some Technical Error! Please Try Again."
  ];
}

echo json_encode($response);
?>