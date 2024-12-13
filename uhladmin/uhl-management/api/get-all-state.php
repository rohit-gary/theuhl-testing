<?php
require_once('common_api_header.php');
require_once('../../vendor/autoload.php');
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");

$logs = new Logs();
$logs->SetCurrentAPILogFile();
$data_raw = file_get_contents('php://input');
$logs->WriteLog($data_raw, __FILE__, __LINE__);

$response = array();

try {
    // Instantiate the State class and fetch all active states
    $state_obj = new State($conn);
    $All_State = $state_obj->GetAllState();

    // Check if states are found
    if (!empty($All_State)) {
        $response['error'] = false;
        $response['data'] = $All_State;
    } else {
        $response['error'] = true;
        $response['message'] = "No active states found.";
    }

} catch (Exception $e) {
    // Catch any errors that occur during the process
    $response['error'] = true;
    $response['message'] = "Error: " . $e->getMessage();
}

$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
