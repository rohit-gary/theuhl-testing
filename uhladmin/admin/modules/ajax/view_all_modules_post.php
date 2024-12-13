<?php
@session_start();
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$core = new Core();
$Modules = new Modules($conn);
$loggedin_email = $_SESSION['dwd_email'];
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$searchValue = $_POST['search']['value']; // Search value

$columnName = "ID";
$columnSortOrder = "DESC";

$data = array();

$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (ModulesName like '%".$searchValue."%')";
}

$filter = " where IsActive = 1";

/*if($CompanyID != -1 && !$nav)
{
    $filter = $filter." AND CompanyID = $CompanyID";
}*/
$filter = $filter.$searchQuery;
$totalRecordwithFilter = $core->_getTotalRows($conn,'modules', $filter);
## Total number of record with filtering
$totalRecords = $Modules->getTotalModules('modules');
$filter = $filter." ORDER BY ".$columnName." ".$columnSortOrder;
$filter = $filter." limit ".$row.",".$rowperpage;
$district_details_arr = $core->_getTableRecords($conn,'modules', $filter);

foreach ($district_details_arr as $district_details_value) 
{
  extract($district_details_value);

  $data[] = array(
    "id"=>$ID,
    "ModulesName"=>$ModulesName,
    "Action"=>"<a class='btn text-danger btn-sm' data-bs-toggle='tooltip' onclick='DeleteModules($ID)' data-bs-original-title='Delete'><span
              class='fe fe-trash-2 fs-14'></span></a>&nbsp;&nbsp;<a class='btn text-danger btn-sm' data-bs-toggle='tooltip' onclick='UpdateModules_modal($ID)' data-bs-original-title='Delete'><span
              class='fa fa-pencil-square-o fs-14'></span></a>",
   );
 
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