<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$timeInterval = isset($_GET['period']) ? $_GET['period'] : 7;
// Fetch data from your database
// $sql = "SELECT `CreatedDate`, COUNT(*) AS ticket_count FROM general_service_report GROUP BY `CreatedDate`;";
$sql = "SELECT t.CompanyID, c.CompanyName, COUNT(*) AS ticket_count FROM general_service_report t JOIN company c ON t.CompanyID = c.ID WHERE t.`CreatedDate` >= DATE_SUB(CURDATE(), INTERVAL $timeInterval DAY) GROUP BY t.CompanyID, c.CompanyName;";
$result = $conn->query($sql);

// print_r($result);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            'companyName' => $row['CompanyName'],
            'companyID' => $row['CompanyID'],
            'ticketCount' => $row['ticket_count']
        );
    }
}

echo json_encode($data);

$conn->close();
?>