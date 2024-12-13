<?php 
class Navigation extends Core
{
	public $_Nav_Dashboard;
	public $_Nav_Enquiries;
	public $_Nav_Admissions_Manage;
	public $_Nav_PaymentLink;
	public $_Nav_Users;
	public $_Nav_Company;
	public $_Nav_Test;
	public $_Nav_All_Transaction;
	public $_Nav_Website_Admissions;
	public $_Nav_Dashboard_Lead;
	public $_Nav_Dashboard_Counsellor_Lead;
	public $_Nav_Admissions;
	public $_Nav_Admissions_form;
	public $_Nav_courses;
	public $_Nav_Resources;
	public $_Nav_Enrolled_Student;
	public $_Nav_Company_details;
	public $_Nav_Test_Result;
	public $_Nav_Dashboard_Content_team;
	public $_Nav_Dashboard_Book_Dispatch;
	public $_Nav_Book_Dispatch;
	public $_Nav_Educator;
	public $_Nav_Dashboard_Educator;
	public $_Nav_Invoice_no;
	public $_Nav_Website_Manage;
	public function __construct()
	{
		$_Nav_Dashboard = false;
		$_Nav_Enquiries = false;
		$_Nav_Admissions_Manage = false;
		$_Nav_PaymentLink = false;
		$_Nav_Users = false;
		$_Nav_Company = false;
		$_Nav_Admissions = false;
		$_Nav_All_Transaction = false;
		$_Nav_Website_Admissions = false;
		$_Nav_Dashboard_Lead = false;
		$_Nav_Dashboard_Counsellor_Lead = false;
		$_Nav_Admissions_form = false;
		$_Nav_courses = false;
		$_Nav_Resources = false;
		$_Nav_Enrolled_Student = false;
		$_Nav_Company_details = false;
		$_Nav_Test_Result = false;
		$_Nav_Dashboard_Content_team = false;
		$_Nav_Dashboard_Book_Dispatch = false;
		$_Nav_Book_Dispatch = false;
		$_Nav_Educator = false;
		$_Nav_Dashboard_Educator = false;
		$_Nav_Test = false;
		$_Nav_Invoice_no = false;
		$_Nav_Website_Manage = false;
	}
	public function setNavigation($role)
	{
		$json = file_get_contents('../navigation/roles_navigation.json');
		$nav_array = json_decode($json);
		$nav_array = get_object_vars($nav_array);
		//foreach($EmployeeRoles as $role)
		{
			
			$temp_nav_array = $nav_array[$role];
			//print_r($temp_nav_array);
			if(in_array("_Nav_Dashboard",$temp_nav_array))
				$this->_Nav_Dashboard = true;
			if(in_array("_Nav_Enquiries",$temp_nav_array))
				$this->_Nav_Enquiries = true;
			if(in_array("_Nav_Admissions_Manage",$temp_nav_array))
				$this->_Nav_Admissions_Manage = true;
			if(in_array("_Nav_PaymentLink",$temp_nav_array))
				$this->_Nav_PaymentLink = true;
			if(in_array("_Nav_Users",$temp_nav_array))
				$this->_Nav_Users = true;
			if(in_array("_Nav_Company",$temp_nav_array))
				$this->_Nav_Company = true;
			if(in_array("_Nav_Admissions",$temp_nav_array))
				$this->_Nav_Admissions = true;
			if(in_array("_Nav_All_Transaction",$temp_nav_array))
				$this->_Nav_All_Transaction = true;
			if(in_array("_Nav_Website_Admissions",$temp_nav_array))
				$this->_Nav_Website_Admissions = true;
			if(in_array("_Nav_Dashboard_Lead",$temp_nav_array))
				$this->_Nav_Dashboard_Lead = true;
			if(in_array("_Nav_Dashboard_Counsellor_Lead",$temp_nav_array))
				$this->_Nav_Dashboard_Counsellor_Lead = true;
			if(in_array("_Nav_Admissions_form",$temp_nav_array))
				$this->_Nav_Admissions_form = true;
			if(in_array("_Nav_courses",$temp_nav_array))
				$this->_Nav_courses = true;
			if(in_array("_Nav_Enrolled_Student",$temp_nav_array))
				$this->_Nav_Enrolled_Student = true;
			if(in_array("_Nav_Resources",$temp_nav_array))
				$this->_Nav_Resources = true;
			if(in_array("_Nav_Company_details",$temp_nav_array))
				$this->_Nav_Company_details = true;
			if(in_array("_Nav_Test_Result",$temp_nav_array))
				$this->_Nav_Test_Result = true;
			if(in_array("_Nav_Dashboard_Content_team",$temp_nav_array))
				$this->_Nav_Dashboard_Content_team = true;
			if(in_array("_Nav_Dashboard_Book_Dispatch",$temp_nav_array))
				$this->_Nav_Dashboard_Book_Dispatch = true;
			if(in_array("_Nav_Book_Dispatch",$temp_nav_array))
				$this->_Nav_Book_Dispatch = true;
			if(in_array("_Nav_Educator",$temp_nav_array))
				$this->_Nav_Educator = true;
			if(in_array("_Nav_Dashboard_Educator",$temp_nav_array))
				$this->_Nav_Dashboard_Educator = true;
			if(in_array("_Nav_Test",$temp_nav_array))
				$this->_Nav_Test = true;
			if(in_array("_Nav_Invoice_no",$temp_nav_array))
				$this->_Nav_Invoice_no = true;
			if(in_array("_Nav_Website_Manage",$temp_nav_array))
				$this->_Nav_Website_Manage = true;

		}
	}

}
?>