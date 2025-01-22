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
            <form id="f_form-login" class="tab-pane active col-12 p-a0 " method="POST" onsubmit="return false;">
              <h4 class="font-weight-700">LOGIN</h4>
              <p class="font-weight-600">If you have an account with us, please log in.</p>
              <div class="form-group">
                <label class="font-weight-700">E-MAIL *</label>
                <input class="form-control" placeholder="Your Email Id" type="email" name="email" id="f_email">
              </div>
              <div class="form-group">
                <label class="font-weight-700">PASSWORD *</label>
                <input class="form-control " placeholder="Type Password" type="password" name="password"
                  id="f_password">
              </div>
              <div class="text-left">
                <button class="site-button m-r5 button-lg radius-no" onclick="login();">login</button>
                <a data-bs-toggle=" tab" href="#forgot-password" class="m-l5"><i class="fas fa-unlock-alt"></i> Forgot
                  Password</a>
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