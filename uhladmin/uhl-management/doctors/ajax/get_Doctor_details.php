<?php
error_reporting(0);
ini_set('display_errors', 0);

@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$response = array();
$response['error'] = true;
if(isset($_POST))
{
   
    $Doctor = new Doctors($conn);
    $PlanID = $_POST['ID'];
    $response_data = $Doctor->GetDoctorDetailsbyID($PlanID);
    $response['error'] = false;
    $response['data'] = $response_data;
}
else
{
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>