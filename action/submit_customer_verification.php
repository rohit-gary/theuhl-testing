<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");
include("../uhladmin/uhl-management/controllers/common_controller.php");
$data = $_POST;
$response = array();
$response['error'] = true;
$response['message'] = "Some Technical Error! Please Try Again.";
if (isset($data['MobileNumber'])) {
    $core = new Core($conn);
    $table = 'varify_customer';
    $columns = ['Name', 'MobileNumber', 'NumberOfMember', 'Address', 'CreatedDate', 'CreatedTime', 'LinkExpire'];
    $values = [
        $data['Name'] ?? '',
        $data['MobileNumber'] ?? '',
        $data['NumberOfMember'] ?? '',
        $data['Address'] ?? '',
        date('Y-m-d'),
        date('H:i:s'),
        date('Y-m-d H:i:s', strtotime('+24 hours')),
    ];
    $response = $core->_InsertPreparedData($conn, $table, $columns, $values);
} 

echo json_encode($response);
?>
