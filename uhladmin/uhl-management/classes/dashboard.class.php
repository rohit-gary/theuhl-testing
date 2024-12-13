<?php 
/**
 * DB Connect 
 */
class Dashboard extends Core
{ 
	private $conn;
	private $log_obj;
	public function __construct($conn,$log_obj)
	{
		$this->conn = $conn;
		$this->log_obj = $log_obj;
		$this->setTimeZone();
	}

	public function GetAppDashboardStats($data)
	{
		$stats = array();
		$stats['Initiated'] = 0;
		$stats['Draft'] = 0;
		$stats['Completed'] = 0;
		$stats['Total'] = 0;
		extract($data);
		$sql = "SELECT Status,Count(*) as status_count FROM `service_reports` where CreatedBy = '$username' GROUP BY Status";
		$this->log_obj->WriteLog($sql,__FILE__,__LINE__);
		//echo $sql;
		$result = mysqli_query($this->conn, $sql);
		if ($result) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) 
				{
					if($row['Status'] == "Initiated")
					{
						$stats['Initiated'] = $row['status_count'];
					}
					if($row['Status'] == "Draft")
					{
						$stats['Draft'] = $row['status_count'];
					}
					if($row['Status'] == "Completed")
					{
						$stats['Completed'] = $row['status_count'];
					}
					$stats['Total'] = $stats['Total'] + $row['status_count'];
				}
			}
		} 
		else 
		{
			$error = mysqli_error($this->conn);
			$this->log_obj->WriteLog($error,__FILE__,__LINE__);
		}
		return $stats;
	}
	
}