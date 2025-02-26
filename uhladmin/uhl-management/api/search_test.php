<?php
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

if (isset($data['query']) && !empty(trim($data['query']))) {
    try {
        $searchQuery = strtolower(trim($data['query']));
        $sql = "SELECT ID, TestName, TestFee FROM doc_test WHERE LOWER(TestName) LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%$searchQuery%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $tests = [];
        while ($test = $result->fetch_assoc()) {
            $test['ID'] = base64_encode($test['ID']); // Encoding ID
            $baseprice = intval($test['TestFee']);
            $off = 0.16 * $baseprice;
            $test['OriginalPrice'] = intval($baseprice + $off);
            $test['Discount'] = "16% OFF";
            $tests[] = $test;
        }

        if (!empty($tests)) {
            $response['error'] = false;
            $response['data'] = $tests;
        } else {
            $response['error'] = true;
            $response['message'] = "No results found.";
        }
    } catch (Exception $e) {
        $response['error'] = true;
        $response['message'] = "Database error: " . $e->getMessage();
    }
} else {
    $response['error'] = true;
    $response['message'] = "Search query is missing.";
}

$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
