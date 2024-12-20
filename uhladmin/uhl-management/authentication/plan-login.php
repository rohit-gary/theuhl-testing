<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <title>United Health Lumina</title>
    <?php
        include("../include/common-head.php");
    ?>

    <style>
    font {
        display: none;
    }
    </style>

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <div id="global-loader">
            <div class="d-flex align-items-center w-100 h-100">
                <div class="spinner2">
                    <div class="cube1"></div>
                    <div class="cube2"></div>
                </div>
            </div>

        </div>

        <!-- PAGE -->
        <div class="page">
            <div class="container">
                <!-- Theme-Layout -->

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 bg-white p-6">
                        <form class="login100-form validate-form" id="form-planlogin">
                            <div class="text-center login_logo">
                                <a href="./login"><img src="../project-assets/images/logo-green.png"
                                        class="header-brand-img" alt="" style="width:250px; margin-bottom:20px;"></a>
                            </div>
                            <span class="login100-form-title pb-5">
                                Login
                            </span>
                            <div class="wrap-input100 validate-input input-group pt-3">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" type="Text"
                                    placeholder="Enter Policy Number" name="plan_number" id="plan_number">
                            </div>
                            <div class="wrap-input100 validate-input input-group pt-5" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" type="password"
                                    placeholder="Enter Password" name="password" id="password">
                            </div>
                            <!--  <div class="text-end pt-4">
                                <p class="mb-0"><a href="forgot-password" class="text-primary ms-1">Forgot
                                        Password?</a></p>
                            </div> -->
                            <div class="container-login100-form-btn">
                                <a onclick="loginPlanHolder();" class="login100-form-btn btn-primary cursor-pointer">
                                    Login
                                </a>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-8 col-md-6 col-12 p-6" style="background:rgb(8,68,105);">
                        <div class="d-flex align-items-center">
                            <img src="../project-assets/images/Dr.jpg" class="w-100" alt="">

                        </div>

                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <?php
       include("../include/common-script.php");
    ?>
    <script src="../project-assets/js/planholderlogin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.4.0/jquery.min.js"
        integrity="sha512-e4WJV+b4BBNgVWODO1v6KU6xbZRf/9acSAWSc9B+q/OiSXt6Q3MPhxPOntoGGfA+zQPbnYjhXwWIuX4PPZCtzw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- SHOW PASSWORD JS -->
    <script src="../theme-assets/js/show-password.min.js"></script>
  
</body>

</html>