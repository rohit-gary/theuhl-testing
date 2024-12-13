<?php
header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
$data_raw = file_get_contents('php://input');
date_default_timezone_set('Asia/Kolkata');
$result_array["error"] = false;
$result_array["version"] = "1.0";
echo json_encode($result_array);
?>