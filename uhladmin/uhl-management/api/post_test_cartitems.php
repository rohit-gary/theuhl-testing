<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once "common_api_header.php";
require_once "../../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once "../include/autoloader.inc.php";
require_once "../include/db-connection.php";

$conf = new Configuration();
$secret_key = $conf->getJWTKey();

$data_raw = file_get_contents("php://input");
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw, __FILE__, __LINE__);

$data = json_decode($data_raw, true);
$response = [];

// Check if token and tests are present
if (!isset($data["token"]) || !isset($data["tests"])) {
    $response["error"] = true;
    $response["message"] = "Missing Required Fields";
    echo json_encode($response);
    exit;
}

try {
    $core = new Core();
    $token_decoded = JWT::decode($data["token"], new Key($secret_key, 'HS512'));
    
    $username = $token_decoded->data->username ?? '';
    $userId = $token_decoded->data->user_id ?? '';

    if (empty($userId)) {
        $response["error"] = true;
        $response["message"] = "Invalid token";
        echo json_encode($response);
        exit;
    }

    $cdate = date("Y-m-d");

    // Insert into carts table
    $sql = "INSERT INTO `carts` (`user_id`, `session_id`, `created_at`, `updated_at`, `IsCheckout`, `IsActive`) 
            VALUES ('$userId', 'NULL', '$cdate', '$cdate', '0', '1')";
    
    $cartInsertResponse = $core->_InsertTableRecords($conn, $sql);
    $cartID = $cartInsertResponse['last_insert_id'] ?? -1;

    if ($cartID == -1) {
        $response["error"] = true;
        $response["message"] = "Failed to create cart";
        echo json_encode($response);
        exit;
    }

    // Insert cart items
    $tests = $data["tests"];
    if (!is_array($tests)) {
        $response["error"] = true;
        $response["message"] = "Invalid test data";
        echo json_encode($response);
        exit;
    }

    foreach ($tests as $test) {
        $product_id = $test['product_id'] ?? '';
        $product_name = $test['product_name'] ?? '';
        $product_price = $test['product_price'] ?? '';

        $sql_2 = "INSERT INTO `cart_items` (`cart_id`, `product_id`, `product_name`, `product_price`, `quantity`, `created_at`) 
                  VALUES ('$cartID', '$product_id', '$product_name', '$product_price', '1', '$cdate')";

        $cartItemInsertResponse = $core->_InsertTableRecords($conn, $sql_2);

        if ($cartItemInsertResponse['error'] === true) {
            $response['error'] = true;
            $response['message'] = "Failed to add product to cart";
            echo json_encode($response);
            exit;
        }
    }

    // Generate checkout URL
    $response['error'] = false;
    $response['url'] = "https://unitedhealthlumina.com/our-test/checkout.php?user_id=$userId&cart_id=$cartID&source=mobile";

} catch (Exception $e) {
    $response["error"] = true;
    $response["message"] = "Token authentication failed!";
}

$logs->WriteLog(json_encode($response), __FILE__, __LINE__);
echo json_encode($response);
?>
