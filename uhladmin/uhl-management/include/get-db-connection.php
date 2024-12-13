<?php
$session = new Session();
$session->SessionCheck_redirect();
$conf = new Configuration;
$client_module_id = $conf->module_id;
$OrgID = $_SESSION['dwd_OrgID'];
$dbh = new Dbh();
$master_conn = $dbh->_connectodb();
$org_module_db_details = $conf->getClientDB($master_conn,$OrgID,$client_module_id);
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)
{
   $client_dbh = new Clientdbh("localhost",$org_module_db_details['db_user_local'],$org_module_db_details['db_password_local'],$org_module_db_details['db_name_local']);
}
else
{
   $client_dbh = new Clientdbh("localhost",$org_module_db_details['db_user_global'],$org_module_db_details['db_password_global'],$org_module_db_details['db_name_global']);
}
$conn = $client_dbh->_connectodb();

?>