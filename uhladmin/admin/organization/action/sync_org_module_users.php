<?php
@session_start();
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$authentication = new Authentication($conn);
$authenticated = $authentication->SessionCheck();
$core = new Core();
$response = array();
$response['error'] = true;
if(isset($_POST))
{
    $MappingID = $_POST['MappingID'];
    // Get Database Setting
    $where = " where ID = $MappingID";
    $mapping_info = $core->_getTableDetails($conn,'org_module_mapping',$where);
    // Get Users
    $where = " where OrgID = ".$mapping_info['OrgID']." AND UserType = 'Client Admin'";
    $users_info = $core->_getTableDetails($conn,'users',$where);
    // Connect to according database
    $router = new Router($mapping_info);
    $response = $router->_connectodb();
    if($response['error'] == false)
    {
         $response = $router->Client_InsertUserRole($users_info);
    }
    else
    {
        $response = $response_connection;
    }
}
else
{
    $response['error']  = true;
    $response['message'] = "Technical Problem. Please try again";
}
echo json_encode($response);
?>