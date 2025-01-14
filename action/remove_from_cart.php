<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $index = intval($_POST['index']);

    // Remove the item from the cart
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
    }

    // Return the updated cart
    echo json_encode([
        'success' => true,
        'items' => $_SESSION['cart'],
        'count' => count($_SESSION['cart'])
    ]);
} else {
    echo json_encode(['success' => false]);
}
?>
