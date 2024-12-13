<?php 
/**
 * DB Connect 
 */
class Clientdbh
{ 
	private $dbname;
	private $servername;
	private $dbusername;
	private $password;
	function __construct($servername,$dbusername,$password,$dbname)
	{
		$this->servername = $servername;
	    $this->dbusername = $dbusername;
	    $this->password = $password;
	    $this->dbname = $dbname;
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