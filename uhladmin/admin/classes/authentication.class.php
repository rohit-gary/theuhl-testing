<?php
class Authentication extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function login($data)
	{
		$response = array();
		$email = $data['email'];
		$password = $data['password'];
		$password_hash = md5($password);
		$filter = " where (Email = '$email' or UserName = '$email') and Password = '$password_hash'";
		$num_rows = $this->_getTotalRows($this->conn,'users', $filter);
		if($num_rows > 0)
		{
			$row = $this->_getTableDetails($this->conn,'users',$filter);
			$response['UserType'] = $data['UserType'] = $row['UserType'];
			$data['UserID'] = $row['ID'];
			$data['OrgID'] = $row['OrgID'];
			$data['UserName'] = $row['UserName'];
			$response['data'] = $data;
			$response['error'] = false;
			$response['message'] = "User authenticated";
			$response['username'] = $row['UserName'];
			//$this->SessionStart($data);
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "Invalid Credentials, Please try again with valid credentials";
		}
		return $response;
	}

	public function mobilelogin($data)
	{
		$response = array();
		$phonenumber = $data['PhoneNumber'];
		$OTP = $data['OTP'];
		

		$ss=1;

		$filter = "WHERE PhoneNumber = '$phonenumber' AND (OTP=$OTP AND IsActive='$ss')";
    $filter_2 = "WHERE PhoneNumber = '$phonenumber'";

		$num_rows = $this->_getTotalRows($this->conn,'temp_otp', $filter);
		
		
		if($num_rows > 0)
		{
			$row = $this->_getTableDetails($this->conn,'users',$filter_2);
			$response['UserType'] = $data['UserType'] = $row['UserType'];
			$data['UserID'] = $row['ID'];
			$data['OrgID'] = $row['OrgID'];
			$data['UserName'] = $row['UserName'];
			$response['data'] = $data;
			$response['error'] = false;
			$response['message'] = "User authenticated";
			$response['username'] = $row['UserName'];
			//$this->SessionStart($data);
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "Invalid Credentials, Please try again with valid credentials";
		}
		return $response;
	}

	public function SessionStart($data)
	{
		@session_start();
	    $_SESSION['dwd_email'] = $data['UserName'];
	    $_SESSION['dwd_UserType'] = $data['UserType'];
	    $_SESSION['dwd_UserID'] = $data['UserID'];
	    $_SESSION['dwd_OrgID'] = $data['OrgID'];
	    if(isset($data['redirect_link']))
	    {
	    	$_SESSION['redirect_link'] = $data['redirect_link'];
	    	$_SESSION['roles'] = $data['roles'];
	    	setcookie('redirect_link',$data['redirect_link'],time() + (86400 * 30));
			setcookie('roles',json_encode($data['roles']),time() + (86400 * 30));
	    }
	    setcookie('dwd_email',$data['UserName'],time() + (86400 * 30));
		setcookie('dwd_UserType',$data['UserType'],time() + (86400 * 30));
		setcookie('dwd_UserID',$data['UserID'],time() + (86400 * 30));
		setcookie('dwd_OrgID',$data['OrgID'],time() + (86400 * 30));
		
	}
	public function AddModuleRoletoSession($data)
	{
		$_SESSION['redirect_link'] = $data['redirect_link'];
    	$_SESSION['roles'] = $data['roles'];
    	$_SESSION['multi_modules'] = $data['multi_modules'];
    	setcookie('redirect_link',$data['redirect_link'],time() + (86400 * 30));
		setcookie('roles',json_encode($data['roles']),time() + (86400 * 30));
		setcookie('multi_modules',json_encode($data['multi_modules']),time() + (86400 * 30));
	}
	public function SessionCheck()
	{
		@session_start();
		if(isset($_SESSION['dwd_UserType']))
		{
			return $_SESSION['dwd_UserType'];
		}
		else
		{
			if(isset($_COOKIE['dwd_UserType']))
			{
				$_SESSION['dwd_email'] = $_COOKIE['dwd_email'];
				$_SESSION['dwd_UserType'] = $_COOKIE['dwd_UserType'];
				return $_SESSION['UserType'];
			}
			else
			{
				if(file_exists("../login.php"))
					header('Location: ../admin/');
				else
					header('Location:../../admin/');
				return false;
			}
			
		}
	}
	public function CheckRole($role)
	{
		$roles_array = $_SESSION['roles'];
		foreach($roles_array as $i_role)
		{
			if($i_role['Role'] == $role)
			{
				return true;
			}
		}
		return false;
	}
	
}
