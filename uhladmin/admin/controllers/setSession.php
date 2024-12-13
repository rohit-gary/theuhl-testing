<?php 
@session_start();

if(isset($_POST['CourseID']))
{
	$_SESSION['CourseID'] = $_POST['CourseID'];
}
?>