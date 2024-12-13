<?php 
class Notification extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	

	public function  GetAllNotification(){
		$where="where IsActive = 1 ";
		$response=$this->_getTableDetails($this->conn,'notification',$where);
		return $response;
	}



}

?>