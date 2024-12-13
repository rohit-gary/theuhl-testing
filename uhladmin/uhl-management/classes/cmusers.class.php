<?php 
class CMUsers extends Core
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
	public function GetUsersList($Role)
	{
		$sql = "SELECT a.Role,b.* FROM `user_roles` a LEFT JOIN user_details b ON a.UserID = b.UserID WHERE a.Role = '$Role'";
		$users_list = $this->_getRecords($this->conn,$sql);
		return $users_list;
	}
	public function getAllUserRoles()
	{
		$user_roles_array = array();
		$filter = " where IsActive = 1";
		$user_roles = $this->_getTableRecords($this->conn,'user_roles',$filter);
		foreach($user_roles as $user_role)
		{
			$UserID = $user_role['UserID'];
			if(isset($user_roles_array[$UserID]['Role']))
			{
				$user_roles_array[$UserID]['Role'] = $user_roles_array[$UserID]['Role'].",".$user_role['Role'];
			}
			else
			{
				$user_roles_array[$UserID]['Role'] = $user_role['Role'];
			}
		}
		return $user_roles_array;
	}
	public function DuplicateUser_pass($data)
	{
		$user_email = $data['user_email'];
		$user_phone_number = $data['user_phone_number'];
		$filter = " where Email = '$user_email' or Mobile = '$user_phone_number'";
		$response = $this->check_unique_identity_filter($this->conn,'user_details', $filter);
		return $response;
	}
	public function InsertUser($data)
	{
		$user_role = $data['user_type'];
		$UserID = $data['UserID'];
		$user_name = $data['user_name'];
		$user_username = $data['user_username'];
		$user_phone_number = $data['user_phone_number'];
		$user_email = $data['user_email'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$ta_address = $data['ta_address'];
		$user_aadhar = $data['user_aadhar'];
		$user_pan = $data['user_pan'];
		$sql = "INSERT INTO user_details(UserID,UserName,Name,PhoneNumber,Email,Address,Aadhar,PAN,CreatedDate,CreatedTime,CreatedBy) VALUES ($UserID,'$user_username','$user_name','$user_phone_number','$user_email','$ta_address','$user_aadhar','$user_pan','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_user_details = $this->_InsertTableRecords($this->conn,$sql);
		if($response_insert_user_details['error'] == false)
		{
			$sql = "INSERT INTO user_roles(UserID,Role,CreatedDate,CreatedTime) VALUES ($UserID,'$user_role','$CreatedDate','$CreatedTime')";
			$response_insert_user = $this->_InsertTableRecords($this->conn,$sql);
			return $response_insert_user;
		}
		else
		{
			return $response_insert_user_details;
		}

	}
	public function GetUserDetails($data)
	{
		$UserID = $data['UserID'];
		// Delete company
		$where = " where UserID = $UserID";
		$user_details = $this->_getTableDetails($this->conn,"user_details",$where);
		$user_details['Role'] = $this->_getTableDetails($this->conn,"user_roles",$where)['Role'];
		return $user_details;
	}
	public function UpdateUserDetails($data)
	{
		extract($data);
		$update_sql = " Name = '$user_name',PhoneNumber = '$user_phone_number',Email='$user_email',Address='$ta_address',Aadhar='$user_aadhar',PAN='$user_pan' where UserID = $form_id";
		$response = $this->_UpdateTableRecords($this->conn,'user_details',$update_sql);
		if($response['error'] == false)
		{
			$update_sql = " Role = '$user_type' where UserID = $form_id";
			$response_update_role = $this->_UpdateTableRecords($this->conn,'user_roles',$update_sql);
		}
		return $response;
	}
	public function DeleteUser($data)
	{
		$UserID = $data['ID'];
		$where = " where UserID = $UserID";
		$response = $this->delete_identity_filter($this->conn,"user_details",$where);
		return $response;
	}
	public function DeleteUserRole($data)
	{
		$UserID = $data['ID'];
		$where = " where UserID = $UserID";
		$response = $this->delete_identity_filter($this->conn,"user_roles",$where);
		return $response;
	}

	public function getAllPlanLead()
	{
		$filter = " where IsActive = 1 and UserType = 'Plan Lead' ORDER BY ID DESC";
		$users = $this->_getTableRecords($this->conn,'user_details',$filter);
		return $users;
	}

	public function GetUserDetailsByID($ID){
		$where="where ID=$ID";
		$user_details = $this->_getTableDetails($this->conn,"user_details",$where);
		return $user_details;
	}

	public function GetUserProfile($ID){
		$where="where ID=$ID";
		$user_details = $this->_getTableDetails($this->conn,"users",$where);
		return $user_details;
	}

}