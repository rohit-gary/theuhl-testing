<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");

$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$policy = new PolicyCustomer($conn);

?>