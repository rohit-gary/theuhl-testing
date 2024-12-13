<?php 
class Dashboard extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

	public function GetAdminDashboardStats()
	{
		$stats = array();

		$filter = " where IsActive = 1";
		$stats['TotalUser'] = $this->_getTotalRows($this->conn,'users', $filter);

		$filter = " where IsActive = 1";
		$stats['TotalModules'] = $this->_getTotalRows($this->conn,'modules', $filter);

		$filter = " where IsActive = 1";
		$stats['TotalOrganization'] = $this->_getTotalRows($this->conn,'organization', $filter);

		return $stats;
	}
	public function GetCounsellorDashboardStats($counsellor_email)
	{
		$stats = array();
		
		$filter = " where CounsellorEmail = '$counsellor_email' and PaymentStatus='Yes'";
		$stats['Payment_Links_successfull'] = $this->_getTotalRows($this->conn,'student_payment', $filter);

		$filter = " where CreatedBy = '$counsellor_email'";
		$stats['Payment_Links_generated'] = $this->_getTotalRows($this->conn,'student_fee', $filter);

		return $stats;
	}
}
?>