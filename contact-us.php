    <head>
    <?php include("includes/meta.php") ?>
    <?php include("includes/links1.php") ?>
    <title>Contact US</title>  
<link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
  <!-- header -->
  <?php include('includes/header1.php'); ?>

    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle " style="background-image:url(project-assets/images/banner/back-screen.png);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Contact US</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="./index">Home</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row dzseth">
                    <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
                        <div class="icon-bx-wraper bx-style-1 p-lr20 p-tb30 center seth radius-sm">
                            <div class="icon-lg text-primary m-b20"> <a href="javascript:void(0);" class="icon-cell"><i class="ti-location-pin"></i></a> </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte text-uppercase">Address</h5>
                                <p>B403 FLOOR 4, NA TOWER NX ONE COMMERCIAL
                                SECTOR 1, GAUTAM BUDH NAGAR, UTTAR PRADESH, INDIA 201306</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
                        <div class="icon-bx-wraper bx-style-1 p-lr20 p-tb30 center seth radius-sm">
                            <div class="icon-lg text-primary m-b20"> <a href="javascript:void(0);" class="icon-cell"><i class="ti-email"></i></a> </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte text-uppercase">Email</h5>
                                <p><a href="mailto:info@unitedhealthlumina.com">info@unitedhealthlumina.com</a> <br> <a href="mailto:contact@unitedhealthlumina.com">contact@unitedhealthlumina.com</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
                        <div class="icon-bx-wraper bx-style-1 p-lr20 p-tb30 center seth radius-sm">
                            <div class="icon-lg text-primary m-b20"> <a href="javascript:void(0);" class="icon-cell"><i class="ti-mobile"></i></a> </div>
                            <div class="icon-content">
                                <h5 class="dlab-tilte text-uppercase">Phone</h5>
                                <p><a href="tel:1206053551">+911206053551</a></p>
                                <p><a href="tel:8860055057">+91 88 600 55 057</a></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-lg-6 m-b30">
                        <div class="p-a30 bg-gray clearfix radius-sm">
                            <h3>Send Message Us</h3>
                            <div class="dzFormMsg"></div>
                            <form method="post" class="dzForm" action="script/contact.php">
                                <input type="hidden" value="Contact" name="dzToDo" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="dzName" type="text" required class="form-control" placeholder="Your Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group"> 
                                                <input name="dzEmail" type="email" class="form-control" required  placeholder="Your Email Id" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="dzOther[Phone]" type="text" required class="form-control dz-number" placeholder="Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="dzOther[Subject]" type="text" required class="form-control" placeholder="Subject">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="dzMessage" rows="4" class="form-control" required placeholder="Your Message..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="g-recaptcha" data-sitekey="<!-- Put reCaptcha Site Key -->" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                                <input class="form-control d-none" style="display:none;" data-recaptcha="true" required data-error="Please complete the Captcha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button name="submit" type="submit" value="Submit" class="site-button "> <span>Submit</span> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Left part END -->
                    <!-- right part start -->
                    <div class="col-lg-6 m-b30 d-flex">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.9522092902703!2d77.42969467495561!3d28.60121048550333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cee57ca9e1ca5%3A0xdc324bf9fd262212!2sNX-ONE!5e0!3m2!1sen!2sin!4v1731321953362!5m2!1sen!2sin" class="align-self-stretch radius-sm" style="border:0; width:100%;  min-height:100%;" allowfullscreen></iframe>

                           
                    </div>

                    
                    <!-- right part END -->
                </div>
            </div>
        </div>
        <!-- contact area  END -->
    </div>
    </div>

</div>
 <?php include("includes/footer1.php") ?>
    <?php include("includes/script1.php") ?>
    <script type="text/javascript" src="project-assets/js/common-test.js"></script>
</body>
