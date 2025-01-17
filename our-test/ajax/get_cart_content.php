<?php
session_start();

// Initialize database connection and fetch the cart items using temp_user_id
require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
include("../../uhladmin/uhl-management/include/db-connection.php");

$Test_obj = new Test($conn);
$temp_user_id = $_SESSION['temp_user_id'];

// Fetch cart items from the database
$cartItems = $Test_obj->GetCartItemsByTempUserId($temp_user_id);

var_dump($cartItems);

// Check if the cart is not empty
if (count($cartItems) > 0) {
    $totalPrice = 0; // Initialize total price
    $totalTests = count($cartItems); // Total items in the cart

    // Loop through the fetched cart items
    foreach ($cartItems as $index => $item) {
        if ($item['ProductID'] && $item['ProductName'] && $item['ProductPrice']) {
            // Ensure that ProductPrice is numeric before adding it
            $productPrice = is_numeric($item['ProductPrice']) ? floatval($item['ProductPrice']) : 0;

            $totalPrice += $productPrice; // Accumulate total price

            // Render individual cart items
            echo '<div class="card shadow-sm mb-3" id="cart-item-' . $index . '">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Item Details -->
                            <div class="col-sm-8 col-md-8 col-lg-8">
                                <h5 class="card-title mb-1"><strong>' . htmlspecialchars($item['ProductName']) . '</strong></h5>
                                <p class="card-text text-muted mb-0">Price: &#8377;' . number_format($productPrice, 2) . '</p>
                            </div>
                            
                            <!-- Remove Button -->
                            <div class="col-sm-4 col-md-4 col-lg-4 text-end">
                                <button class="btn btn-danger btn-sm remove-item" data-product-id="' . $item['ProductID'] . '" aria-label="Remove ' . htmlspecialchars($item['ProductName']) . ' from cart">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }

    // Render the footer with total price and proceed button
    echo '<div class="offcanvas-footer bg-light pt-3 mt-4 rounded">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-2">    
                        <i class="fa fa-shopping-cart"></i>
                    </div>

                    <!-- Total Price and Total Tests -->
                    <div class="col-4">
                        <p class="mb-1 text-green" style="color: #009688"><b>₹ ' . number_format($totalPrice, 2) . '</b></p>
                        <p class="mb-0">' . $totalTests . ' Test' . ($totalTests > 1 ? 's' : '') . '</p>
                    </div>
                    
                    <!-- Proceed Button -->
                    <div class="col-6">
                        <form action="#" method="POST">
                            <button type="button" class="btn site-button appointment-btn btnhover13 btn-rounded px-4"  onclick="saveTestItem()">
                                Proceed
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
} else {
    echo '
          <div class="text-center my-5">
            <div style="background-color: #f8f9fa; border-radius: 50%; width: 200px; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                <img src="../project-assets/images/emptycart-gif.gif" alt="Empty Cart" class="img-fluid" style="border-radius: 50%; max-width: 100%; max-height: 100%;">
            </div>
            <h1 class="mt-4" style="color: #6c757d;">Oops, Cart is Empty Now</h1>
        </div>';
}
?>
