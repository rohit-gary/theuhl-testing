<?php 
	header('Access-Control-Allow-Origin: *');
	//header("Access-Control-Allow-Credentials: true");
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
	header('Content-Type: text/html; charset=utf-8');
	require_once('../../include/autoloader.inc.php');
	$data['email'] = strtolower($_POST['email']);
	$data['password'] = $_POST['password'];
	$dbh = new Dbh();
	$conn = $dbh->_connectodb();
	$authentication = new Authentication($conn);
	$organization = new Organization($conn);
	$core = new Core();
	$response = $authentication->login($data);
	if($response['error'] == false)
	{
		$data_login = $response['data'];
		$response['redirect'] = false;
		// If OrgID != -1
		// Get Module Mapping 
		// if Module mapped is 1 then find roles from router
		// store it
		// store redirect url
		if($data_login['OrgID'] != -1)
		{
			$where = " where OrgID = ".$data_login['OrgID'];
			$org_modules_count = $core->_getTotalRows($conn,'org_module_mapping',$where);
			$org_details = $organization->GetOrganizationDetailsByID($data_login['OrgID']);
			if($org_modules_count == 1)
			{
				$org_module_details = $core->_getTableDetails($conn,'org_module_mapping',$where);

				// Get Rederict Link
				$Module = $org_module_details['ModuleID'];
				// Get Module Folder
				$where = " where ID = $Module";
				$module_folder = $core->_getTableDetails($conn,'modules',$where)['FolderName'];
				if(strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)
				{
					$link = "../../".$module_folder;
				}
				else
				{
					if($org_details['SubDomain'] == "")
					{
						$link = "../../".$module_folder;
					}
					else
					{
						$link = $org_details['SubDomain'];
					}
				}
				$data_login['redirect_link'] = $link;

				// Get User Roles
				$router = new Router($org_module_details);
				$conn_client = $router->_connectodb();
				$roles = $router->Client_GetUserRole($data_login['UserID']);
				$data_login['roles'] = $roles;
				$response['redirect_link'] = $link;
				$response['redirect'] = true;
				$response['multi_modules'] = 0;
			}
			else
			{
				$link = "/dwd-organization";
				$response['multi_modules'] = 1;
				$response['redirect_link'] = $link;
				$response['redirect'] = true;
			}
		}

		$authentication->SessionStart($data_login);
		
	}
	echo json_encode($response);
?>