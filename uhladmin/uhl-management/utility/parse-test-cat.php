<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../include/get-db-connection.php");
$core = new Core();
$core->setTimeZone();
$CreatedDate = date("Y-m-d");
$CreatedTime = date("H:i:s");
$test_obj = new Test($conn);

// Open the CSV file for reading
$dir = fopen("Test.csv", "r");
$k = 0;
while (($data = fgetcsv($dir, 1000, ",")) !== FALSE) {
  // Assuming TestCategoryName is in the third column (index 2)
  $TestCategoryName = $data[2];

  // Check if the TestCategoryName already exists in the database
  $where = "WHERE TestCategoryName = '$TestCategoryName'";
  $TestCatdetails = $core->_getTableDetails($conn, 'test_category', $where);

  // If the category already exists, skip the insert
  if ($TestCatdetails != null) {
    echo "<br>Test Category '$TestCategoryName' already exists. Skipping insert.";
  } else {
    // Insert the new Test Category into the database
    $insert_query = "INSERT INTO test_category (TestCategoryName, CreatedDate, CreatedTime, CreatedBy, IsActive) 
                         VALUES ('$TestCategoryName', '$CreatedDate', '$CreatedTime', '{$_SESSION['dwd_email']}', 1)";
    if (mysqli_query($conn, $insert_query)) {
      echo "<br>Test Category '$TestCategoryName' inserted successfully.";
    } else {
      echo "<br>Error inserting Test Category '$TestCategoryName'.";
    }
  }

  $k++;
  // Optionally, limit the number of records processed (e.g., 2500)
  if ($k == 2500) {
    break;
  }
}

// Close the CSV file after processing
fclose($dir);
?>