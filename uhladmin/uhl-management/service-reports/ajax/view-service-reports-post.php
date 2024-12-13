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
/*if(isset($_SESSION['CompanyID']))
{
    $CompanyID = $_SESSION['CompanyID'];
    $company_filter =  " AND a.CompanyID = $CompanyID";
}*/

$filter_start_date = "";
if(isset($_GET['filter_start_date']))
{
    $filter_start_date = $_GET['filter_start_date'];
    // $dateTime = DateTime::createFromFormat('m/d/Y', $filter_start_date); 
    // $newDateFormat = $dateTime->format('Y-m-d');
    if($filter_start_date != "")
    {
        $filter_start_date = " AND sr.CreatedDate = '$filter_start_date'";
    }
}

$filter_end_date = "";
if(isset($_GET['filter_end_date']))
{
    $filter_end_date = $_GET['filter_end_date'];
    // $dateTime = DateTime::createFromFormat('m/d/Y', $filter_end_date); 
    // $newDateFormat = $dateTime->format('Y-m-d');
    if($filter_end_date != "")
    {
        $filter_end_date = " AND sr.CreatedDate = '$filter_end_date'";
    }
}


$fillter_date = '';
if($filter_start_date != "" && $filter_end_date != ""){
  $filter_start_date = '';
  $filter_end_date = '';
   
  $start_date = $_GET['filter_start_date'];
  $end_date = $_GET['filter_end_date'];

  $fillter_date = " AND sr.CreatedDate BETWEEN '$start_date' AND '$end_date'";

}


$fillter_company_id = "";
if(isset($_GET['fillter_company_id']))
{
    $fillter_company_id = $_GET['fillter_company_id'];
    if($fillter_company_id != "")
    {
        $fillter_company_id = " AND sr.CompanyID = '$fillter_company_id'";
    }
}

$fillter_company_site_id = "";
if(isset($_GET['fillter_company_site_id']))
{
    $fillter_company_site_id = $_GET['fillter_company_site_id'];
    // $dateTime = DateTime::createFromFormat('m/d/Y', $filter_end_date); 
    // $newDateFormat = $dateTime->format('Y-m-d');
    if($fillter_company_site_id != "")
    {
        $fillter_company_site_id = " AND sr.CompanySiteID = '$fillter_company_site_id'";
    }
}

$fillter_service_value = "";
if(isset($_GET['fillter_service_value']))
{
    $fillter_service_value = $_GET['fillter_service_value'];
    // $dateTime = DateTime::createFromFormat('m/d/Y', $filter_end_date); 
    // $newDateFormat = $dateTime->format('Y-m-d');
    if($fillter_service_value != "")
    {
        $fillter_service_value = " AND sr.CompanySiteID = '$fillter_service_value'";
    }
}


$columnName = "sr.ID";
$columnSortOrder = "DESC";

$data = array();

$filter = " where 1 ";

$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (c.CompanyName like '%".$searchValue."%' or cs.SiteName like '%".$searchValue."%' or s.ServiceName LIKE '%".$searchValue."%' or ud.Name LIKE '%".$searchValue."')";
}

/*if($CompanyID != -1 && !$nav)
{
    $filter = $filter." AND CompanyID = $CompanyID";
}*/
$filter = $filter.$searchQuery.$company_filter.$fillter_date.$filter_start_date.$filter_end_date.$fillter_company_id.$fillter_company_site_id;

$sql_count = " Select COUNT(*) as row_count from (SELECT sr.ID AS ReportID,
       c.CompanyName,
       cs.SiteName,
       s.ServiceName,
       ud.Name AS CreatedByName,
       sr.Status,
       sr.CreatedDate,
       sr.CreatedTime,
       sr.IsActive
FROM service_reports sr
JOIN company c ON sr.CompanyID = c.ID
JOIN company_sites cs ON sr.CompanySiteID = cs.ID
JOIN services s ON sr.ServiceID = s.ID
JOIN user_details ud ON sr.CreatedBy = ud.UserName ".$filter.") AS subquery";
// echo $sql_count;die;
$result_Count = mysqli_query($conn, $sql_count);
$row_count_result = $result_Count->fetch_assoc();
$row_count = $row_count_result['row_count'];
$totalRecordwithFilter = $row_count;

## Total number of record with filtering
//$totalRecords = _getTotalRows($conn,'corporate_tickets',' where 1');
$totalRecords = $totalRecordwithFilter;

$filter = $filter." ORDER BY ".$columnName." ".$columnSortOrder;
$filter = $filter." limit ".$row.",".$rowperpage;

$sql = "SELECT sr.ID,
       c.CompanyName,
       cs.SiteName,
       s.ServiceName,
       ud.Name AS CreatedByName,
       sr.Status,
       sr.CreatedDate,
       sr.CreatedTime,
       sr.IsActive
FROM service_reports sr
JOIN company c ON sr.CompanyID = c.ID
JOIN company_sites cs ON sr.CompanySiteID = cs.ID
JOIN services s ON sr.ServiceID = s.ID
JOIN user_details ud ON sr.CreatedBy = ud.UserName ".$filter;
$service_reports_array = array();
$result = mysqli_query($conn, $sql);
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($service_reports_array, $row);
        }
    }
}

$i=1;
foreach ($service_reports_array as $serive_report) 
{
  extract($serive_report);

  if($Status == ""){
    $Status = "<span class='badge bg-primary'>N/A</span>";
  }else if($Status == "Draft"){
    $Status = "<span class='badge bg-secondary'>$Status</span>";
  }else if($Status == "Initiated"){
    $Status = "<span class='badge bg-primary'>$Status</span>";
  }else{
    $Status = "<span class='badge bg-success'>$Status</span>";
  }
  
  $data[] = array(
    "id"=>$i,
    "SiteNameCompanyName"=>$SiteName.'<br>'.$CompanyName,
    "ServiceName"=>$ServiceName,
    "Status"=>$Status,
    "CreatedAt"=>$CreatedDate."<br>".$CreatedTime,
    "Technician"=>$CreatedByName,
    "PDFGenearte"=>"<a class='btn text-danger btn-sm' target='_blank' href='./web-service-report.php?ID=$ID'><span  class='fa fa-file-text fs-14'></span></a>",
    "Action"=>"&nbsp;<button class='btn text-danger btn-sm' onclick='UpdateGeneralServiceReport($ID)'><span  class='fa fa-pencil-square-o fs-14'></span></button>&nbsp;<button class='btn text-danger btn-sm' onclick='DeleteCompanySite($ID)'><span  class='fa fa-trash fs-14'></span></button>"
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