<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();

// print_r($_SESSION);
// die();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$PolicyCustomer = new PolicyCustomer($conn); 
$loggedin_email = $_SESSION['dwd_email'];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();


if (isset($_SESSION['roles']) && is_array($_SESSION['roles']) && !empty($_SESSION['roles'])) {
    $role = $_SESSION['roles'][0]['Role']; // Access the Role field
}

$RoleType = $authentication->CheckRole($role);

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; 
$searchValue = $_POST['search']['value']; 

$columnName = "ac.ID"; 
$columnSortOrder = "DESC"; 

## Check access level
$access = false;
if($UserType == "Client Admin" || $UserType=="Channel Partner") {
    $access = true;
}

$access_2 = false;
if($UserType == "Client Admin") {
    $access_2 = true;
}

$searchQuery = "";
if($searchValue != '') {
   $searchQuery = " AND (ac.Name LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%' 
                     OR ac.ContactNumber LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%'  
                     OR cp.PolicyNumber LIKE '%" . mysqli_real_escape_string($conn, $searchValue) . "%')";
}

## Filter for access levels
$filter = "WHERE 1=1"; // default where clause to simplify appending conditions
$filter = "WHERE cp.isActive=1";
if($UserType == "Channel Partner") {
    $filter .= " AND ac.CreatedBy = '" . mysqli_real_escape_string($conn, $loggedin_email) . "'";
} 

if($UserType == "Client User" && $RoleType == "Sales Man") {
    $filter .= " AND ac.CreatedBy = '" . mysqli_real_escape_string($conn, $loggedin_email) . "'";
}

$filter .= $searchQuery;

## Total number of records with filtering
$sql_count = "SELECT COUNT(DISTINCT cp.PolicyNumber) AS row_count
              FROM all_customer ac
              INNER JOIN customerpolicy cp ON ac.ID = cp.CustomerID
              $filter";
$result_Count = mysqli_query($conn, $sql_count);
if (!$result_Count) {
    die("Query failed: " . mysqli_error($conn));
}

$row_count_result = $result_Count->fetch_assoc();
$totalRecordwithFilter = $row_count_result['row_count'];
// $totalRecordwithFilter = $PolicyCustomer->_getTotalRows($conn, 'all_customer', $filter);

## Total number of records without filtering
$sql_count = "SELECT COUNT(DISTINCT cp.PolicyNumber) AS total_count
              FROM all_customer ac
              INNER JOIN customerpolicy cp ON ac.ID = cp.CustomerID";
$result_total = mysqli_query($conn, $sql_count);
if (!$result_total) {
    die("Query failed: " . mysqli_error($conn));
}
$totalResult = $result_total->fetch_assoc();
// $totalRecords = $PolicyCustomer->GetAllPolicyCustomer('all_customer');
$totalRecords = $totalResult['total_count'];
## Pagination and ordering


## Fetch doctor records
// $policy_details_arr = $PolicyCustomer->_getTotalRecord($conn, 'policy_customer', $filter);

## Main SQL query to fetch policy details
$sql = "SELECT ac.ID AS CustomerID, MAX(ac.Name) AS UserName, MAX(ac.ContactNumber) AS MobileNumber, MAX(ac.CreatedBy) AS CreatedBy, cp.PolicyNumber,MAX(cp.CreatedBy) AS CreatedDate, MAX(cpa.Amount) AS Amount, COALESCE(MAX(p.status), 'Not Done') AS PaymentStatus, CASE WHEN COUNT(CASE WHEN pmd.Document IS NULL THEN 1 END) = 0 THEN 'Complete' ELSE 'Incomplete' END AS DocumentStatus FROM all_customer ac INNER JOIN customerpolicy cp ON ac.ID = cp.CustomerID LEFT JOIN customerpolicyamount cpa ON cp.PolicyNumber = cpa.PolicyNumber LEFT JOIN payments p ON cp.PolicyNumber = p.PolicyNumber LEFT JOIN policy_member_details pmd ON cp.PolicyNumber = pmd.PolicyNumber $filter
     GROUP BY ac.ID, cp.PolicyNumber ORDER BY ac.ID DESC, cp.PolicyNumber  LIMIT $row, $rowperpage ";

     // echo $sql;
    $result = mysqli_query($conn, $sql);

if (!$result) {
    echo "SQL Error: " . mysqli_error($conn);
    // die();
}

$policy_details_arr = [];
while ($row = $result->fetch_assoc()) {
    $policy_details_arr[] = $row;
}

## Prepare the response data
$data = [];


## Prepare the data for the response
// $data = array();
$docStatus="Pending";
foreach ($policy_details_arr as $policy_details_value) {
    extract($policy_details_value);

    // print_r($policy_details_value);
    // die();

     $payment_datass = $PolicyCustomer->checkPaymentStatusByPolicyNumber($PolicyNumber);
        // $payment_data=$payment_datass[0];
       

         // var_dump($payment_data);

              if (!empty($payment_datass) && isset($payment_datass[0])) {
               $payment_data = $payment_datass[0];

            // Check for payment status
            if (!empty($payment_data) && isset($payment_data['status'])) {
                $payment_status = $payment_data['status'];
            } else {
                $payment_status = 'Pending';
            }
        } else {
            $payment_status = 'Pending';
        }



    $encrypt = new Encryption();
    $Policy_ID = $encrypt->encrypt_message($PolicyNumber);
    
    $data[] = array(
         "id" => $CustomerID,
         "Name" => $UserName,
        "ContactNumber" => $MobileNumber,
        "PolicyNumber" => $PolicyNumber,
        "CreatedBy"=>$CreatedBy,
        "Document Status"=>$DocumentStatus,
        "CreatedDate" => $CreatedDate,
        "Transection Status"=>$PaymentStatus,
        "Details" => "<a href='view-policy-details-new?PolicyID=".$Policy_ID."'><span class='badge bg-info badge-sm  me-1 mb-1 mt-1'>View Policy Details</span></a>",
       "Action" => ($access ? 
            "<a class='btn text-secondary bg-secondary-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DownloadePolicyDoc(\"$PolicyNumber\")' data-bs-original-title='Download'> 
                <span class='fa fa-download'></span>
             </a> &nbsp;&nbsp <a class='btn text-danger bg-danger-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DeletePolicy(\"$PolicyNumber\")' data-bs-original-title='Download'> 
                <span class='fa fa-trash'></span>
             </a>" 
            : 'N/A') . 
            ($access_2 ? 
            " <a onclick='GetCustomerDetails($CustomerID)'>
                <span class='badge bg-info'>View</span>
             </a>" 
            : ''),

    );
}

## Prepare the JSON response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

$json_response = json_encode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'JSON encoding error: ' . json_last_error_msg();
    // die();
}

echo $json_response;
?>



