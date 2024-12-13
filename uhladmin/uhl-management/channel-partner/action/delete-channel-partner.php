<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");


$response = array();
$response['error'] = true;
if(isset($_POST))
{
   
    $ChannelPartner = new ChannelPartner($conn);
    $data = $_POST;
    $response_data = $ChannelPartner->DeleteChannelPartner($data);
    if($response_data == true)
    {
        $response['error']  = false;
        $response['message']  = "Channel Partner has been Deleted!";
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