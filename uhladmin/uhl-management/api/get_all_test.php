<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");

$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw, __FILE__, __LINE__);

$data = json_decode($data_raw, true);
$response = array();

try {
    $Test_Obj = new Test($conn);

       if (isset($data['start_counter'])) {
                $start_counter = $data['start_counter'];
                $no_of_records = $data['no_of_records'];
                $filter_limit = " LIMIT $start_counter, $no_of_records ";
            }
    if (isset($data['query']) && !empty(trim($data['query']))) {
        $searchQuery = strtolower(trim($data['query']));
        $all_tests = $Test_Obj->GetTestBySearch($searchQuery, $start_counter, $no_of_records); 
    } else {
        $all_tests = $Test_Obj->GetAllTestNameFilter($filter_limit);

        $where = " where IsActive = 1 "; 
    }

    if (!empty($all_tests)) {
        $response['error'] = false;
        $response['data'] = $all_tests;
    } else {
        $response['error'] = true;
        $response['message'] = "No results found.";
    }
} catch (Exception $e) {
    $response['error'] = true;
    $response['message'] = "Database error: " . $e->getMessage();
}

$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
