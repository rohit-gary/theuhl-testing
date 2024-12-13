<?php
@session_start();
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
include("../include/get-db-connection.php");
//$filename = 'company.csv';
$file = fopen($filename, 'r');
$core = new Core();
$core->setTimeZone();
$CreatedDate = date("Y-m-d");
$CreatedTime = date("H:i:s");
$CreatedBy = "system";
$company_obj = new Company($conn);
while (($row = fgetcsv($file)) !== false) 
{
	$data['company_name'] = trim($row[0]);
	$data['ta_company_address'] = "";
	$data['poc_name'] = "";
	$data['poc_email'] = "";
	$data['poc_phone_number'] = "";
	$data['CreatedDate'] = $CreatedDate;
	$data['CreatedTime'] = $CreatedTime;
	$data['CreatedBy'] = $CreatedBy;
	$response = $company_obj->InsertCompany($data);
	if($response['error'] == false)
	{
		echo "Company Added - ".$row[0]."<br>";
	}
}
?>