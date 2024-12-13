<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$timeInterval = isset($_GET['interval']) ? $_GET['interval'] : 7;
// Fetch data from your database
// $sql = "SELECT `CreatedDate`, COUNT(*) AS ticket_count FROM general_service_report GROUP BY `CreatedDate`;";
$sql = "SELECT CreatedDate, COUNT(*) AS ticket_count
        FROM general_service_report
        WHERE CreatedDate >= DATE_SUB(CURDATE(), INTERVAL $timeInterval DAY)
        GROUP BY CreatedDate";
$result = $conn->query($sql);

// print_r($result);

// Format data for JavaScript
$data = array(
    'CreatedDate' => array(),
    'ticket_count' => array()
);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($data['CreatedDate'], $row['CreatedDate']);
        array_push($data['ticket_count'], $row['ticket_count']);
    }
}

echo json_encode($data);

$conn->close();
?>