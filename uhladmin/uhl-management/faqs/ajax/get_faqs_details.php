<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");


$response = array();
$response['error'] = true;
if(isset($_POST))
{
   
    $Faqs = new Faqs($conn);
    $FaqID = $_POST['ID'];
    $response_data = $Faqs->GetFaqDetailsbyID($FaqID);
    
    
    $response['error'] = false;
    $response['data'] = $response_data;
}
else
{
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>