<?php 
class Zone extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
    public function DuplicateZone_pass($data)
	{
		$zone_name = $data['zone_name'];
		$filter = " where ZoneName = '$zone_name' ";
		$response = $this->check_unique_identity_filter($this->conn,'zone', $filter);
		return $response;
	}
	public function GetAllZones()
	{
		$where = " where IsActive = 1";
		$Zone_list = $this->_getTableRecords($this->conn,'zone',$where);
		return $Zone_list;
	}
	public function GetZoneDetails($data)
	{
		$ZoneID = $data['ZoneID'];
		// Delete company
		$where = " where ID = $ZoneID";
		$zone_details = $this->_getTableDetails($this->conn,"zone",$where);
		return $zone_details;
	}
	public function InsertZone($data)
	{
		$zone_name = $data['zone_name'];
        $zone_email = $data['zone_email'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `zone`(`ZoneName`,ZoneEmail, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$zone_name','$zone_email','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_details;
	}
	public function UpdateZoneDetails($data)
	{
		extract($data);
		$update_sql = " ZoneName = '$zone_name', ZoneEmail = '$zone_email' where ID = $zone_form_id";
		$response = $this->_UpdateTableRecords($this->conn,'zone',$update_sql);
		return $response;
	}
	

}