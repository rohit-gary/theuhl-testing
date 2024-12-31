<?php 
class Navigation extends Core
{
	public $_Nav_Users;
	public $_Nav_Company;
	public $_Nav_Company_Sites;
	public $_Nav_Service_Reports;
	public $_Nav_Dashboard;
	public $_Nav_Configuration;
	public $_Nav_Services;
	public $_Nav_faqs;
	public $_Nav_Plan;
	public $_Nav_Channel_Partner;
	public $_Nav_Customer;
	public $_Nav_Document;
	public $_Nav_Reimbursement;
	public $_Nav_Dashboard_Customer;
	public $_Nav_Account;
	public $_Nav_Neft;
	public $_Nav_DocTest;
	public function __construct()
	{
		$_Nav_Users = false;
		$_Nav_Company = false;
		$_Nav_Company_Sites = false;
		$_Nav_Service_Reports = false;
		$_Nav_Dashboard = false;
		$_Nav_Configuration = false;
		$_Nav_Services = false;
		$_Nav_faqs=false;
		$_Nav_Plan=false;
	    $_Nav_Channel_Partner=false;
        $_Nav_Customer=false;
		$_Nav_Document=false;
        $_Nav_Reimbursement=false;
		$_Nav_Dashboard_Customer=false;
		$_Nav_Account=false;
		$_Nav_Neft=false;
		$_Nav_DocTest=false;
	}
	public function setNavigation($role_array)
	{
		$json = file_get_contents('../navigation/roles_navigation.json');
		$nav_array = json_decode($json);
		$nav_array = get_object_vars($nav_array);
		foreach($role_array as $i_role)
		{
			$Role = $i_role['Role'];
			$temp_nav_array = $nav_array[$Role];
			//print_r($temp_nav_array);
			if(in_array("_Nav_Users",$temp_nav_array))
				$this->_Nav_Users = true;
			if(in_array("_Nav_Company",$temp_nav_array))
				$this->_Nav_Company = true;
			if(in_array("_Nav_Company_Sites",$temp_nav_array))
				$this->_Nav_Company_Sites = true;
			if(in_array("_Nav_Service_Reports",$temp_nav_array))
				$this->_Nav_Service_Reports = true;
			if(in_array("_Nav_Services",$temp_nav_array))
				$this->_Nav_Services = true;
			if(in_array("_Nav_Dashboard",$temp_nav_array))
				$this->_Nav_Dashboard = true;
			if(in_array("_Nav_Configuration",$temp_nav_array))
				$this->_Nav_Configuration = true;
			if(in_array("_Nav_Bill",$temp_nav_array))
				$this->_Nav_Bill = true;
			if(in_array("_Nav_faqs",$temp_nav_array))
				$this->_Nav_faqs=true;

			if(in_array("_Nav_Plan",$temp_nav_array))
				$this->_Nav_Plan=true;

			if(in_array("_Nav_Channel_Partner",$temp_nav_array))
				$this->_Nav_Channel_Partner=true;

			if(in_array("_Nav_Customer",$temp_nav_array))
				$this->_Nav_Customer=true;

				if(in_array("_Nav_Document",$temp_nav_array))
				$this->_Nav_Document=true;

			if(in_array("_Nav_Reimbursement",$temp_nav_array))
				$this->_Nav_Reimbursement=true;

					
			if(in_array("_Nav_Dashboard_Customer",$temp_nav_array))
			$this->_Nav_Dashboard_Customer=true;

			if(in_array("_Nav_Account",$temp_nav_array))
				$this->_Nav_Account=true;

			if(in_array("_Nav_Neft",$temp_nav_array))
				$this->_Nav_Neft=true;
			if(in_array("_Nav_DocTest",$temp_nav_array))
				$this->_Nav_DocTest=true;

		}
	}

}
?>