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
$dir = fopen("new-test-rate.csv", "r");
$k = 0;
while (($data = fgetcsv($dir, 1000, ",")) !== FALSE) {

  $TestCode = $data[0];  
  $TestName = $data[1];  
  $type = $data[2];  
  $TestFee = $data[3];  

  $where = "WHERE TestCode = '$TestCode'";
  $TestCatdetails = $core->_getTableDetails($conn, 'doc_test', $where);
  $TestCategoryID='-1';
  // If the category exists, get the TestCategory ID
  if ($TestCatdetails != null) {
    $TestCode = $TestCatdetails['TestCode'];  // Fetch the ID of the existing category
    echo "<br>Test Category '$TestName' already exists with ID $TestCode. Using existing Test Code.";
  } else 
  {
    if($type=='test')
    {

         $insert_test_query = "INSERT INTO doc_test (TestCode, TestName, TestCategory, TestFee, CreatedDate, CreatedTime, CreatedBy, IsActive) 
                                VALUES ('$TestCode', '$TestName', '$TestCategoryID', '$TestFee', '$CreatedDate', '$CreatedTime', '{$_SESSION['dwd_email']}', 1)";
        if (mysqli_query($conn, $insert_test_query)) 
        {
          echo "<br>Test '$TestName' inserted successfully.";
        }
         else
         {
          echo "<br>Error inserting Test '$TestName'.";
         }
    }
  }
  $k++;
  if ($k == 2500) {
    break;
  }
}

// Close the CSV file after processing
fclose($dir);
?>