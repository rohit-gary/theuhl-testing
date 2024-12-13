<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$data = array();
$data['CompanySiteID'] = $_POST['CompanySiteID'];
$company_obj = new Company($conn);
$company_details = $company_obj->GetCompanySiteDetails($data);
echo json_encode($company_details);
?>