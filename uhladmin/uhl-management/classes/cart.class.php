<?php
class Cart extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

	public function GetcartItemByUserId($userId)
	{

		$where = " where user_id = $userId";
		$cart_detials = $this->_getTableDetails($this->conn, "carts", $where);
		return $cart_detials;
	}

	public function GetcartItem($cart_id, $product_id)
	{
		$where = " where cart_id = $cart_id AND product_id=$product_id";
		$cart_detials = $this->_getTableDetails($this->conn, "cart_items", $where);
		return $cart_detials;
	}

	public function GetcartItemBySessionId($sessionId)
	{

		$where = " where session_id = '$sessionId'";
		$cart_detials = $this->_getTableDetails($this->conn, "carts", $where);
		return $cart_detials;
	}


	public function InsertuserIdIntocart($userid)
	{

		$UserId = $userid;
		$sql = "INSERT INTO `carts`(`user_id`) VALUES ('$UserId')";
		echo $sql;
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
	}

	public function InsertsessionIdIntocart($sessionId)
	{
		$SessionId = $sessionId;
		$sql = "INSERT INTO `carts`(`session_id`) VALUES ('$SessionId')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
	}

	public function InsertTestCartItem($data)
	{
		$cart_id = $data['cart_id'];
		$product_id = $data['product_id'];
		$product_name = $data['product_name'];
		$product_price = $data['product_price'];
		$quantity = $data['quantity'];

		$sql = "INSERT INTO `cart_items`(`cart_id`,`product_id`,`product_name`,`product_price`,`quantity`) VALUES ('$cart_id','$product_id','$product_name','$product_price','$quantity')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;


	}


	public function UpdatecartitemQunatity($quantity, $id)
	{
		$update_sql = "quantity = '$quantity'  where id = $id";
		$response = $this->_UpdateTableRecords($this->conn, 'cart_items', $update_sql);
		return $response;
	}

	public function GetCartItemByCartID($CartId)
	{
		$where = "WHERE cart_id  = $CartId ";
		$cart_detials = $this->_getTableRecords($this->conn, "cart_items", $where);
		return $cart_detials;
	}


	public function RemoveItemFromCart($itemId, $cartId)
	{
		$where = " WHERE id = $itemId AND cart_id = $cartId";
		$cart_detials = $this->delete_identity_filter($this->conn, "cart_items", $where);
		return $cart_detials;
	}
	public function UpdatecartCheckout($cart_id)
	{
		$sql = "`IsCheckout` = 1 WHERE `id` = $cart_id";
		$cart_detials = $this->_UpdateTableRecords($this->conn, 'carts', $sql);
		return $cart_detials;
	}

	public function GertCartDetails($cart_id)
	{
		$where = "WHERE  id  = $cart_id";
		$cart_detials = $this->_getTableRecords($this->conn, "carts", $where);
		return $cart_detials;
	}

	public function InsertCartDetails($data)
	{
		$sql = "INSERT INTO `user_cart`(`UserID`,`TempCartID`,`CreatedDate`,`CreatedTime`) VALUES ('$data[user_id]','$data[cart_id]','$data[CreatedDate]','$data[CreateTime]')";
		$response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
		return $response_insert_details;
	}
	public function DeleteCart($cart_id)
	{
		$where = " WHERE id = $cart_id";
		$cart_detials = $this->delete_identity_filter($this->conn, "carts", $where);
		return $cart_detials;
	}

}



?>