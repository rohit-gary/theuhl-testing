<?php
@session_start();

require_once "../../include/autoloader.inc.php";
include "../../include/get-db-connection.php";

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
    $searchQuery =
        " AND (PolicyNumber LIKE '%" .
        $searchValue .
        "%' OR hospital_name LIKE '%" .
        $searchValue .
        "%')";
}

$filter = " WHERE IsActive = 1 AND PolicyNumber IN ('$policyNumbersString')"; // Filter by policy numbers for the logged-in user
$filter .= $searchQuery; // Add search condition

$reimbursement = new Reimbursement($conn);
$totalRecordwithFilter = $reimbursement->_getTotalRows(
    $conn,
    "customer_reimbursement",
    $filter
);

$filter2 = " ";
$totalRecords = $reimbursement->_getTotalRows(
    $conn,
    "customer_reimbursement",
    $filter2
);

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

    $data[] = [
        "id" => $ID,
        "PolicyNumber" => $PolicyNumber,
        "HospitalName" => $HospitalName,
        "CheckupDate" => $CheckupDate,
        "CheckupCost" => $CheckupCost,
        "Documents" => json_decode($Documents), // Decode documents if it's stored as JSON
        "Status" => $Status,
        "Remark" => $Remark,
        "createdDate" => $CreatedDate,
        "createdTime" => $CreatedTime,
        "createdBy" => $CreatedBy,
        "Details" =>
            "<a href='view-reimbursement-details?ReimbursementID=" .
            $Reimbursement_ID .
            "'><span class='badge bg-info badge-sm me-1 mb-1 mt-1'>View Details</span></a>",
        "Action" =>
            $UserType == "Client Admin" || $UserType == "Channel Partner"
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

$json_response = json_encode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON encoding error: " . json_last_error_msg();
    die();
}

echo $json_response;
?>
