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
  // Assuming the columns in CSV are:
  // Column 1: Code, Column 2: Test Name, Column 3: Test Category, Column 4: Billing Rate

  $TestCode = $data[0];  // Test Code
  $TestName = $data[1];  // Test Name
  $TestCategoryName = $data[2];  // Test Category Name from CSV
  $TestFee = $data[3];  // Billing Rate (Test Fee)

  // Check if the TestCategoryName already exists in the database
  $where = "WHERE TestCategoryName = '$TestCategoryName'";
  $TestCatdetails = $core->_getTableDetails($conn, 'test_category', $where);

  // If the category exists, get the TestCategory ID
  if ($TestCatdetails != null) {
    $TestCategoryID = $TestCatdetails['ID'];  // Fetch the ID of the existing category
    echo "<br>Test Category '$TestCategoryName' already exists with ID $TestCategoryID. Using existing category.";
  } else {
    // If category doesn't exist, insert it
    $insert_category_query = "INSERT INTO test_category (TestCategoryName, CreatedDate, CreatedTime, CreatedBy, IsActive) 
                                  VALUES ('$TestCategoryName', '$CreatedDate', '$CreatedTime', '{$_SESSION['dwd_email']}', 1)";
    if (mysqli_query($conn, $insert_category_query)) {
      $TestCategoryID = mysqli_insert_id($conn);  // Get the ID of the newly inserted category
      echo "<br>Test Category '$TestCategoryName' inserted with ID $TestCategoryID.";
    } else {
      echo "<br>Error inserting Test Category '$TestCategoryName'.";
      continue;  // Skip this row and move to the next one
    }
  }

  // Insert into doc_test table with the fetched or newly inserted TestCategoryID
  $insert_test_query = "INSERT INTO doc_test (TestCode, TestName, TestCategory, TestFee, CreatedDate, CreatedTime, CreatedBy, IsActive) 
                          VALUES ('$TestCode', '$TestName', '$TestCategoryID', '$TestFee', '$CreatedDate', '$CreatedTime', '{$_SESSION['dwd_email']}', 1)";

  if (mysqli_query($conn, $insert_test_query)) {
    echo "<br>Test '$TestName' inserted successfully.";
  } else {
    echo "<br>Error inserting Test '$TestName'.";
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