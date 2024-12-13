<?php
@session_start();
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$authentication = new Authentication($conn);
$authenticated = $authentication->SessionCheck();


$response = array();

if(isset($_POST))
{
   
    $user = new Users($conn);
    $data = $_POST;
    $response_data = $user->DeleteUser($data);

    if($response_data == true){
        $response['error'] = false;
        $response['message'] = "User Has been Deleted";
    }

}
else
{
    $response['error'] = true;
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>