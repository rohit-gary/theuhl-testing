<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$core = new Core();
$core->setTimeZone();
$filter_start_date = "";
if(isset($_POST['filter_start_date']))
{
    $filter_start_date = $_POST['filter_start_date'];
    // $dateTime = DateTime::createFromFormat('m/d/Y', $filter_start_date); 
    // $newDateFormat = $dateTime->format('Y-m-d');
    if($filter_start_date != "")
    {
        $filter_start_date = " AND sr.CreatedDate = '$filter_start_date'";
    }
}

$filter_end_date = "";
if(isset($_POST['filter_end_date']))
{
    $filter_end_date = $_POST['filter_end_date'];
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
   
  $start_date = $_POST['filter_start_date'];
  $end_date = $_POST['filter_end_date'];

  $fillter_date = " AND sr.CreatedDate BETWEEN '$start_date' AND '$end_date'";

}


$fillter_company_id = "";
if(isset($_POST['fillter_company_id']))
{
    $fillter_company_id = $_POST['fillter_company_id'];
    if($fillter_company_id != "")
    {
        $fillter_company_id = " AND sr.CompanyID = '$fillter_company_id'";
    }
}

$fillter_company_site_id = "";
if(isset($_POST['fillter_company_site_id']))
{
    $fillter_company_site_id = $_POST['fillter_company_site_id'];
    // $dateTime = DateTime::createFromFormat('m/d/Y', $filter_end_date); 
    // $newDateFormat = $dateTime->format('Y-m-d');
    if($fillter_company_site_id != "")
    {
        $fillter_company_site_id = " AND sr.CompanySiteID = '$fillter_company_site_id'";
    }
}

$fillter_service_value = "";
if(isset($_POST['fillter_service_value']))
{
    $fillter_service_value = $_POST['fillter_service_value'];
    // $dateTime = DateTime::createFromFormat('m/d/Y', $filter_end_date); 
    // $newDateFormat = $dateTime->format('Y-m-d');
    if($fillter_service_value != "")
    {
        // $fillter_service_value = " AND sr.CompanySiteID = '$fillter_service_value'";
    }
}




$currentdate = date("Y-m-d");

$Total_Project_Backlink = 0;
$where = " where 1 ";
$filter = $where.$filter_start_date.$filter_end_date.$fillter_date.$fillter_company_id.$fillter_company_site_id.$fillter_service_value;

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
// echo $sql;
$result = mysqli_query($conn, $sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
echo $result->num_rows ;
?>