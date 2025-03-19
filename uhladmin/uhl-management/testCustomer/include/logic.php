<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
require_once('../include/autoloader.inc.php');
include("../include/db-connection.php");

$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$test_obj = new Test($conn);
$all_test=$test_obj->GetAllTestName();
?>