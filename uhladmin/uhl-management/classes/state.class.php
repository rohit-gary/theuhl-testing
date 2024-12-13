<?php 
class State extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function GetAllState()
	{
		$where = " where IsActive = 1";
		$services_list = $this->_getTableRecords($this->conn,'state',$where);
		return $services_list;
	}


	public function GetStateNameByID($ID){
	 $where = " where ID = $ID";
		$state = $this->_getTableRecords($this->conn,'state',$where);
		return $state;
}

}

?>