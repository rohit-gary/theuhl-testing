<?php
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$authentication = new Authentication($conn);
$UserType = $authentication->SessionCheck();
$MappingID = $_POST['MappingID'];
$core = new Core();
$where = " where ID = $MappingID";
echo json_encode($core->_getTableDetails($conn,'org_module_mapping',$where));
?>