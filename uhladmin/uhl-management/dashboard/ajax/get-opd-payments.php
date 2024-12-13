<?php
@session_start();
require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");
$core = new Core();
$core->setTimeZone();


// Initialize an empty array to store the last 7 dates
$lastSevenDates = array();

// Get today's date
$currentDate = new DateTime();

// Loop to get the last 7 dates
for ($i = 1; $i < 8; $i++) {
    // Clone the current date
    $date = clone $currentDate;
    // Subtract $i days from the current date
    $date->modify("-$i day");
    // Format the date as per your requirement
    $formattedDate = $date->format('Y-m-d');
    // Push the formatted date into the array
    $lastSevenDates[] = $formattedDate;
}

// Reverse the array to get the dates in descending order
$lastSevenDates = array_reverse($lastSevenDates);

$consultations_obj = new Consultation($conn);
$data = $consultations_obj->GetOPDPaymentDataGroupedByPaymentMode($lastSevenDates);
$graph_data = array();
$graph_data_labels = array();
foreach ($data as $payment_mode => $total) {
  array_push($graph_data,$total);
  array_push($graph_data_labels,$payment_mode);
}
$response['chart_data']['data'] = $graph_data;
$response['chart_data']['data_labels'] = $graph_data_labels;
echo json_encode($response);
?>