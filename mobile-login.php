<head>
  <?php include("./includes/meta.php") ?>
  <?php include("./includes/links1.php") ?>
  <title>Our Most Popular Test</title>
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../project-assets/css/all_test.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style type="text/css">

  </style>
</head>
<?php include('./includes/header1.php'); ?>
<div class="section-full content-inner shop-account bg-light">

  <!-- Product -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
      </div>
    </div>
    <div class="row dzseth">
      <div class="col-lg-6 col-md-6 m-b30 m-auto">
        <div class="p-a30 border-1 seth">
          <div class="tab-content nav">
            <form id="f_form-mobile_login" class="tab-pane active col-12 p-a0 " method="POST" onsubmit="return false;">
              <div class="form-group" style="display: block;"id="mobile_div"> 
                <label class="font-weight-700">Mobile Number *</label>
                <input class="form-control" placeholder="Your Mobile Number" type="text" name="PhoneNumber" id="l_mobile_number">
              </div>
              <div class="form-group" style="display: none;" id="otp_div">
                <label class="font-weight-700">OTP *</label>
                <input class="form-control " placeholder="Type OTP" type="text" name="OTP"
                  id="l_otp">
              </div>
              <div class="text-left">
                <button class="site-button m-r5 button-lg radius-no" onclick="sendGenerateOTP();" style="display: block;" id="otp_btn">Send Otp</button>
                 <button class="site-button m-r5 button-lg radius-no" onclick="login();" style="display: none;" id="login_btn">Login</button>
                 <a class="mt-4" href="./login" style="display: block;" id="login_btn">Login Via Email & Password</a>
              </div>
            </form>
            <form id="forgot-password" class="tab-pane fade  col-12 p-a0">
              <h4 class="font-weight-700">FORGET PASSWORD ?</h4>
              <p class="font-weight-600">We will send you an email to reset your password. </p>
              <div class="form-group">
                <label class="font-weight-700">E-MAIL *</label>
                <input name="dzName" required="" class="form-control" placeholder="Your Email Id" type="email">
              </div>
              <div class="text-left">
                <a class="site-button outline gray button-lg radius-no" data-bs-toggle="tab" href="#login">Back</a>
                <button class="site-button pull-right button-lg radius-no">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product END -->
</div>
<?php include("./includes/footer1.php") ?>
<?php include("./includes/script1.php") ?>
<script type="text/javascript" src="project-assets/js/login.js"></script>

<script type="text/javascript">
  
function sendGenerateOTP() {
    let MobileNumber = $('#l_mobile_number').val();
    let mobile_div = document.getElementById('mobile_div');
    let otp_div = document.getElementById('otp_div');
    let login_btn = document.getElementById('login_btn');
    let otp_btn = document.getElementById('otp_btn');

    if (MobileNumber == '') {
        alert('Enter Your Mobile Number');
        return;
    }
    
    $.ajax({
        url: "action/add-update-otp.php",
        method: "POST",
        data: {
            MobileNumber: MobileNumber
        },
        success: function (data) {
            let response = JSON.parse(data);
            alert(response.message);
            if (response.error == false) {  // Corrected condition
                otp_div.style.display = "block";
                mobile_div.style.display = "none";
                login_btn.style.display = "block";
                otp_btn.style.display = "none";
            }
        }
    });
}

function login(){

  var formData = $('#f_form-mobile_login').serialize();
   $.ajax({
        url: "uhladmin/admin/authentication/action/mobile-login-action.php",
        method: "POST",
        data: formData,
        success: function (data) {
            let response = JSON.parse(data);
            if (response.error == false) { 
              window.location.href = "./index";
            }
        }
    });


}


</script>