<?php 
/**
 * DB Connect 
 */
class Roleshandler extends Core
{ 
	public function __construct()
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function getRoleAccess($Role,$Submodule)
	{
		$where = " where Role = '$Role' and Submodule = '$Submodule'";
		$access = $this->_getTableDetails($this->conn,'user_roles_submodule',$where);
		return $access;
	}
}
?>