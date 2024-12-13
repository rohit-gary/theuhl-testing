<?php 
/**
 * DB Connect 
 */
class Dbh
{ 
	private $dbname;
	private $servername;
	private $dbusername;
	private $password;
	function __construct()
	{
		if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
		    $this->servername = "localhost";
		    $this->dbusername = "root";
		    $this->password = "";
		    $this->dbname = "uhl_master";
		}
		else
		{
			$this->servername = "localhost";
		    $this->dbusername = "root";
		    $this->password = "Gary@123";
		    $this->dbname = "uhl_master";
		}
	}

	public function _connectodb()
	{
		$connect = new mysqli($this->servername,$this->dbusername,$this->password,$this->dbname);
		if($connect->connect_error)
		{
			print_r("Connection Error: " . $connect->connect_error);
			return false;
		}
		else
		{
			return $connect;
		}
	}
}