<?php 
class Organization extends Core
{
	private $conn;
	public function __construct($conn)
	{
		$this->conn = $conn;
		$this->setTimeZone();
	}

	function InsertOrganizationForm($data)
	{
		$organizationname = $data['organizationname'];
		$address = $data['address'];
		$poc = $data['poc'];
		$email = $data['email'];
		$phonenumber = $data['phonenumber'];
		$password = $data['password'];
		$gstno = $data['gstno'];
		$logo = "";

		if (isset($_FILES['logo']['name'])  && $_FILES['logo']['name'] != '')
	    {
	        $extn_pan = explode('.', $_FILES["logo"]["name"]);
	        $logo   = $organizationname."logo.".$extn_pan[1];
	        $path = "../../project-assets/document/organization/".$logo;
	        move_uploaded_file($_FILES["logo"]["tmp_name"], $path);
	    }

		$CreatedDate = date('Y-m-d');
		$CreatedBy = $data['CreatedBy'];
		$CreatedTime = date('H:i:s');


		$sql = "INSERT INTO organization(OrganizationName,Address,POC,Email,PhoneNumber,GSTNo,Logo,CreatedDate,CreatedTime,CreatedBy) VALUES ('$organizationname','$address','$poc','$email','$phonenumber','$gstno','$logo','$CreatedDate','$CreatedTime','$CreatedBy')";
		$response_insert_organization_details = $this->_InsertTableRecords($this->conn,$sql);
		
		if($response_insert_organization_details['error'] == false)
		{
			$last_insert_id = $response_insert_organization_details['last_insert_id'];
			$password_md5 = md5($password);
			$sql = "INSERT INTO users(Email,Password,UserType,OrgID,CreatedDate,CreatedTime) VALUES ('$email','$password_md5','Client Admin',$last_insert_id,'$CreatedDate','$CreatedTime')";
			$response_insert_user = $this->_InsertTableRecords($this->conn,$sql);

        	$response_insert_organization_details['message'] = "Organization Added !";
		    $response_insert_organization_details['error'] = false;

		}else{
			$response_insert_organization_details['message'] = "Some Technical Error !";
		    $response_insert_organization_details['error'] = false;
		}
		return $response_insert_organization_details;
	}

	function UpdateOrganizationForm($data)
	{
		$organizationname = $data['organizationname'];
		$address = $data['address'];
		$poc = $data['poc'];
		$email = $data['email'];
		$phonenumber = $data['phonenumber'];
		$gstno = $data['gstno'];
		$organization_update_id = $data['form_id'];
		$subdomain = $data['subdomain'];
		$CreatedDate = date('Y-m-d');
		$CreatedBy = $data['CreatedBy'];
		$CreatedTime = date('H:i:s');


		 $sql_mu = "OrganizationName='$organizationname',Address='$address',POC='$poc',Email='$email',PhoneNumber='$phonenumber',GSTNo='$gstno',SubDomain='$subdomain',CreatedDate='$CreatedDate',CreatedBy='$CreatedBy',CreatedTime='$CreatedTime' WHERE ID='$organization_update_id'";
		$response_update_organization_details = $this->_UpdateTableRecords($this->conn,'organization',$sql_mu);
		
		if($response_update_organization_details['error'] == false){
        	$response_update_organization_details['message'] = "Organization Updated !";
		    $response_update_organization_details['error'] = false;
		}else{
			$response_update_organization_details['message'] = "Some Technical Error !";
		    $response_update_organization_details['error'] = false;
		}

		return $response_update_organization_details;
		

	}
	public function getAllOrganization()
	{
		$where = " where IsActive = 1 ORDER BY ID DESC";
        $Organization_details = $this->_getTableRecords($this->conn, "organization", $where);
        return $Organization_details;
	}

	public function getTotalOrganization($table)
	{
		$sql = "Select COUNT(*) as total_enquiries from $table where IsActive = 1";
		$result=mysqli_query($this->conn,$sql);
		if($result->num_rows>0)	
		{
			$row = $result->fetch_assoc();
			return $row['total_enquiries'];
		}
		else
		{
			return 0;
		}
	}

	public function GetOrganizationDetailsByID($ID)
	{
		$where = " where ID = $ID";
        $Organization_details = $this->_getTableDetails($this->conn, "organization", $where);
        return $Organization_details;
	}

    public function DeleteOrganization($data)
	{
		$OrganizationID = $data['ID'];
		$update_param = " IsActive = 0 where ID = $OrganizationID";
		// Making IsActive = 0 for Organization table
		$response = $this->_UpdateTableRecords($this->conn,"organization",$update_param);

		if($response['error'] == false)
		{
			$update_param = " IsActive = 0 where OrgID = $OrganizationID";
			// Making IsActive = 0 for users of the organization
			$response = $this->_UpdateTableRecords($this->conn,"users",$update_param);
		}
		if($response['error'] == false)
		{
			$update_param = " IsActive = 0 where OrgID = $OrganizationID";
			// Making IsActive = 0 for users of the organization
			$response = $this->_UpdateTableRecords($this->conn,"org_module_mapping",$update_param);
		}
		
		return $response;
	}
	public function AddOrgModules($data)
	{
		$response = array();
		$response['error'] = false;
		$CreatedDate = date("Y-m-d");
		$CreatedTime = date("H:i:s");
		$CreatedBy = $data['CreatedBy'];
		$OrgID = $data['organization_id'];
		$new_module_array = $data['new_module'];
		$new_subscription_type_array = $data['new_subscription_type'];
		$new_sub_startdate_array = $data['new_sub_startdate'];
		$new_sub_enddate_array = $data['new_sub_enddate'];
		$no_of_mapped_modules = sizeof($new_module_array);
		for($i=0;$i<$no_of_mapped_modules;$i++)
		{
			$module = $new_module_array[$i];
			$subscription_type = $new_subscription_type_array[$i];
			$subscription_start_date = $new_sub_startdate_array[$i];
			$subscription_end_date = $new_sub_enddate_array[$i];
			$insert_module_sql = "INSERT INTO org_module_mapping(OrgID,ModuleID,SubscriptionType,SubscriptionStartDate,SubscriptionEndDate,CreatedDate,CreatedTime,CreatedBy) VALUES ($OrgID,'$module','$subscription_type','$subscription_start_date','$subscription_end_date','$CreatedDate','$CreatedTime','$CreatedBy')";
			$response_insert = $this->_InsertTableRecords($this->conn,$insert_module_sql);
			if($response_insert['error'] == true)
			{
				$response['error'] = true;
				$response_message = $response_message."\n Error with Module with index ".$i;
			}
		}
		if($response['error'] == false)
		{
			$response['message'] = "Modules mapped to the organization";
		}
		else
		{
			$response['message'] = $response_message;
		}
		return $response;

	}
	public function UpdateModuleMapping($data)
	{
		$MappingID = $data['MappingID'];
		$SubscriptionType = $data['SubscriptionType'];
		$SubscriptionStartDate = $data['SubscriptionStartDate'];
		$SubscriptionEndDate = $data['SubscriptionEndDate'];
		$update_param = " SubscriptionType = '$SubscriptionType',SubscriptionStartDate='$SubscriptionStartDate',SubscriptionEndDate='$SubscriptionEndDate' where ID = $MappingID";
		return $this->_UpdateTableRecords($this->conn,'org_module_mapping',$update_param);
	}
	public function UpdateModuleDatabaseMapping($data)
	{
		$MappingID = $data['set_database_modal_mapping_id'];
		$db_name_global = $data['db_name_global'];
		$db_user_global = $data['db_user_global'];
		$db_password_global = $data['db_password_global'];
		$db_name_local = $data['db_name_local'];
		$db_user_local = $data['db_user_local'];
		$db_password_local = $data['db_password_local'];
		$update_param = "db_name_global='$db_name_global', db_user_global='$db_user_global', db_password_global='$db_password_global', db_name_local='$db_name_local', db_user_local='$db_user_local', db_password_local='$db_password_local' WHERE ID=$MappingID";
		return $this->_UpdateTableRecords($this->conn,'org_module_mapping',$update_param);

	}
}