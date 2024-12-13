<?php 
class Payment extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	

	public function  checkPaymentStatusByPolicyID($customerId){
		$where="where PolicyNumber = '$customerId'";
		$response=$this->_getTableDetails($this->conn,'payments',$where);
		return $response;
	}



}

?>