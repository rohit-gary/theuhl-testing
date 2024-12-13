<?php
	require_once('../include/autoloader.inc.php');
	$dbh = new Dbh();
	$conn = $dbh->_connectodb();
	$core = new Core();
	$utility = new Utility($conn);
	$where = " where 1";
	$courses_array_temp = $core->_getTableRecords($conn,'courses_for_display',$where);
	$courses_array = array();
	foreach($courses_array_temp as $course)
	{
		$CourseID = $course['ID'];
		$courses_array[$CourseID] = $course['CourseName'];
	}
	$enquiry_data = $core->_getTableRecords($conn,'allcourse_form_payment',$where);	
	foreach($enquiry_data as $enquiry)
	{
		$utility->changeEnquiryTable($enquiry,$courses_array);
	}

?>	