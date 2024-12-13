<?php
@session_start();
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

$columnName = "ID"; 
$columnSortOrder = "DESC"; 

## Check access level
$access = false;
if($UserType == "Client Admin" || $UserType=="Channel Partner") {
    $access = true;
}

## Search query
$searchQuery = " ";
if($searchValue != '') {
   $searchQuery = " and (Name like '%".$searchValue."%' or ContactNumber like '%".$searchValue."%'  or PolicyNumber like '%".$searchValue."%')";
}

## Filter for active doctors
$filter = " where IsActive = 1";

## Additional filter if user is a "Channel Partner"
if($UserType == "Channel Partner") {
    $filter .= " and CreatedBy = '".$loggedin_email."'";
}

if($UserType=="Client User"){
   if($RoleType == "Sales Man") {
    $filter .= " and CreatedBy = '".$loggedin_email."'";
} 

}

$filter = $filter . $searchQuery;

## Total number of records with filtering
$totalRecordwithFilter = $PolicyCustomer->_getTotalRows($conn, 'policy_customer', $filter);

## Total number of records without filtering
$totalRecords = $PolicyCustomer->GetAllPolicyCustomer('policy_customer');

## Pagination and ordering
$filter .= " ORDER BY ".$columnName." ".$columnSortOrder;
$filter .= " limit ".$row.",".$rowperpage;

## Fetch doctor records
$policy_details_arr = $PolicyCustomer->_getTotalRecord($conn, 'policy_customer', $filter);

## Prepare the data for the response
$data = array();
foreach ($policy_details_arr as $policy_details_value) {
    extract($policy_details_value);

     $payment_datass = $PolicyCustomer->checkPaymentStatusByPolicyID($ID);
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
    $Policy_ID = $encrypt->encrypt_message($ID);

    $data[] = array(
        "id" => $ID,
         "Name" => $Name,
        "ContactNumber" => $ContactNumber,
        "PolicyNumber" => $PolicyNumber,
        "Address"=>$Address,
        "CreatedBy"=>$CreatedBy,
        "CreatedDate" => $CreatedDate,
        "CreatedTime" => $CreatedTime,
        "Transection Status"=>$payment_status,
        "Details" => "<a href='view-policy-details?PolicyID=".$Policy_ID."'><span class='badge bg-info badge-sm  me-1 mb-1 mt-1'>View Policy Details</span></a>",
        "Action" => $access ? 
            "<a class='btn text-danger bg-danger-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DeletePolicy($ID)' data-bs-original-title='Delete'><span class='fe fe-trash-2 fs-14'></span></a>
             &nbsp;&nbsp;
             <a class='btn text-secondary bg-secondary-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DownloadePolicyDoc(\"$Policy_ID\")' data-bs-original-title='downlode'> <span class='fa fa-download'></span></a>" 
            : 'N/A',
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
    die();
}

echo $json_response;
?>
