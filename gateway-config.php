<?php 
$key="eOcHaF";
$salt="Ha3K9IO8KQXyAqOdIAtB6lAz7PLa7wD3";
$mode='live';  
$success_url="https://theuhl.in//response.php"; // set your success page url response.php path
$failed_url="https://theuhl.in//failed.php"; // Transaction failed  page URL failed.php path 
$cancelled_url="https://theuhl.in//cancelled.php"; // Transaction cancelled  page URL cancelled.php path
// Please do not change anything after this line..
if($mode=='live')
{
$action = 'https://secure.payu.in/_payment';	
}
// else {
// $action = 'https://test.payu.in/_payment';	
// $key="oZ7oo9";
// $salt="UkojH5TS";
// }
?>