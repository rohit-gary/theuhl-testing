<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();

require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$loggedin_email = $_SESSION['dwd_email'];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

if (isset($_SESSION['roles']) && is_array($_SESSION['roles']) && !empty($_SESSION['roles'])) {
    $role = $_SESSION['roles'][0]['Role'];
}

$RoleType = $authentication->CheckRole($role);

## Read DataTable values
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; 
$searchValue = $_POST['search']['value']; 
$columnSortOrder = "DESC"; 

## Filter logic for access control
$filter = "WHERE 1=1"; // default where clause
if($UserType == "Channel Partner" || ($UserType == "Client User" && $RoleType == "Sales Man")) {
    $filter .= " AND CreatedBy = '" . mysqli_real_escape_string($conn, $loggedin_email) . "'";
}

## Search query
if ($searchValue != '') {
    $searchQuery = " AND (Name LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                        OR ContactNumber LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%'
                        OR Email LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%')";
    $filter .= $searchQuery;
}

## Total records with filter
$sql_count = "SELECT COUNT(ID) AS row_count FROM doctest $filter";
$result_Count = mysqli_query($conn, $sql_count);
if (!$result_Count) {
    die("Query failed: " . mysqli_error($conn));
}
$row_count_result = $result_Count->fetch_assoc();
$totalRecordwithFilter = $row_count_result['row_count'];

## Total records without filtering
$sql_total = "SELECT COUNT(ID) AS total_count FROM all_customer";
$result_total = mysqli_query($conn, $sql_total);
if (!$result_total) {
    die("Query failed: " . mysqli_error($conn));
}
$totalResult = $result_total->fetch_assoc();
$totalRecords = $totalResult['total_count'];

## SQL to fetch records from all_customer
$sql = "SELECT ID, UserID, Name, ContactNumber, Gender, DateOfBirth, Email, Address, State, Pincode, CreatedBy, CreatedDate 
        FROM all_customer 
        $filter 
        ORDER BY ID $columnSortOrder 
        LIMIT $row, $rowperpage";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

## Prepare data
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        "ID" => $row['ID'],
        "UserID" => $row['UserID'],
        "Name" => $row['Name'],
        "ContactNumber" => $row['ContactNumber'],
        "Gender" => $row['Gender'],
        "DateOfBirth" => $row['DateOfBirth'],
        "Email" => $row['Email'],
        "Address" => $row['Address'],
        "State" => $row['State'],
        "Pincode" => $row['Pincode'],
        "CreatedBy" => $row['CreatedBy'],
        "CreatedDate" => $row['CreatedDate'],
        "Action" => "<a href='view-customer-details?ID=" . $row['ID'] . "'><span class='badge bg-info'>View</span></a>"
    );
}

## Prepare JSON response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

$json_response = json_encode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON encoding error: ' . json_last_error_msg());
}

echo $json_response;
?>
