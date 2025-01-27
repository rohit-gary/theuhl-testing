<?php
@session_start();
if (isset($_SESSION) && is_array($_SESSION)) {
  $sessionDataJson = json_encode($_SESSION);
} else {
  $sessionDataJson = json_encode([]);
}

?>

<head>
  <?php include("../includes/meta.php") ?>
  <?php include("../includes/links1.php") ?>
  <title>Our Most Popular Test</title>
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../project-assets/css/all_test.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style type="text/css">

  </style>
</head>
<?php include('../includes/header1.php'); ?>
<div class="dlab-bnr-inr overlay-black-middle bg-pt"
  style="background-image:url(../project-assets/images/banner/back-screen.png);">
  <div class="container">
    <div class="dlab-bnr-inr-entry">
      <h1 class="text-white">Checkout</h1>
      <!-- Breadcrumb row -->
      <div class="breadcrumb-row">
        <ul class="list-inline">
          <li><a href="index.html">Test</a></li>
          <li>Checkout</li>
        </ul>
      </div>
      <!-- Breadcrumb row END -->
    </div>
  </div>
</div>
<div class="section-full content-inner shop-account">
  <!-- Product -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="font-weight-700 m-t0 m-b40">CREATE AN ACCOUNT</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 m-b30">
        <div class="p-a30 border-1  max-w500 m-auto">
          <div class="tab-content">
            <form id="create_account_form" class="tab-pane active" method="POST" onsubmit="return false;">
              <h4 class="font-weight-700">PERSONAL INFORMATION</h4>
              <p class="font-weight-600">If you have an account with us, please log in.</p>
              <div class="form-group">
                <label class="font-weight-700">Name *</label>
                <input name="name" required class="form-control" placeholder="Name" type="text" id="name_new">
              </div>
              <div class="form-group">
                <label class="font-weight-700">Phone Number *</label>
                <input name="phone_number" required class="form-control" placeholder="Phone Number" type="text"
                  id="phone_number_new">
              </div>
              <div class="form-group">
                <label class="font-weight-700">Email *</label>
                <input name="email" required class="form-control" placeholder="Your Email Id" type="email"
                  id="email_new">
              </div>
              <div class="form-group">
                <label class="font-weight-700">Password *</label>
                <input name="password" required class="form-control" placeholder="Type Password" type="password"
                  id="password_new">
              </div>
              <div class="form-group">
                <label class="font-weight-700">Confirm Password *</label>
                <input name="confirm_password" required class="form-control" placeholder="Type Confirm Password"
                  type="password" id="confirm_password_new">
              </div>
              <div class="text-left m-t15">
                <button type="button" class="site-button button-lg radius-no outline outline-2"
                  id="create_account_button" onclick="createAccount()">CREATE</button>
                <button type="button" class="site-button button-lg radius-no outline outline-2"
                  id="login_account">LOGIN</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product END -->
</div>
<!-- Shop Service info -->

<!-- Shop Service info End -->
</div>


<?php include("../includes/footer1.php") ?>
<?php include("../includes/script1.php") ?>
</body>
<script>
  var sessionData = <?php echo $sessionDataJson; ?>;
  console.log(sessionData);
  function createAccount() {
    let name = $('#name_new').val().trim();
    let phone_number = $('#phone_number_new').val().trim();
    let email = $('#email_new').val().trim();
    let password = $('#password_new').val();
    let confirm_password = $('#confirm_password_new').val();

    // Empty fields validation
    if (name === '') {
      alert('Please enter your name');
      return false;
    }

    if (phone_number === '') {
      alert('Please enter your phone number');
      return false;
    }

    if (email === '') {
      alert('Please enter your email');
      return false;
    }

    if (password === '') {
      alert('Please enter your password');
      return false;
    }

    if (confirm_password === '') {
      alert('Please confirm your password');
      return false;
    }

    // Email validation
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
      alert('Please enter a valid email address');
      return false;
    }

    // Phone number validation - must be exactly 10 digits
    let phonePattern = /^\d{10}$/;
    if (!phonePattern.test(phone_number)) {
      alert('Please enter a valid 10-digit phone number');
      return false;
    }

    // Password match validation
    if (password !== confirm_password) {
      alert('Password and Confirm Password do not match');
      return false;
    }

    // Prepare form data
    let formData = $('#create_account_form').serialize();

    // AJAX request
    $.ajax({
      url: 'action/add-test-customer.php',
      type: 'POST',
      data: formData,
      success: function (response) {
        var response = JSON.parse(response);
        if (response.error == false) {
          alert(response.message);
          setTimeout(function () {
            updateCartUserid(response.user_id, sessionData);
            gotocheckoutnewuser(sessionData, response.user_id);
          }, 1000);
        } else {
          alert(response.message);
        }
      },
      error: function () {
        alert('An error occurred. Please try again.');
      }
    });

    return false; // Prevent default form submission
  }

  function gotocheckoutnewuser(sessionData, user_id) {
    alert('checkout');
    let cart_id = sessionData.cart_id;
    $.ajax({
      url: 'ajax/update_cart_checkout.php',
      method: 'GET',
      data: { cart_id: cart_id },
      success: function (response) {
        var response = JSON.parse(response);
        if (response.error == false) {
          window.location.href = `./checkout.php?user_id=${user_id}`;
        } else {
          alert(response.message);
        }
      }
    })
  }

  function updateCartUserid(user_id, sessionData) {
    alert('updateCartUserid');
    let cart_id = sessionData.cart_id;
    $.ajax({
      url: 'action/update-cart-user-id.php',
      type: 'POST',
      data: { UserID: user_id, CartID: cart_id }
    });
  }




</script>