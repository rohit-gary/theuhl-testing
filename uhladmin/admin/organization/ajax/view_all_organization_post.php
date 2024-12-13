<?php
@session_start();
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$core = new Core();
$Organization = new Organization($conn);
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
   $searchQuery = " and (OrganizationName like '%".$searchValue."%')";
}

$filter = " where IsActive = 1";
$filter = $filter.$searchQuery;
$totalRecordwithFilter = $core->_getTotalRows($conn,'organization', $filter);
## Total number of record with filtering
$totalRecords = $Organization->getTotalOrganization('organization');
$filter = $filter." ORDER BY ".$columnName." ".$columnSortOrder;
$filter = $filter." limit ".$row.",".$rowperpage;
$organization_array = $core->_getTableRecords($conn,'organization', $filter);

foreach ($organization_array as $organization) 
{
  extract($organization);
  $modules_view_html = "<a onclick='ShowOrgModules($ID)' class='text-center'><span class='badge bg-info badge-sm  cursor-pointer'>View</span></a>";
  $data[] = array(
    "id"=>$ID,
    "OrganizationName"=>$OrganizationName,
    "Address"=>$Address,
    "POC_Email_Phone"=>$POC."<br>".$Email."<br>".$PhoneNumber,
    "Modules"=>$modules_view_html,
    "GST"=>$GSTNo,
    "OnBoardingDate"=>$CreatedDate,
    "Action"=>"<a class='btn text-danger btn-sm' data-bs-toggle='tooltip' onclick='DeleteOrganization($ID)' data-bs-original-title='Delete'><span
              class='fe fe-trash-2 fs-14'></span></a>&nbsp;&nbsp;<a class='btn text-danger btn-sm' data-bs-toggle='tooltip' onclick='UpdateOrganization_modal($ID)' data-bs-original-title='Delete'><span
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