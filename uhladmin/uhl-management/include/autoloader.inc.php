<?php
spl_autoload_register('myAutoLoader');
function myAutoLoader($className){

	$currentDir = __DIR__;

	 $extension = ".class.php";

  $className = strtolower($className);

	$path = "../../classes/";
	$extension = ".class.php";
	$className = strtolower($className);
	$fullPath = $path.$className.$extension;
	$file_name = $className.$extension;
	$path1 = "../classes/".$file_name;
	$path2 = "../../admin/classes/".$file_name;
	$path3 = "../admin/classes/".$file_name;
	$path4 = "../../../admin/classes/".$file_name;
	$path5 = "../../classes/".$file_name;
	$path6 = "uhladmin/admin/classes/".$file_name;
	$path7 = "uhladmin/uhl-management/classes/".$file_name;
	$path8 = "../uhladmin/uhl-management/classes/".$file_name;
	$path9 = "../uhladmin/admin/classes/".$file_name;
	if(file_exists($fullPath))
	{
		include_once $fullPath;
	}
	else if(file_exists($path1))
	{
		// echo "1".$path1."<br>";
		include_once $path1;
	}
	else if(file_exists($path2)) 
	{
		// echo "2".$path2."<br>";
		include_once $path2;
	}
	else if(file_exists($path3)) 
	{
		// echo "3".$path3."<br>";
		include_once $path3;
	}
	else if(file_exists($path4)) 
	{
		// echo "4".$path4."<br>";
		include_once $path4;
	}

	else if(file_exists($path5)) 
	{
		// echo "5".$path5."<br>";
		include_once $path5;
	}
	else if(file_exists($path6))
	{
        include_once $path6;
	}
	else if(file_exists($path7))
	{
        include_once $path7;
	}
	else if(file_exists($path8))
	{
        include_once $path8;
	}
	else if(file_exists($path9))
	{
        include_once $path9;
	}
	else{

	}
	if(!(file_exists($fullPath))){
		return false;
	}
}
?>