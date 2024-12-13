<?php 
class Service extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}
	public function GetAllServices()
	{
		$where = " where IsActive = 1";
		$services_list = $this->_getTableRecords($this->conn,'services',$where);
		return $services_list;
	}

	public function GetAllDocCat()
{
    $where = " where IsActive = 1";
    $cat_list = $this->_getTableRecords($this->conn, 'conf_doctor_cat', $where);

    $base_url = "https://unitedhealthlumina.com/uhl-management/configuration/images/";

    
     foreach ($cat_list as $key => $cat) {
        if (!empty($cat['CatImage'])) {
            $cat_list[$key]['CatImage'] = $base_url . $cat['CatImage'];
        }
    }
    return $cat_list;
}


	public function GetServiceDetails($data)
	{
		$ServiceID = $data['ServiceID'];
		// Delete company
		$where = " where ID = $ServiceID";
		$service_details = $this->_getTableDetails($this->conn,"services",$where);
		return $service_details;
	}

	public function GetCatDetails($data)
	{
		$ID = $data['ID'];
		// Delete company
		$where = " where ID = $ID";
		$service_details = $this->_getTableDetails($this->conn,"conf_doctor_cat",$where);
		return $service_details;
	}
	public function setServicesArraybyID()
	{
		$sites_array = array();
		$services_list = $this->GetAllServices();
		foreach($services_list as $service)
		{
			extract($service);
			$sites_array[$ID]['ServiceName'] = $ServiceName;
		}
		return $sites_array;
	}
	public function InsertService($data)
	{
		$service_name = $data['service_name'];
		$CreatedDate = $data['CreatedDate'];
		$CreatedTime = $data['CreatedTime'];
		$CreatedBy = $data['CreatedBy'];
		$sql = "INSERT INTO `services`(`ServiceName`, `CreatedDate`, `CreatedTime`, `CreatedBy`) VALUES ('$service_name','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_details = $this->_InsertTableRecords($this->conn,$sql);
		return $response_insert_details;
	}


	
	public function UpdateServiceDetails($data)
	{
		extract($data);
		$update_sql = " ServiceName = '$service_name' where ID = $form_id";
		$response = $this->_UpdateTableRecords($this->conn,'services',$update_sql);
		return $response;
	}

	public function InsertDoctorCat($data)
{
   $cat_name = $data['cat_name'];
   $CatImage = $data['CatImage'];
   $CreatedDate = $data['CreatedDate'];
   $CreatedTime = $data['CreatedTime'];
   $CreatedBy = $data['CreatedBy'];

   $sql = "INSERT INTO `conf_doctor_cat`(`CategoryName`, `CatImage`, `CreatedDate`, `CreatedTime`, `CreatedBy`) 
           VALUES ('$cat_name','$CatImage','$CreatedDate','$CreatedTime','$CreatedBy')";
   $response_insert_details = $this->_InsertTableRecords($this->conn, $sql);
   return $response_insert_details;
}


	public function UpdateDoctorCatDetails($data)
{
   extract($data);
   $update_sql = "CategoryName = '$cat_name'";
   
   if (isset($CatImage) && !empty($CatImage)) {
      $update_sql .= ", CatImage = '$CatImage'";
   }

   $update_sql .= " WHERE ID = $form_doctorcat_id";
   $response = $this->_UpdateTableRecords($this->conn, 'conf_doctor_cat', $update_sql);
   return $response;
}





}

?>