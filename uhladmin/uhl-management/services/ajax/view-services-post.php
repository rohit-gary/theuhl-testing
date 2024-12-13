<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$access = array("AdminAccess"=>1,"ViewAccess"=>1,"EditAccess"=>1,"DeleteAccess"=>1);
extract($access);
$core = new Core();

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$searchValue = $_POST['search']['value']; // Search value

$columnName = "ID";
$columnSortOrder = "DESC";

$data = array();

$filter = " where 1 ";

$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (ServiceName like '%".$searchValue."%')";
}

/*if($CompanyID != -1 && !$nav)
{
    $filter = $filter." AND CompanyID = $CompanyID";
}*/
$filter = $filter.$searchQuery;

$sql_count = " Select COUNT(*) as row_count from services".$filter;
$result_Count = mysqli_query($conn, $sql_count);

$row_count_result = $result_Count->fetch_assoc();
$row_count = $row_count_result['row_count'];
$totalRecordwithFilter = $row_count;

## Total number of record with filtering
//$totalRecords = _getTotalRows($conn,'corporate_tickets',' where 1');
$totalRecords = $totalRecordwithFilter;

$filter = $filter." ORDER BY ".$columnName." ".$columnSortOrder;
$filter = $filter." limit ".$row.",".$rowperpage;

$sql = "SELECT * FROM services ".$filter;
//echo $sql;
$services_array = array();
$result = mysqli_query($conn, $sql);
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($services_array, $row);
        }
    }
}

$encryption = new Encryption();
$i=1;
foreach ($services_array as $service) 
{
  extract($service);
  $data[] = array(
    "id"=>$i,
    "ServiceName"=>$ServiceName,
    "CreatedDate"=>$CreatedDate,
    "CreatedTime"=>$CreatedTime,
    "CreatedBy"=>$CreatedBy,
    "Action"=>"&nbsp;<a class='btn text-danger btn-sm' onclick='UpdateService($ID)'><span  class='fa fa-pencil-square-o fs-14'></span></a>&nbsp;<a class='btn text-danger btn-sm' onclick='DeleteService($ID)'><span  class='fa fa-trash fs-14'></span></a>"
   );
  $i++;
 
}
## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);
// echo $response;
echo json_encode($response);
?>