<?php
class Router extends Core
{
	private $conn;
	private $dbname;
	private $servername;
	private $dbusername;
	private $password;
	public function __construct($data)
	{
		if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
			$this->servername = "localhost";
			$this->dbusername = $data['db_user_local'];
			$this->password = $data['db_password_local'];
			$this->dbname = $data['db_name_local'];
		} else {
			$this->servername = "localhost";
			$this->dbusername = $data['db_user_global'];
			$this->password = $data['db_password_global'];
			$this->dbname = $data['db_name_global'];
		}
		$this->setTimeZone();
	}

	public function _connectodb()
	{
		$response = array();
		try {
			$connect = new mysqli($this->servername, $this->dbusername, $this->password, $this->dbname);
			if ($connect->connect_error) {
				$error_message = "Connection Error: " . $connect->connect_error;
				$response['error'] = true;
				$response['message'] = $error_message;
			} else {
				$this->conn = $connect;
				$response['error'] = false;
				$response['message'] = "Connection Successful";
			}

		} catch (Exception $e) {
			var_dump($e);
			$response['error'] = true;
			$response['message'] = "Connection Failed";
		}
		return $response;
	}

	public function Client_InsertUserRole($users_info)
	{
		$response = array();
		$response['error'] = true;
		$UserID = $users_info['ID'];
		$CreatedDate = date("Y-m-d");
		$CreatedTime = date("H:i:s");
		$filter = " where UserID = $UserID";
		if ($this->check_unique_identity_filter($this->conn, 'user_roles', $filter)) {
			$sql_insert_user_role = "INSERT INTO user_roles(UserID,Role,CreatedDate,CreatedTime)VALUES($UserID,'System Admin','$CreatedDate','$CreatedTime')";
			$response = $this->_InsertTableRecords($this->conn, $sql_insert_user_role);
		} else {
			$response['error'] = false;
			$response['message'] = "Users Already Synced";
		}
		return $response;
	}

	public function Client_GetUserRole($user_id)
	{
		$user_roles = array();
		$where = " where UserID = $user_id and IsActive = 1";
		$roles_array = $this->_getTableRecords($this->conn, 'user_roles', $where);
		foreach ($roles_array as $role) {
			array_push($user_roles, $role);
		}
		return $user_roles;
	}


}