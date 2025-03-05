<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('../include/autoloader.inc.php');
require_once("../include/db-connection.php");
$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$data = json_decode($data_raw,true);
$response = array();
if(isset($data['token']))
{

	$jwt = $data['token'];
	try
	{
		$token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));        
		$username = $token_decoded->data->username;
		$userId = $token_decoded->data->user_id;
        $dbh = new Dbh();
        $core=new Core();
        $sql="SELECT 
			    c.ID AS CheckoutID, 
			    c.UserID, 
			    c.CartID, 
			    c.OrderID, 
			    c.PaymentID, 
			    c.Status, 
			    c.TotalAmount, 
			    c.PaymentMode, 
			    c.CreatedDate AS CheckoutDate, 
			    c.CreatedTime AS CheckoutTime, 
			    c.IsActive AS CheckoutActive,
			    
			    ci.id AS CartItemID, 
			    ci.cart_id AS CartID, 
			    ci.product_id, 
			    ci.product_name, 
			    ci.product_price, 
			    ci.quantity, 
			    ci.total_price, 
			    ci.created_at AS CartItemDate,

			    d.ID AS DeliveryID, 
			    d.FirstName, 
			    d.LastName, 
			    d.Phone, 
			    d.Address, 
			    d.Apartment, 
			    d.City, 
			    d.State, 
			    d.Postcode, 
			    d.Email, 
			    d.Notes, 
			    d.OrderID AS DeliveryOrderID, 
			    d.CreatedDate AS DeliveryDate, 
			    d.CreatedTime AS DeliveryTime, 
			    d.IsActive AS DeliveryActive

			FROM `checkout` c
			JOIN `cart_items` ci ON c.CartID = ci.cart_id
			JOIN `test_customer_delivery_info` d ON c.OrderID = d.OrderID
			WHERE c.UserID = $userId";
        $testresponse = $core->_getRecords($conn,$sql);
		$response['error'] = false;
		$response['data'] = $testresponse;
	}
	catch (Exception $e) {
	    
	        $logs->WriteLog($e->getMessage(), __FILE__, __LINE__);  
	    $response['error'] = true;
	    $response['message'] = "Invalid Token";
	}
}
else
{
	$response['error'] = true;
    $response['message'] = "Missing User Field";
}
$logs->WriteLog(json_encode($response),__FILE__,__LINE__);
echo json_encode($response);

?>