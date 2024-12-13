<?php 
class Users extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function getAllActiveUsers()
	{
		$filter = " where IsActive = 1 ORDER BY ID DESC";
		$users = $this->_getTableRecords($this->conn,'user_details',$filter);
		return $users;
	}
	function DuplicateUser_pass($data)
	{
		$user_email = $data['user_email'];
		$user_phone_number = $data['user_phone_number'];
		$filter = " where Email = '$user_email' or Mobile = '$user_phone_number'";
		$response = $this->check_unique_identity_filter($this->conn,'user_details', $filter);
		return $response;
	}
	function InsertUser($data)
	{
		$user_name = $data['user_name'];
		$user_email = $data['user_email'];
		$user_phone_number = $data['user_phone_number'];
		$password = $data['password'];
		$modules_id = $data['modules_id'];
		$organization_id = $data['organization_id'];
		$user_type = $data['user_type'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedBy = $data['CreatedBy'];
		$CreatedTime = $data['CreatedTime'];
		$sql = "INSERT INTO user_details(Name,Mobile,Email,UserType,CreatedDate,CreatedBy) VALUES ('$user_name','$user_phone_number','$user_email','$user_type','$CreatedDate','$CreatedBy')";
		$response_insert_user_details = $this->_InsertTableRecords($this->conn,$sql);
		if($response_insert_user_details['error'] == false)
		{
			$password_md5 = md5($password);
			$sql = "INSERT INTO users(Email,Password,UserType,ModuleID,OrgID,CreatedDate,CreatedTime) VALUES ('$user_email','$password_md5','$user_type','$modules_id','$organization_id','$CreatedDate','$CreatedTime')";
			$response_insert_user = $this->_InsertTableRecords($this->conn,$sql);
			return $response_insert_user;
		}
		else
		{
			return $response_insert_user_details;
		}

	}

	function DeleteUser($data)
	{
		$UserID = $data['ID'];
		// Delete company
		$where = " where ID = $UserID";
		$response = $this->delete_identity_filter($this->conn,"user_details",$where);
		return $response;
	}


}