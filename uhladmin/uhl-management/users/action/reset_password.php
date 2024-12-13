<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$master = new Master($master_conn);
$response = array();
if(isset($_POST))
{
    $data = $_POST;
    $response_data = $master->ResetUserPassword($data);
    if($response_data == true){
        $response['error'] = false;
        $response['message'] = "Reset Password Action Completed";
    }

}
else
{
    $response['error'] = true;
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>