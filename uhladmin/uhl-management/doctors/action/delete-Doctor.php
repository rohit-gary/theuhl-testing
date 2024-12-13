<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");


$response = array();
$response['error'] = true;
if(isset($_POST))
{
   
    $Doctor = new Doctors($conn);
    $data = $_POST;
    $response_data = $Doctor->DeleteDoctor($data);
    if($response_data == true)
    {
        $response['error']  = false;
        $response['message']  = "Doctor has been Deleted!";
    }else{
        $response['message'] = "Some Technical Error ! Please Try Again.";
    }

}
else
{
    $response['message'] = "Some Technical Error ! Please Try Again.";
}
echo json_encode($response);
?>