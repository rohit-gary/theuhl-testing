<?php 
class Session extends Core
{
	private $conn;
	public function __construct()
	{
		$this->setTimeZone();
	}

	public function SessionCheck_redirect()
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
				return $_SESSION['dwd_UserType'];
			}
			else
			{
				if(file_exists("../login.php"))
				{
					$this->redirect("../admin/authentication/login.php");
				}
				elseif(file_exists("../../admin/authentication/login.php"))
				{
					$this->redirect("../../admin/authentication/login.php");
				}
				elseif(file_exists("../../../admin/authentication/login.php"))
				{
					$this->redirect("../../../admin/authentication/login.php");
				}
				else
				{
					
				}

			}
		}
	}
}