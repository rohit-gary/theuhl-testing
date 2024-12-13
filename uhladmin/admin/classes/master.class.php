<?php 
class Master extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function CheckDuplicateUser($data)
	{
		$user_username = $data['user_username'];
		$email_id = $data['user_email'];
		$response = array();
		$where = " where Email = '$email_id' OR UserName = '$user_username' and IsActive = 1";
		if($this->check_unique_identity_filter($this->conn,'users',$where))
		{
			$response['error'] = false;
			$response['message'] = "Unique User";
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "A user is already registered with same Username or Email, please change the values and try again!";
		}
		return $response;
	}
	
	public function InsertMasterUser($data)
	{
		$user_name = $data['user_name'];
		$user_username = $data['user_username'];
		$user_phone_number = $data['user_phone_number'];
		$email = $data['user_email'];
		$OrgID = $data['OrgID'];
		$password = md5($data['password']);
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$sql = "INSERT INTO users(UserName,Name,PhoneNumber,Email,Password,UserType,OrgID,CreatedDate,CreatedTime) VALUES ('$user_username','$user_name','$user_phone_number','$email','$password','Client User',$OrgID,'$CreatedDate','$CreatedTime')";
		$response_insert_user = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_user;
	}
	public function UpdateMasterUserDetails($data)
	{
		extract($data);
		$sql_update_user = " Name = '$user_name',PhoneNumber='$user_phone_number',Email='$user_email' where ID = $form_id";
		$response_update = $this->_UpdateTableRecords($this->conn,'users',$sql_update_user);
		return $response_update;
	}
	public function DeleteMasterUser($data)
	{
		$UserID = $data['ID'];
		$filter_delete_user = " where ID = $UserID";
		$response_delete = $this->delete_identity_filter($this->conn,'users',$filter_delete_user);
		return $response_delete;
	}
	public function ResetUserPassword($data)
	{
		$UserEmail = $data['rp_user_email'];
		$Password = $data['r_password'];
		$Password_md5 = md5($Password);
		$update_query = " Password = '$Password_md5' where Email = '$UserEmail'";
		$response = $this->_UpdateTableRecords($this->conn,'users',$update_query);
		return $response;
	}
}