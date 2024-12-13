<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$authentication = new Authentication($conn);
$authenticated = $authentication->SessionCheck();
$response = array();
if(isset($_POST))
{
    $logs = new Logs();
    $logs->SetCurrentAPILogFile();
    $Servicereport = new Servicereport($conn,$logs);
    $data = $_POST;
    $response_data = $Servicereport->DeleteServiceImage($data);
    if($response_data == true)
    {
        
        $response['error'] = false;
        $response['message'] = "Service Image Has been Deleted";
    }
    else
    {
        $response['error'] = true;
        $response['message'] = "Technical Problem. Please try again";
    }
    
   
    

}
else
{
    $response['error'] = true;
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>