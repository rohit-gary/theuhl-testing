<?php
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
                        OR pc.PolicyNumber LIKE '%" . $searchValue . "%')";
}

## Filter for active transactions
$filter = " WHERE p.status = 'Success'";  // Add filter for successful transactions

$filter .= $searchQuery;

## Total number of records with filtering
$sql_count = "SELECT COUNT(*) as row_count 
              FROM payments p 
              LEFT JOIN policy_customer pc ON p.policyID = pc.ID" . $filter;
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
$sql = "SELECT p.*, pc.PolicyNumber 
        FROM payments p 
        LEFT JOIN (SELECT DISTINCT PolicyNumber FROM customerpolicy) pc 
    ON p.PolicyNumber = pc.PolicyNumber " . $filter;
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
        "id" => $transaction_details_value['id'],
        "name" => htmlspecialchars($transaction_details_value['name']),
        "phone" => htmlspecialchars($transaction_details_value['phone']),
        "razorpay_payment_id" => htmlspecialchars($transaction_details_value['razorpay_payment_id']),
        "razorpay_order_id" => htmlspecialchars($transaction_details_value['razorpay_order_id']),
        "amount" => number_format($transaction_details_value['amount'], 2),
        "status" => htmlspecialchars($transaction_details_value['status']),
        "created_at" => date("Y-m-d H:i:s", strtotime($transaction_details_value['created_at'])),
        "policy_number" => $transaction_details_value['PolicyNumber'],
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
