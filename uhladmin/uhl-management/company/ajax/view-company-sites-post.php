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

$CompanyID = -1;
$company_filter = "";
if(isset($_GET['nav']))
{
    $nav = $_GET['nav'];
    if($nav == 1)
    {
        $CompanyID = -1;
    }
}

if(isset($_SESSION['CompanyID']))
{
    $CompanyID = $_SESSION['CompanyID'];
    if($nav != 1)
    {
        $company_filter =  " AND a.CompanyID = $CompanyID";
    }
}

$columnName = "ID";
$columnSortOrder = "DESC";

$data = array();

$filter = " where a.IsActive = 1 ";

$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (b.CompanyName like '%".$searchValue."%' or a.SiteName like '%".$searchValue."%' or a.SiteAddress LIKE '%".$searchValue."%' or a.SitePOCName LIKE '%".$searchValue."' or a.SitePOCEmail like '%".$searchValue."%' or a.SitePOCContact like '%".$searchValue."%')";
}

/*if($CompanyID != -1 && !$nav)
{
    $filter = $filter." AND CompanyID = $CompanyID";
}*/
$filter = $filter.$searchQuery.$company_filter;

$sql_count = " Select COUNT(*) as row_count from (Select a.*,b.CompanyName from company_sites a JOIN company b ON a.CompanyID = b.ID ".$filter.") AS subquery";
$result_Count = mysqli_query($conn, $sql_count);
$row_count_result = $result_Count->fetch_assoc();
$row_count = $row_count_result['row_count'];
$totalRecordwithFilter = $row_count;

## Total number of record with filtering
//$totalRecords = _getTotalRows($conn,'corporate_tickets',' where 1');
$totalRecords = $totalRecordwithFilter;

$filter = $filter." ORDER BY ".$columnName." ".$columnSortOrder;
$filter = $filter." limit ".$row.",".$rowperpage;

$sql = "Select a.*,b.CompanyName from company_sites a JOIN company b ON a.CompanyID = b.ID ".$filter;
//echo $sql;
$company_sites_array = array();
$result = mysqli_query($conn, $sql);
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($company_sites_array, $row);
        }
    }
}

$i=1;
foreach ($company_sites_array as $company_site) 
{
  extract($company_site);

  $where = " where 1";
  $zone_array_temp = $core->_getTableRecords($conn,'zone',$where);
  $zone_array = array();
  foreach($zone_array_temp as $zone)
  {
      $Zone_ID = $zone['ID'];
      $zone_array[$Zone_ID] = $zone['ZoneName'];
  }

  if($ZoneID != "-1" && $ZoneID != ''){

    $Zone_name = $zone_array[$ZoneID];
  }else{
    $Zone_name = 'N/A';
  }

  $data[] = array(
    "id"=>$i,
    "SiteName"=>$SiteName."<br>".$Zone_name,
    "CompanyName"=>$CompanyName,
    "SiteAddress"=>$SiteAddress,
    "SitePOCName"=>$SitePOCName,
    "SitePOCEmail"=>$SitePOCEmail,
    "SitePOCContact"=>$SitePOCContact,
    "Action"=>"&nbsp;<a class='btn text-danger btn-sm' onclick='UpdateCompanySite($ID)'><span  class='fa fa-pencil-square-o fs-14'></span></a>&nbsp;<a class='btn text-danger btn-sm' onclick='DeleteCompanySite($ID)'><span  class='fa fa-trash fs-14'></span></a>"
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