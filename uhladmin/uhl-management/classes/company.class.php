<?php 
class  Company extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function GetCompaniesList()
	{
		$where = " where IsActive = 1";
		$companies_list = $this->_getTableRecords($this->conn,'company',$where);
		return $companies_list;
	}
	public function GetCompanyDetails($data)
	{
		$CompanyID = $data['CompanyID'];
		// Delete company
		$where = " where ID = $CompanyID";
		$company_details = $this->_getTableDetails($this->conn,"company",$where);
		return $company_details;
	}
	public function setCompanyArraybyID()
	{
		$company_array = array();
		$companies_list = $this->GetCompaniesList();
		foreach($companies_list as $company)
		{
			extract($company);
			$company_array[$ID]['CompanyName'] = $CompanyName;
		}
		return $company_array;
	}
	public function setCompanyArraybyName()
	{
		$company_array = array();
		$companies_list = $this->GetCompaniesList();
		foreach($companies_list as $company)
		{
			extract($company);
			$company_array[$CompanyName]['ID'] = $ID;
		}
		return $company_array;
	}
	public function GetCompanySitesList($CompanyID)
	{
		if($CompanyID != -1)
		{
			$where = " where CompanyID = $CompanyID AND IsActive = 1";
		}
		else
		{
			$where = " where IsActive = 1";
		}
		$company_sites_list = $this->_getTableRecords($this->conn,'company_sites',$where);
		return $company_sites_list;
	}
	public function setCompanySiteArraybyID()
	{
		$company_site_array = array();
		$where = " where IsActive = 1";
		$company_sites_list = $this->_getTableRecords($this->conn,'company_sites',$where);
		foreach($company_sites_list as $company_site)
		{
			extract($company_site);
			$company_site_array[$ID]['CompanySite'] = $SiteName;
		}
		return $company_site_array;
	}

	public function InsertCompany($data)
	{
		$company_name = $data['company_name'];
		$ta_company_address = $data['ta_company_address'];
		$poc_name = $data['poc_name'];
		$poc_email = $data['poc_email'];
		$poc_phone_number = $data['poc_phone_number'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$filter = " where CompanyName = '$company_name' AND IsActive = 1";
		if($this->check_unique_identity_filter($this->conn, 'company', $filter))
		{
			$sql = "INSERT INTO `company`(`CompanyName`, `CompanyAddress`, `POCName`, `POCEmail`, `POCContact`, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$company_name','$ta_company_address','$poc_name','$poc_email','$poc_phone_number','$CreatedDate','$CreatedTime','$CreatedBy')";
			//echo $sql;
			$response = $this->_InsertTableRecords($this->conn,$sql);
			//$response['error'] = false;
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "Company with same name is already created";
		}
		return $response;
	}
	public function UpdateCompanyDetails($data)
	{
		extract($data);
		$update_sql = " CompanyName = '$company_name',CompanyAddress = '$ta_company_address',POCName = '$poc_name',POCEmail='$poc_email',POCContact='$poc_phone_number' where ID = $form_id";
		$response = $this->_UpdateTableRecords($this->conn,'company',$update_sql);
		return $response;
	}
	public function DeleteCompany($data)
	{
		extract($data);
		$update_sql = " IsActive = 0 where ID = $CompanyID";
		$response = $this->_UpdateTableRecords($this->conn,'company',$update_sql);
		return $response;
	}
	public function InsertCompanySite($data)
	{
		$CompanyID = $data['s_company'];
		$ZoneID = $data['s_zoneid'];
		$SiteName = $data['company_site_name'];
		$SiteAddress = $data['ta_company_site_address'];
		$SitePOCName = $data['site_poc_name'];
		$SitePOCEmail = $data['site_poc_email'];
		$SitePOCContact = $data['site_poc_contact'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$filter = " where SiteName = '$SiteName' AND CompanyID = $CompanyID AND IsActive = 1";
		if($this->check_unique_identity_filter($this->conn, 'company_sites', $filter))
		{
			$sql = "INSERT INTO `company_sites`(`CompanyID`,`ZoneID`, `SiteName`, `SiteAddress`, `SitePOCName`,`SitePOCEmail`,`SitePOCContact`, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ($CompanyID,'$ZoneID','$SiteName','$SiteAddress','$SitePOCName','$SitePOCEmail','$SitePOCContact','$CreatedDate','$CreatedTime','$CreatedBy')";
			$response = $this->_InsertTableRecords($this->conn,$sql);
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "Company Site with same name in the company is already created";
		}
		return $response;
	}
	public function UpdateCompanySiteDetails($data)
	{
		extract($data);
		$update_sql = " SiteName = '$company_site_name',SiteAddress = '$ta_company_site_address',SitePOCName = '$site_poc_name',SitePOCEmail='$site_poc_email',SitePOCContact='$site_poc_contact',ZoneID = '$s_zoneid' where ID = $form_id";
		$response = $this->_UpdateTableRecords($this->conn,'company_sites',$update_sql);
		// TBD Updated All the reports
		return $response;
	}
	public function DeleteCompanySite($data)
	{
		extract($data);
		$update_sql = " IsActive = 0 where ID = $CompanySiteID";
		$response = $this->_UpdateTableRecords($this->conn,'company_sites',$update_sql);
		return $response;
	}
	public function GetCompanySiteDetails($data)
	{
		$CompanySiteID = $data['CompanySiteID'];
		// Delete company
		$where = " where ID = $CompanySiteID";
		$company_site_details = $this->_getTableDetails($this->conn,"company_sites",$where);
		return $company_site_details;
	}

	public function GetCompanySiteDetailsByCompanyID($CompanyID)
	{
		$CompanySiteID = $data['CompanySiteID'];
		$where = " where ID = $CompanySiteID";
		$company_site_details = $this->_getTableDetails($this->conn,"company_sites",$where);
		return $company_site_details;
	}
}