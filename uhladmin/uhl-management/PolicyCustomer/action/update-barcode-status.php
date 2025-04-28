<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();

require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$response = array();
$response['success'] = false;

if (isset($_POST['PolicyNumber']) && isset($_POST['status'])) {
    $policyNumber = $_POST['PolicyNumber'];
    $status = intval($_POST['status']);
    
    // Update query to set IsBarcode status
    $query = "UPDATE customerpolicy SET IsBarcode = ? WHERE PolicyNumber = ?";
    
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("is", $status, $policyNumber);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Barcode status updated successfully.';
        } else {
            $response['message'] = 'Failed to update barcode status. Error: ' . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare statement. Error: ' . $conn->error;
    }
} else {
    $response['message'] = 'Policy Number or status not provided.';
}

// Set proper headers for JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$conn->close();
?> 