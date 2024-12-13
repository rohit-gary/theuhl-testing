<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$plans = new Plans($conn);
$loggedin_email = $_SESSION['dwd_email'];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$searchValue = $_POST['search']['value']; // Search value

$columnName = "ID"; // Default column for sorting
$columnSortOrder = "DESC"; // Default sorting order

## Check access level
$access = false;
if($UserType == "Client Admin") {
    $access = true;
}

## Search query for plan details
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (PlanName like '%".$searchValue."%' or PlanDescription like '%".$searchValue."%')";
}

## Filter for active plans
$filter = " where IsActive = 1";
$filter = $filter . $searchQuery;

## Total number of records with filtering
$totalRecordwithFilter = $plans->_getTotalRows($conn,'plans', $filter);

## Total number of records without filtering
$totalRecords = $plans->GetAllplansTable('plans');

## Pagination and ordering
$filter .= " ORDER BY ".$columnName." ".$columnSortOrder;
$filter .= " limit ".$row.",".$rowperpage;




$where = " where 1";
$user_details_array_temp = $plans->_getTableRecords($conn,'user_details',$where);
$user_details_array = array();
foreach($user_details_array_temp as $user_details)
{
    $UserID = $user_details['ID'];
    $user_details_array[$UserID] = $user_details['Name'];
}
// print_r($user_details_array);
// die();

## Fetch plan records
$plans_details_arr = $plans->_getTotalRows($conn,'plans', $filter);

## Prepare the data for the response
$data = array();
foreach ($plans_details_arr as $plans_details_value) {
    extract($plans_details_value);

    $encrypt = new Encryption();
    $Plan_ID = $encrypt->encrypt_message($ID);

    if($PlanImage == ""){
    $PlanImage = "N/A";
  }else{
    $PlanImage = "<img src='../project-assets/plan/$PlanImage' style='width:100px; height:50px;object-fit: cover'>";
  }

  
    if ($PlanCoordinator == -1) {
        $PlanCoordinator = "N/A";
    } else {
        
        if (isset($user_details_array[$PlanCoordinator])) {
            $PlanCoordinator = $user_details_array[$PlanCoordinator]; 
        } else {
            $PlanCoordinator = "N/A"; 
        }
    }



    $data[] = array(
        "id" => $ID,
        "PlanName" => $PlanName,
        "PlanImage" => $PlanImage,
        "PlanDuration" => $PlanDuration,
        "PlanCost" => $PlanCost,
        "PlanDescription" => $PlanDescription,
        "CreatedDate" => $CreatedDate,
        "CreatedTime" => $CreatedTime,
        "PlanDetails" => "<a href='view-plan-details?PlanID=".$Plan_ID."'><span class='badge bg-info badge-sm  me-1 mb-1 mt-1'>View Plan Details</span></a>",
        "PlanCoordinator"=>$access ? "$PlanCoordinator.&nbsp;&nbsp;<a class='btn text-secondary bg-secondary-transparent btn-icon py-1 me-2' data-bs-toggle='tooltip' onclick='UpdatePlanCoordinator_modal($ID)' data-bs-original-title='Delete'><span class='fa fa-pencil-square-o fs-14'></span></a>":$PlanCoordinator,
        "Action" => $access ? 
            "<a class='btn text-danger bg-danger-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DeletePlan($ID)' data-bs-original-title='Delete'><span class='fe fe-trash-2 fs-14'></span></a>
             &nbsp;&nbsp;
             <a class='btn text-secondary bg-secondary-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='UpdatePlan_modal($ID)' data-bs-original-title='Edit'><span class='fa fa-pencil-square-o fs-14'></span></a>" 
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
