<?php
 function sendWelcomeEmail($postdata)
{
	$url="https://unitedhealthlumina.com/uhl-management/mail/send-welcome-mail-api.php";
    $postdata = json_encode($postdata);
       
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_USERAGENT, 'api');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
     
    $response = curl_exec($ch);
    

    curl_close($ch);
    

    
}


?>