<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");

$Test_obj = new Test($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $index = intval($_POST['index']);
    $temp_user_id = $_SESSION['TempUserID']; // Get TempUserID from session

    // Get the cart items based on TempUserID
    $cartItems = $Test_obj->GetCartItemsByTempUserId($temp_user_id);
    print_r($cartItems);
    die();

    if ($cartItems) {
        // Find the item based on the index
        $item_to_remove = $cartItems[$index] ?? null; // Check if item exists at the provided index

        if ($item_to_remove) {

            $where = " WHERE TempUserID = $temp_user_id AND ID = " . $item_to_remove['product_id'];
            $delete_result = $Test_obj->DeleteTestCartItem($where);

            if ($delete_result) {
              
                $updated_cart = $Test_obj->GetCartItemsByTempUserId($temp_user_id);
                
                // Return updated cart items as JSON response
                echo json_encode([
                    'success' => true,
                    'items' => $updated_cart,
                    'count' => count($updated_cart)
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove item from cart']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Item not found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No items in cart']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
