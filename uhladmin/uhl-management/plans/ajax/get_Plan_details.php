<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");




$response = array();
$response['error'] = true;
if(isset($_POST))
{
   
    $Plan = new Plans($conn);
    $PlanID = $_POST['ID'];
    
    $response_data = $Plan->GetPlanDetailsbyID($PlanID);
   
    $response['error'] = false;
    $response['data'] = $response_data;
}
else
{
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>