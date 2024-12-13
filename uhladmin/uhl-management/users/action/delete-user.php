<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$authentication = new Authentication($conn);
$authenticated = $authentication->SessionCheck();
$response = array();
if(isset($_POST))
{
    $user = new CMUsers($conn);
    $data = $_POST;
    $response_data = $user->DeleteUser($data);
    if($response_data == true)
    {
        $response_data = $user->DeleteUserRole($data);
        if($response_data == true)
        {
            $master = new Master($master_conn);
            $response_delete_master = $master->DeleteMasterUser($data);
            if($response_delete_master == true)
            {
                $response['error'] = false;
                $response['message'] = "User Has been Deleted";
            }
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
    
   
    

}
else
{
    $response['error'] = true;
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>