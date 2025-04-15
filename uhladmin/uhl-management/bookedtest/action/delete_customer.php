<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();

require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

$response = array();
$response['success'] = false;

if (isset($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']);
    
    // Update query to set IsActive to 0
    $query = "UPDATE checkout SET IsActive = 0 WHERE ID = ?";
    
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $customer_id);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Customer deleted successfully.';
        } else {
            $response['message'] = 'Failed to delete customer. Error: ' . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare statement. Error: ' . $conn->error;
    }
} else {
    $response['message'] = 'Customer ID not provided.';
}

// Set proper headers for JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$conn->close();
?> 