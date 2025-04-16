<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();

require_once('../../include/autoloader.inc.php');
include("../../include/get-db-connection.php");

// Debug: Log the received POST data
error_log("Received POST data: " . print_r($_POST, true));

// Check if customer ID is provided
if (isset($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']);
    error_log("Processing customer ID: " . $customer_id);

    // First check if the Processed column exists
    $check_column = "SHOW COLUMNS FROM checkout LIKE 'Processed'";
    $column_result = mysqli_query($conn, $check_column);
    
    if (!$column_result) {
        error_log("Error checking column: " . mysqli_error($conn));
        $response = [
            'success' => false, 
            'message' => 'Database error: ' . mysqli_error($conn)
        ];
    } elseif (mysqli_num_rows($column_result) == 0) {
        // Column doesn't exist, create it
        $add_column = "ALTER TABLE checkout ADD COLUMN Processed TINYINT(1) DEFAULT 0";
        if (mysqli_query($conn, $add_column)) {
            error_log("Added Processed column to checkout table");
        } else {
            error_log("Failed to add Processed column: " . mysqli_error($conn));
            $response = [
                'success' => false, 
                'message' => 'Failed to add Processed column: ' . mysqli_error($conn)
            ];
            echo json_encode($response);
            exit;
        }
    }

    // Update query to set Processed to 1 in checkout table
    $query = "UPDATE checkout SET Processed = 1 WHERE ID = ?";
    error_log("SQL Query: " . $query);
    
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $customer_id);

        if ($stmt->execute()) {
            error_log("Update successful for ID: " . $customer_id);
            $response = [
                'success' => true, 
                'message' => 'Order processed successfully.',
                'reload' => true
            ];
        } else {
            error_log("Update failed. Error: " . $stmt->error);
            $response = [
                'success' => false, 
                'message' => 'Failed to update order. Error: ' . $stmt->error
            ];
        }

        $stmt->close();
    } else {
        error_log("Statement preparation failed. Error: " . $conn->error);
        $response = [
            'success' => false, 
            'message' => 'Failed to prepare statement. Error: ' . $conn->error
        ];
    }
} else {
    error_log("No customer_id received in POST");
    $response = [
        'success' => false, 
        'message' => 'Order ID not provided.'
    ];
}

// Set proper headers for JSON response
header('Content-Type: application/json');
echo json_encode($response);
error_log("Response sent: " . json_encode($response));

// Close database connection
$conn->close();
?>