<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$data = array();
$data['ZoneID'] = $_POST['ZoneID'];
$Zone = new Zone($conn);
$zone_details = $Zone->GetZoneDetails($data);
echo json_encode($zone_details);
?>