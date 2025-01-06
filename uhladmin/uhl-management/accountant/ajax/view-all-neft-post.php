<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$Transaction_obj = new Transaction($conn); 
$loggedin_email = $_SESSION['dwd_email'];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

$role = '';
if (isset($_SESSION['roles']) && is_array($_SESSION['roles']) && !empty($_SESSION['roles'])) {
    $role = $_SESSION['roles'][0]['Role']; // Access the Role field
}

$RoleType = $authentication->CheckRole($role);

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; 
$searchValue = $_POST['search']['value']; 

$columnName = "created_at"; // Change this to match the column you're sorting by
$columnSortOrder = "DESC"; // Order by created_at (you can adjust it as needed)

## Escape search value to prevent SQL injection
$searchValue = mysqli_real_escape_string($conn, $searchValue);

## Search query
$searchQuery = "";
if ($searchValue != '') {
    $searchQuery = " AND (name LIKE '%" . $searchValue . "%' 
                        OR phone LIKE '%" . $searchValue . "%' 
                        OR razorpay_payment_id LIKE '%" . $searchValue . "%' 
                        OR razorpay_order_id LIKE '%" . $searchValue . "%' 
                        OR cp.PolicyNumber LIKE '%" . $searchValue . "%')";
}

## Filter for NEFT payments
$filter = " WHERE p.PaymentMode = 'NEFT'";  

$filter .= $searchQuery;

## Total number of records with filtering
$sql_count = "SELECT COUNT(*) as row_count 
              FROM payments p 
              LEFT JOIN PaymentBankDetail pb ON p.id = pb.PaymentID
              LEFT JOIN customerpolicy cp ON p.PolicyNumber = cp.PolicyNumber" . $filter;
$result_Count = mysqli_query($conn, $sql_count);
if (!$result_Count) {
    die("Query failed: " . mysqli_error($conn));
}

$row_count_result = $result_Count->fetch_assoc();
$totalRecordwithFilter = $row_count_result['row_count'];

## Pagination and ordering
$filter .= " ORDER BY " . $columnName . " " . $columnSortOrder;
$filter .= " LIMIT " . $row . "," . $rowperpage;

## Fetch transaction records
$sql = "SELECT 
            p.id AS payment_id, 
            p.razorpay_payment_id AS TransactionID, 
            p.razorpay_order_id AS OrderID, 
            p.amount, 
            p.name, 
            p.phone, 
            p.status, 
            p.PolicyNumber,
            pb.AccountNumber, 
            pb.IFSCCode, 
            p.created_at AS Date, 
            cp.PolicyNumber
        FROM payments p
        LEFT JOIN PaymentBankDetail pb ON p.id = pb.PaymentID
        LEFT JOIN customerpolicy cp ON p.PolicyNumber = cp.PolicyNumber
        WHERE p.PaymentMode = 'NEFT'" . $searchQuery . 
        " ORDER BY " . $columnName . " " . $columnSortOrder . 
        " LIMIT " . $row . "," . $rowperpage;

$result = mysqli_query($conn, $sql);

$transaction_details_arr = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $transaction_details_arr[] = $row;
    }
}

## Prepare the data for the response
$data = [];
foreach ($transaction_details_arr as $transaction_details_value) {
    $data[] = [
        "id" => $transaction_details_value['payment_id'],
        "PolicyNumber"=>$transaction_details_value['PolicyNumber'],
        "TransactionID" => $transaction_details_value['TransactionID'],
        "OrderID" => $transaction_details_value['OrderID'],
        "Amount" => number_format($transaction_details_value['amount'], 2),
        "Name" => $transaction_details_value['name'],
        "Phone" => $transaction_details_value['phone'],
        "Status" => $transaction_details_value['status'],
        "AccountNumber" => $transaction_details_value['AccountNumber'],
        "IfscCode" => $transaction_details_value['IFSCCode'],
        "Date" => date("Y-m-d H:i:s", strtotime($transaction_details_value['Date'])),
        "PolicyNumber" => $transaction_details_value['PolicyNumber'],
         "Action" => '<button class="btn btn-primary" onclick="sendNeftPolicyDoc(\'' . $transaction_details_value['PolicyNumber'] . '\')">Send Policy Doc</button>',
    ];
}

## Prepare the JSON response
$response = [
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecordwithFilter,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data,
];

echo json_encode($response);
?>
