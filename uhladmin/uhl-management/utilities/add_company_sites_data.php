<?php
@session_start();
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
include("../include/get-db-connection.php");
$filename = 'Tablespace.csv';
$file = fopen($filename, 'r');
$core = new Core();
$core->setTimeZone();
$CreatedDate = date("Y-m-d");
$CreatedTime = date("H:i:s");
$CreatedBy = "system";
$company_obj = new Company($conn);
$company_array = $company_obj->setCompanyArraybyName();
while (($row = fgetcsv($file)) !== false) 
{
	$data = array();
	$CompanyName = trim($row[1]);
	$CompanyID = -1;
	$CompanySiteName = trim($row[2]);
	if(isset($company_array[$CompanyName]))
	{
		$CompanyID = $company_array[$CompanyName]['ID'];
	} 
	if($CompanyID == -1)
	{
		echo "<br>Can't find Company Name ".$CompanyName." and Site - ".$CompanySiteName;
	}
	$ZoneID = 4;
	if ((stripos($CompanyName,'Oracle') !== false) || (stripos($CompanyName,'Concentrix') !== false)) 
	{
    	$ZoneID = 5;
	}

	// check if company site already exist
	$filter = " where SiteName = '$CompanySiteName'";
	$no_of_rows = $core->_getTotalRows($conn,'company_sites', $filter);
	$CompanySiteID = $data['form_id'] = -1;
	if($no_of_rows > 0)
	{
		$CompanySiteID = $data['form_id'] = $core->_getTableDetails($conn,'company_sites',$filter)['ID'];
	}

	$data['s_zoneid'] = $ZoneID;
	$data['company_site_name'] = $CompanySiteName;
	$data['s_company'] = $CompanyID;
	$data['ta_company_site_address'] = "";
	$data['site_poc_name'] = trim($row[3]);
	$row[4] = str_replace(['<', '>'], '',$row[4]);
	$row[4] = trim($row[4]);
	$row[4] = strtolower($row[4]);
	$data['site_poc_email'] = $row[4];
	$data['site_poc_contact'] = trim($row[5]);
	$data['CreatedDate'] = $CreatedDate;
	$data['CreatedTime'] = $CreatedTime;
	$data['CreatedBy'] = $CreatedBy;
	if($CompanySiteID == -1)
	{
		echo "INSERT"."<br>";
		$response = $company_obj->InsertCompanySite($data);
		if($response['error'] == false)
		{
			//echo "Company Site Added - ".$row[2]."<br>";
		}
		else
		{
			echo "Company Site NOT Added - ".$row[2]."<br>";
		}
	}
	else
	{
		echo "UPDATE"."<br>";
		$response = $company_obj->UpdateCompanySiteDetails($data);
		if($response['error'] == false)
		{
			//echo "Company Site Added - ".$row[2]."<br>";
		}
		else
		{
			echo "Company Site NOT Updated - ".$row[2]."<br>";
		}
	}
}
?>