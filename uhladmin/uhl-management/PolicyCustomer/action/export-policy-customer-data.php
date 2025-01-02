<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$Policy = new PolicyCustomer($conn);
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

$state_obj = new State($conn);

$AllState = $state_obj->GetAllState();
$StateMap=[];
foreach ($AllState as $state) {
    $StateMap[$state['ID']] = $state['StateName'];
}


$sql = " WHERE IsActive = 1";
$params = [];

// Fetch data for export using prepared statements
// $customer_details_arr = $Career->GetAllCareerNewExcel($sql, $params); // Ensure this function handles prepared statements correctly
$customer_details_arr = $Policy->getAllPolicyCustomerDetails();

// print_r($customer_details_arr);
// die();
$output = '
   <table border="1" cellpadding="5" cellspacing="0">  
       <tr>   
            <th>No</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>State</th>
            <th>Pin Code</th>
            <th>Policy Number</th>
            <th>Created Date</th>
            <th>Plan Names</th>
            <th>Total Amount</th>
            <th>Payment Status</th>
       </tr>';


// Populate table rows with career data
    $count=1;
foreach ($customer_details_arr as $data) {
    $state_name = isset($StateMap[$data['sstate']]) ? $StateMap[$data['sstate']] : 'Unknown State';
    
     $paymentStatus = !empty($data['PaymentStatus']) ? $data['PaymentStatus'] : 'Pending';
    
    $output .= '<tr> 

            <td>' . $count++ . '</td>
            <td>' . $data['UserName'] . '</td>
            <td>' . $data['MobileNumber'] . '</td>
            <td>' . $data['Email'] . '</td>
            <td>' . $data['Address'] . '</td>
            <td>' . $state_name. '</td>
            <td>' . $data['PinCode'] . '</td>
            <td>' . $data['PolicyNumber'] . '</td>
            <td>' . $data['CreatedDate']. '</td>
            <td>' . $data['PlanNames']. '</td>
            <td>' . $data['TotalAmount'] . '</td>
            <td>' . $paymentStatus. '</td>
       
       
    </tr>';
}

$output .= '</table>'; // Close the table tag

// Write the output to a temporary file
$tempFile = tempnam(sys_get_temp_dir(), 'report_');
file_put_contents($tempFile, $output);

// Set headers to prompt download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="report.xls"');
readfile($tempFile);
unlink($tempFile); // Delete the temporary file
exit; // Terminate script after download
?>
