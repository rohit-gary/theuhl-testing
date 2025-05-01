<?php
@session_start();

require_once "../../include/autoloader.inc.php";
include "../../include/get-db-connection.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', 'debug.log');

$loggedin_email = $_SESSION["dwd_email"];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

$loggedInUserID = $_SESSION["dwd_UserID"];

$policyCustomer = new PolicyCustomer($conn);
$policyNumbers = $policyCustomer->PolicyDetailsByUserID($loggedInUserID);

if (!empty($policyNumbers)) {
    $policyNumbersArray = array_map(function ($policy) {
        return $policy["PolicyNumber"];
    }, $policyNumbers);

    $policyNumbersString = implode("','", $policyNumbersArray);
} else {
    $policyNumbersString = "''";
}

$draw = $_POST["draw"];
$row = $_POST["start"];
$rowperpage = $_POST["length"];
$searchValue = $_POST["search"]["value"];

$columnName = "ID";
$columnSortOrder = "DESC";

// Search query
$searchQuery = " ";
if ($searchValue != "") {
    $searchQuery = "(PolicyNumber LIKE '%" . $searchValue . "%' OR HospitalName LIKE '%" . $searchValue . "%')";
}

// Base filter - show all data for admin and client admin, filtered data for others
if ($UserType == "Admin" || $UserType == "Client Admin") {
    $filter = " WHERE IsActive = 1";
} else {
    $filter = " WHERE IsActive = 1 AND PolicyNumber IN ('$policyNumbersString')";
}

if ($searchValue != "") {
    $filter .= " AND " . $searchQuery;
}


$reimbursement = new Reimbursement($conn);
$totalRecordwithFilter = $reimbursement->_getTotalRows(
    $conn,
    "customer_reimbursement",
    $filter
);


// Get total records based on user type
if ($UserType == "Admin" || $UserType == "Client Admin") {
    $totalRecords = $reimbursement->_getTotalRows(
        $conn,
        "customer_reimbursement",
        " WHERE IsActive = 1"
    );
} else {
    $totalRecords = $reimbursement->_getTotalRows(
        $conn,
        "customer_reimbursement",
        " WHERE IsActive = 1 AND PolicyNumber IN ('$policyNumbersString')"
    );
}


$filter .= " ORDER BY " . $columnName . " " . $columnSortOrder;
$filter .= " LIMIT " . $row . ", " . $rowperpage;


$reimbursement_records = $reimbursement->GetAllReimbursementByUser(
    $conn,
    "customer_reimbursement",
    $filter
);


$data = [];
foreach ($reimbursement_records as $record) {
    extract($record);

    $encrypt = new Encryption();
    $Reimbursement_ID = $encrypt->encrypt_message($ID);

    // Handle Documents field - decode only if not null
    $documents = !empty($Documents) ? json_decode($Documents) : [];

    $data[] = [
        "id" => $ID,
        "PolicyNumber" => $PolicyNumber,
        "HospitalName" => $HospitalName,
        "CheckupDate" => $CheckupDate,
        "CheckupCost" => $CheckupCost,
        "Documents" => $documents,
        "Status" => $Status,
        "Reason" => $Reason,
        "createdDate" => $CreatedDate,
        "createdTime" => $CreatedTime,
        "createdBy" => $CreatedBy,
        "Details" =>
            "<a href='view-reimbursement-details?ReimbursementID=" .
            $Reimbursement_ID .
            "'><span class='btn btn-link bg-primary text-white'style='text-decoration:none;'>View Details</span></a>",
        "Action" =>
            $UserType == "Client Admin" || $UserType == "Policy Customer" || $UserType == "Admin"
            ? "<a class='btn text-danger bg-danger-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DeleteReimbursement($ID)' data-bs-original-title='Delete'><span class='fe fe-trash-2 fs-14'></span></a>"
            : "N/A",
    ];
}

// Prepare JSON response
$response = [
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data,
];

error_log("Final Response: " . print_r($response, true));

$json_response = json_encode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("JSON encoding error: " . json_last_error_msg());
    echo "JSON encoding error: " . json_last_error_msg();
    die();
}

echo $json_response;
?>