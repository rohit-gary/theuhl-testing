<?php
@session_start();
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$authentication = new Authentication($conn);
$authenticated = $authentication->SessionCheck();

$response = array();
$response['error'] = true;
if(isset($_POST))
{
    $Organization = new Organization($conn);
    $data = $_POST;
    $data['CreatedBy'] = $_SESSION['dwd_email'];
    $response_data = $Organization->AddOrgModules($data);
    if($response_data == true)
    {
        $response['error']  = false;
        $response['message']  = "Modules have been added to module !";
    }else{
        $response['error']  = true;
        $response['message'] = "Some Technical Error ! Please Try Again";
    }

}
else
{
    $response['error']  = true;
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>