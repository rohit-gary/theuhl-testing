<?php
require_once('common_api_header.php');
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('../include/autoloader.inc.php');
$conf = new Configuration();
$secret_key = $conf->getJWTKey();
$data_raw = file_get_contents('php://input');
$logs = new Logs();
$logs->SetCurrentAPILogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$data = json_decode($data_raw,true);
if(isset($data['token']))
{
	$jwt = $data['token'];
	$token_decoded = JWT::decode($jwt,new Key($secret_key, 'HS512'));
	$user_id = $token_decoded->data->user_id;
	$username = $token_decoded->data->username;
}
