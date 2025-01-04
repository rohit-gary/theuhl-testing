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

## Read DataTable values
$draw = isset($_POST['draw']) ? $_POST['draw'] : 0;
$row = isset($_POST['start']) ? $_POST['start'] : 0;
$rowperpage = isset($_POST['length']) ? $_POST['length'] : 10; // Default to 10 rows per page
$searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search value
$columnSortOrder = "DESC"; // Assuming you're using DESC for sorting

## Filter logic for access control
$filter = "WHERE 1=1"; // default where clause

## Search query
if ($searchValue != '') {
    $searchQuery = " AND (TestPackageName LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                        OR TestPackageCategory LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%'
                        OR TestPackageFee LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%')";
    $filter .= $searchQuery;
}

## Total records with filter
$sql_count = "SELECT COUNT(ID) AS row_count FROM  test_package $filter";
$result_Count = mysqli_query($conn, $sql_count);
if (!$result_Count) {
    die("Query failed: " . mysqli_error($conn));
}
$row_count_result = $result_Count->fetch_assoc();
$totalRecordwithFilter = $row_count_result['row_count'];

## Total records without filtering
$sql_total = "SELECT COUNT(ID) AS total_count FROM  test_package";
$result_total = mysqli_query($conn, $sql_total);
if (!$result_total) {
    die("Query failed: " . mysqli_error($conn));
}
$totalResult = $result_total->fetch_assoc();
$totalRecords = $totalResult['total_count'];

## SQL to fetch records from  test_package
$sql = "SELECT *
        FROM  test_package 
        $filter 
        ORDER BY ID $columnSortOrder 
        LIMIT $row, $rowperpage";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}


function getCategoryNames($categoryIds, $categoryMap) {
    $categoryIdsArray = explode(',', $categoryIds);
    $categoryNames = array_map(function($id) use ($categoryMap) {
        return isset($categoryMap[$id]) ? $categoryMap[$id] : 'Unknown'; 
    }, $categoryIdsArray);

    return implode(', ', $categoryNames);
}


$categoryQuery = "SELECT `ID`, `TestCategoryName` FROM `test_category` WHERE `IsActive` = 1";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Create associative array for category mapping
$categoryMap = [];
while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
    $categoryMap[$categoryRow['ID']] = $categoryRow['TestCategoryName'];
}


function getTestNames($testIds, $testMap) {
    $testIdsArray = explode(',', $testIds);
    $testNames = array_map(function($id) use ($testMap) {
        return isset($testMap[$id]) ? $testMap[$id] : 'Unknown'; 
    }, $testIdsArray);

    return implode(', ', $testNames);
}


$testQuery = "SELECT `ID`, `TestName` FROM `doc_test` WHERE `IsActive` = 1";
$testResult = mysqli_query($conn, $testQuery);

// Create associative array for category mapping
$testMap = [];
while ($testRow = mysqli_fetch_assoc($testResult)) {
    $testMap[$testRow['ID']] = $testRow['TestName'];
}



## Prepare data
$data = [];
while ($row = $result->fetch_assoc()) {


   $data[] = array(
    "ID" => $row['ID'],
    "TestPackageName" => $row['TestPackageName'],
    "TestPackageCategory" => getCategoryNames($row['TestPackageCategory'], $categoryMap),
    "PackageTestName" => getTestNames($row['PackageTestName'], $testMap),
    "TestPackageType" => $row['TestPackageCode'],
    "TestPackageFee" => $row['TestPackageFee'],
    "CreatedBy" => $row['CreatedBy'],
    "CreatedDate" => $row['CreatedDate'],
    "Details" => "<a href='view-test-package-details?ID=" . $row['ID'] . "'><span class='badge bg-info'>View</span></a>",
    "Action" => "<a class='btn text-danger bg-danger-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DeleteTestPackage(" . $row['ID'] . ")' data-bs-original-title='Delete'><span class='fe fe-trash-2 fs-14'></span></a>
                 &nbsp;&nbsp;
                 <a class='btn text-secondary bg-secondary-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='UpdateTestPackage(" . $row['ID'] . ")' data-bs-original-title='Edit'><span class='fa fa-pencil-square-o fs-14'></span></a>"
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
