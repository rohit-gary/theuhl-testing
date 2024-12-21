<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['customer_id'])) {
    echo json_encode($_SESSION);
} else {
    echo json_encode(['customer_id' => null]);
}
?>