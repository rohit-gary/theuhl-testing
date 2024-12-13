<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$Faqs = new Faqs($conn);
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

## Search query
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (Question like '%".$searchValue."%' or Answer like '%".$searchValue."%')";
}

## Filter for active FAQs
$filter = " where IsActive = 1";
$filter = $filter . $searchQuery;

## Total number of records with filtering
$totalRecordwithFilter = $Faqs->_getTotalRows($conn,'faqs', $filter);

## Total number of records without filtering
$totalRecords = $Faqs->GetAllFaqsTable('faqs');

## Pagination and ordering
$filter .= " ORDER BY ".$columnName." ".$columnSortOrder;
$filter .= " limit ".$row.",".$rowperpage;

## Fetch FAQ records
$faqs_details_arr = $Faqs->_getTotalRows($conn,'faqs', $filter);;

## Prepare the data for the response
$data = array();
foreach ($faqs_details_arr as $faqs_details_value) {
    extract($faqs_details_value);

    $encrypt = new Encryption();
    $Faq_ID = $encrypt->encrypt_message($ID);

    $data[] = array(
        "id" => $ID,
        "Question" => $Question,
        "Answer" => $Answer,
        "CreatedDate" => $CreatedDate,
        "CreatedTime" => $CreatedTime,
         "FaqDetails"=>"<a href='view-faq-details?PlanID=".$Faq_ID."'><span class='badge bg-danger badge-sm  me-1 mb-1 mt-1'>View Faq Details</span></a>",
        "Action" => $access ? 
            "<a class='btn text-danger bg-danger-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DeleteFaq($ID)' data-bs-original-title='Delete'><span class='fe fe-trash-2 fs-14'></span></a>
             &nbsp;&nbsp;
             <a class='btn text-secondary bg-secondary-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='UpdateFaqs_modal($ID)' data-bs-original-title='Edit'><span class='fa fa-pencil-square-o fs-14'></span></a>" 
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
