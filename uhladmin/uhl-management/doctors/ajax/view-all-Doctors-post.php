<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$Doctors = new Doctors($conn); 
$loggedin_email = $_SESSION['dwd_email'];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; 
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
if($searchValue != '') {
   $searchQuery = " and (DoctorName like '%".$searchValue."%' or Specialization like '%".$searchValue."%'  or PhoneNumber like '%".$searchValue."%')";
}

## Filter for active doctors
$filter = " where IsActive = 1"; // Assuming IsActive is a column to check active doctors
$filter = $filter . $searchQuery;

## Total number of records with filtering
$totalRecordwithFilter = $Doctors->_getTotalRows($conn, 'doctors', $filter);

## Total number of records without filtering
$totalRecords = $Doctors->GetAllDoctors('doctors');

## Pagination and ordering
$filter .= " ORDER BY ".$columnName." ".$columnSortOrder;
$filter .= " limit ".$row.",".$rowperpage;

## Fetch doctor records
$doctors_details_arr = $Doctors->_getTotalRows($conn, 'doctors', $filter);

## Prepare the data for the response
$data = array();
foreach ($doctors_details_arr as $doctors_details_value) {
    extract($doctors_details_value);

    $encrypt = new Encryption();
    $Doctor_ID = $encrypt->encrypt_message($ID);

    if($DoctorImage == ""){
    $DoctorImage = "N/A";
  }else{
    $DoctorImage = "<img src='../project-assets/doctor/$DoctorImage' style='width:100px; height:50px;'>";
  }

    $data[] = array(
        "id" => $ID,
         "DoctorName" => $DoctorName . " (" . $Specialization . ")",
        "DoctorImage" => $DoctorImage,
        "Specialization" => $Specialization,
        "PhoneNumber" => $PhoneNumber,
        "Email" => $Email,
        "CreatedDate" => $CreatedDate,
        "CreatedTime" => $CreatedTime,
        "DoctorDetails" => "<a href='view-doctor-details?DoctorID=".$Doctor_ID."'><span class='badge bg-info badge-sm  me-1 mb-1 mt-1'>View Doctor Details</span></a>",
        "Action" => $access ? 
            "<a class='btn text-danger bg-danger-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='DeleteDoctor($ID)' data-bs-original-title='Delete'><span class='fe fe-trash-2 fs-14'></span></a>
             &nbsp;&nbsp;
             <a class='btn text-secondary bg-secondary-transparent btn-icon py-1' data-bs-toggle='tooltip' onclick='UpdateDoctor_modal($ID)' data-bs-original-title='Edit'><span class='fa fa-pencil-square-o fs-14'></span></a>" 
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
