<?php
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_POST['action'] === 'add') {
    // Get product details
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Add product to cart
    $product = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice
    ];
    $_SESSION['cart'][] = $product;

    // Return the updated cart data
    echo json_encode([
        'cartCount' => count($_SESSION['cart']),
        'cartItems' => $_SESSION['cart']
    ]);
}
?>
