<?php 

$html='';
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
  $hash=hash('sha512', $key.'|'.$_POST['txnid'].'|'.$_POST['amount'].'|'.$_POST['productinfo'].'|'.$_POST['firstname'].'|'.$_POST['email'].'|'.$_POST['udf1'].'|'.$_POST['udf2'].'|||'.$_POST['udf5'].'||||||'.$salt);
    
  $_SESSION['salt'] = $salt; //save salt in session to use during Hash validation in response
  
  $html = '<form action="'.$action.'" id="payment_form_submit" method="post">
      <input type="hidden" id="udf5" name="udf5" value="'.$_POST['udf5'].'" />
       <input type="hidden" id="udf1" name="udf1" value="'.$_POST['udf1'].'" />
       <input type="hidden" id="udf1" name="udf2" value="'.$_POST['udf2'].'" />
      <input type="hidden" id="surl" name="surl" value="'.$success_url.'" />
      <input type="hidden" id="furl" name="furl" value="'.$failed_url.'" />
      <input type="hidden" id="curl" name="curl" value="'.$cancelled_url.'" />
      <input type="hidden" id="key" name="key" value="'.$key.'" />
      <input type="hidden" id="txnid" name="txnid" value="'.$_POST['txnid'].'" />
      <input type="hidden" id="amount" name="amount" value="'.$_POST['amount'].'" />
      <input type="hidden" id="productinfo" name="productinfo" value="'.$_POST['productinfo'].'" />
      <input type="hidden" id="firstname" name="firstname" value="'.$_POST['firstname'].'" />
      <input type="hidden" id="email" name="email" value="'.$_POST['email'].'" />
      <input type="hidden" id="phone" name="phone" value="'.$_POST['phone'].'" />
      <input type="hidden" id="address1" name="address1" value="'.$_POST['address1'].'" />
      <input type="hidden" id="address2" name="address2" value="'.(isset($_POST['address2'])? $_POST['address2'] : '').'" />
      <input type="hidden" id="city" name="city" value="'.$_POST['city'].'" />
      <input type="hidden" id="state" name="state" value="'.$_POST['state'].'" />
      <input type="hidden" id="country" name="country" value="'.$_POST['country'].'" />
      <input type="hidden" id="Pg" name="Pg" value="'.$_POST['Pg'].'" />
      <input type="hidden" id="hash" name="hash" value="'.$hash.'" />
      </form>
      <script type="text/javascript"><!--
        document.getElementById("payment_form_submit").submit();  
      //-->
      </script>';
}
function getCallbackUrl()
{
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $uri = str_replace('/index.php','/',$_SERVER['REQUEST_URI']);
  return $protocol . $_SERVER['HTTP_HOST'] . $uri . 'response.php';
}
?>