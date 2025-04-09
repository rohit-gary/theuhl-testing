<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('./uhladmin/uhl-management/include/autoloader.inc.php');
include("./uhladmin/uhl-management/include/db-connection.php");
$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$test_obj = new Test($conn);
$all_test = $test_obj->GetAllTestName();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/meta.php") ?>
    <?php include("includes/links1.php") ?>
    <title>United Health Lumina New health plan for new Times</title>
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./project-assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="./project-assets/css/all_test.css">
</head>
<style>
.single-person-image,
.family-image,
.full-family-image {
    position: relative;
    padding: 30px;
    border-radius: 0 !important;
    color: #fff;
    min-height: 320px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
    z-index: 1;
    cursor: pointer;
}

.single-person-image:hover,
.family-image:hover,
.full-family-image:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgb(0 0 0 / 58%) !important;
}

.single-person-image::before,
.family-image::before,
.full-family-image::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 0;
}

.single-person-image>*,
.family-image>*,
.full-family-image>* {
    position: relative;
    z-index: 1;
}

.single-person-image h3,
.family-image h3,
.full-family-image h3 {
    font-weight: 700;
    color: #eceef1;
    font-size: 1.8rem;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
    /* strong readability */
}

.single-person-image p,
.family-image p,
.full-family-image p,
.single-person-image li,
.family-image li,
.full-family-image li {
    font-size: 1rem;
    color: #f8f8f8;
    line-height: 1.6;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
}

.card-text ul li {
    font-weight: 600;
    line-height: 2.2;
}


.single-person-image {
    background-image: url('https://www.unitedhealthlumina.com/uhladmin/uhl-management/project-assets/plan/REGULAR%20MAGNIT%202.02870_item.jpg');
}

.family-image,
.full-family-image {
    background-image: url('https://www.unitedhealthlumina.com/uhladmin/uhl-management/project-assets/plan/REGULAR%20FAMILY%20FLOATER%203.09225_item.jpg');
}

table td,
table th {
    padding-top: 1.5rem !important;
    padding-bottom: 1.5rem !important;
}

.health-container {
    padding: 1rem;
    color: grey;
    max-width: 100%;
}

.health-container h2 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
}

.health-container p {
    font-size: 1.1rem;
    line-height: 1.7;
}
</style>

<body id="bg">

    <div class="page-wraper" style="background:#fff">
        <div id="loading-area"></div>
        <!-- header -->
        <?php include('includes/header1.php'); ?>
        <!-- Content -->


    </div>

    <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle "
        style="background-image:url(project-assets/images/banner/back-screen.png);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">UHL Membership</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="#">Home</a></li>
                        <li>UHL Membership</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>

    <div class="section-full content-inner" style="background: #e3f0f7;">
        <div class="container">
            <div class="section-content">
                <div class="row d-flex">
                    <div class="col-lg-7 col-md-12 m-b30 align-self-center video-infobx">
                        <div class="content-bx1">
                            <h2 class="m-b15 title">UNTED HEALTH LUNINA <br> <span class="text-primary"> IS YOUR IDEAL
                                    FINACIAL </span></h2>

                            <p class="m-b30" style="font-weight: 600;">Protection against
                                healthcare expenses (OPP. Consultation & Diagnos).
                                that Can vive out of unexpected medical treatement. <br>It is a Comprehensive Preimany
                                healthomere plan that Provides Complete Protection against a wide eange of Perinary
                                medical expenses.</p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 m-b30">
                        <div class="video-bx">
                            <img src="project-assets/images/about-us-2.jpg" alt="Signature">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel Section -->
    <section class="custom-hero-carousel d-none">
        <div id="healthCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <!-- Main Banner -->
                <div class="carousel-item active custom-carousel-item">
                    <div class="custom-carousel-overlay"></div>
                    <!-- Desktop & Large Tablet Banner -->
                    <img src="project-assets/images/banner/nb-2101.png" class="d-none d-xl-block w-100"
                        alt="Health Care Banner">
                    <!-- Mobile & iPad Banner -->
                    <img src="project-assets/images/banner/nbm-2101.png" class="d-block d-xl-none w-100"
                        alt="Health Care Banner">
                    <div class="carousel-caption custom-carousel-caption">
                        <div class="custom-caption-content d-none">
                            <div class="custom-highlight-box">
                                <h2 class="custom-hindi-slogan"><b>बीमारी का डर छोड़ो, UHL से नाता जोड़ो।</b></h2>
                                <h3 class="custom-company-name">United Health Lumina Plans</h3>
                            </div>
                            <div class="custom-feature-badges">
                                <span><i class="fas fa-star"></i> Trusted Healthcare</span>
                                <span><i class="fas fa-shield-alt"></i> Complete Coverage</span>
                                <span><i class="fas fa-clock"></i> 24/7 Support</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health Plans Slide -->
                <div class="carousel-item custom-carousel-item">
                    <div class="custom-carousel-overlay"></div>
                    <!-- Desktop & Large Tablet Banner -->
                    <img src="project-assets/images/banner/nb2-2502.png" class="d-none d-xl-block w-100"
                        alt="Health Care Banner">
                    <!-- Mobile & iPad Banner -->
                    <img src="project-assets/images/banner/nbm2-2502.png" class="d-block d-xl-none w-100"
                        alt="Health Care Banner">
                    <div class="carousel-caption custom-carousel-caption">
                        <div class="custom-caption-content d-none">
                            <div class="custom-highlight-box">
                                <h2 class="custom-hindi-slogan"><b>Comprehensive Health Plans</b></h2>
                            </div>
                            <div class="custom-feature-badges">
                                <span><i class="fas fa-hospital"></i> Cashless Hospitals</span>
                                <span><i class="fas fa-user-md"></i> Expert Doctors</span>
                                <span><i class="fas fa-ambulance"></i> Emergency Care</span>
                            </div>
                            <a href="./all-plans" class="custom-cta-button">Explore Plans</a>
                        </div>
                    </div>
                </div>

                <!-- Health Tests Slide -->
                <div class="carousel-item custom-carousel-item">
                    <div class="custom-carousel-overlay"></div>
                    <!-- Desktop & Large Tablet Banner -->
                    <img src="project-assets/images/banner/nb3-2502.png" class="d-none d-xl-block w-100"
                        alt="Health Care Banner">
                    <!-- Mobile & iPad Banner -->
                    <img src="project-assets/images/banner/nbm3-2502.png" class="d-block d-xl-none w-100"
                        alt="Health Care Banner">
                    <div class="carousel-caption custom-carousel-caption">
                        <div class="custom-caption-content">
                            <div class="custom-highlight-box d-none">
                                <h2 class="custom-hindi-slogan"><b>Advanced Health Tests</b></h2>
                            </div>
                            <div class="custom-feature-badges d-none">
                                <span><i class="fas fa-home"></i> Home Collection</span>
                                <span><i class="fas fa-flask"></i> Latest Equipment</span>
                                <span><i class="fas fa-file-medical-alt"></i> Quick Reports</span>
                            </div>
                            <a href="#" class="custom-cta-button">Book Test</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#healthCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon custom-nav"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#healthCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon custom-nav"></span>
            </button>
        </div>
    </section>
    <div class="container my-3" style="background-color: #fff; max-width: 722px;">
        <div class="tp-banner-container container">
            <div class="tp-banner">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"
                            style="background-color:#673AB7 "></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2" style="background-color:#673AB7 "></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3" style="background-color:#673AB7 "></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                            aria-label="Slide 4" style="background-color:#673AB7 "></button>
                    </div>

                    <!-- Carousel Inner -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <!-- Desktop Image -->
                            <img src="project-assets/images/banner/nb-2101.png" class="d-none d-md-block w-100"
                                alt="Slide-1">
                            <!-- Mobile Image -->
                            <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100"
                                alt="Mobile-Slide-1">
                        </div>
                        <div class="carousel-item">
                            <img src="project-assets/images/banner/nb2-2502.png" class="d-none d-md-block w-100"
                                alt="Slide-2">
                            <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100"
                                alt="Mobile-Slide-2">
                        </div>
                        <div class="carousel-item">
                            <img src="project-assets/images/banner/nb3-2502.png" class="d-none d-md-block w-100"
                                alt="Slide-3">
                            <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100"
                                alt="Mobile-Slide-3">
                        </div>
                        <div class="carousel-item">
                            <img src="project-assets/images/banner/nb-2101.png" class="d-none d-md-block w-100"
                                alt="Slide-4">
                            <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100"
                                alt="Mobile-Slide-4">
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Card Section -->
    <section class="section-full content-inner benefits-section"
        style="background: linear-gradient(135deg, #367eb7 0%, #196dad 100%); color: white;">
        <div class="container">
            <!-- <div class="text-center mb-5">
                <span class="subtitle text-primary">Why Choose Us</span>
                <h2 class="title" style="color: white;">Benefits of <span class="">Our Health Services</span></h2>
                <p class="section-description" style="color: white;">Comprehensive healthcare solutions designed for
                    your peace
                    of mind</p>
            </div> -->

            <div class="col-lg-12 ">
                <!-- Benefit Card 1 -->
                <div class="row ">
                    <div class="col-lg-6 col-md-6">
                        <div class="benefit-card single-person-image ">
                            <div class="benefit-content" style=" margin-top: 109px;">
                                <h3>PRIMARY HEALTH COVER FOR INDIVIDUALS
                                </h3>

                                <ul class="benefit-features">
                                    <li><i class="fas fa-check-circle"></i>Cousseage for unexpected PRI -moyenedical
                                        expenses</li>
                                    <li><i class="fas fa-check-circle"></i>Holistic Benefits - LINITED HEALTH CARE Plan
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <!-- Benefit Card 2 -->
                        <div class="benefit-card family-image ">

                            <div class="benefit-content" style=" margin-top: 109px;">
                                <h3>PRIMARY HEALTH CARE COVER FOR PAMILY</h3>

                                <ul class="benefit-features">
                                    <li><i class="fas fa-check-circle"></i> Peccinarey Coverage for entice family
                                    </li>
                                    <li><i class="fas fa-check-circle"></i> well-being and finacial Safety ensured</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="row ">
                    <div class="col-lg-3 ">
                    </div>
                    <div class="col-lg-6 ">
                        <!-- Benefit Card 3 -->
                        <div class="benefit-card full-family-image">

                            <div class="benefit-content" style=" margin-top: 109px;">
                                <h3>PRIMARY HEALTHCAR FOR SENIOR CITIZEN</h3>

                                <ul class="benefit-features">
                                    <li><i class="fas fa-check-circle"></i> well-being and finacial Safety ensureed
                                    </li>
                                    <li><i class="fas fa-check-circle"></i> Puimary Coverage for Per excating illness
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-full bg-gradient-light content-inner">
        <div class="health-services-section">
            <div class="container page-container">
                <div class="section-top-title">
                    <h2 class="title text-center">WHAT DOES A PRIMARY HEALTH PLAN MEAN <br> <span
                            class="text-primary">AND
                            HOW DOES IT WORK</span></h2>

                </div>

                <div class="row mt-5">
                    <!-- Left Side - Health Plans -->
                    <div class="col-lg-12 mb-4">
                        <div class="card-text">
                            <div class="row g-3">

                                <ul style=" list-style: none;">
                                    <li class="gaps">✔ UHL HEALTHCARE Doctar Creates a health Profile for u and designs
                                        Specialized Programs with in-house experts to address your health youwe health
                                        risks and wellness goals.</li>
                                    <li class="gaps">✔ Once yowe membership is ative, you will get a Standard
                                        Preventive
                                        health Check-ups and are available at a fee of up to Rs1500.</li>
                                    <li class="gaps">✔ Getting better begins When the problem is diagnosed at its root.
                                        You Can get any lab tests (X-Ray, Blood test, MRI, Etc) done at any medical
                                        facility Suggested by UHL Healthcare team.</li>
                                    <li class="gaps">✔ If the list Can be done at home, we will aveange for a lab
                                        Partnere
                                        to come to you.</li>
                                    <li class="gaps">✔ UHL Speciaties Suggested by the doctor or personal Consultation
                                        with your expest doctor are covered, all we say is that before embarking on Such
                                        a jouwerwey, you must talk to us.</li>
                                    <li class="gaps">✔ you Can get access to better healthear Senures from the comfort
                                        of
                                        your Couch (Sofa), you Coan get unlimited consultation from our in-house dodom
                                        and erepent nutritionists, psychologists, phyrusotherapists and others.</li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="container my-5">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th style="background-color: #4aa4d3 !important; color: white;"
                                        class="text-start fw-bold">Coverage Plan Variant</th>
                                    <th style="background-color: #4aa4d3 !important; color: white;"
                                        class="text-start fw-bold">UHL Secure Lite<br><small>(₹25,000)</small></th>
                                    <th style="background-color: #4aa4d3 !important; color: white;"
                                        class="text-start fw-bold">UHL Secure Plus<br><small>(₹50,000)</small></th>
                                    <th style="background-color: #4aa4d3 !important; color: white;"
                                        class="text-start fw-bold">UHL Secure Prime<br><small>(₹1,00,000)</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-start fw-bold">Promoted Healthcare</th>
                                    <td>24×7</td>
                                    <td>24×7</td>
                                    <td>24×7</td>
                                </tr>
                                <tr>
                                    <th class="text-start fw-bold">Cover for OPD</th>
                                    <td>2.5 LAKH A YEAR<br><small>(top-up plan, not main base)</small></td>
                                    <td>5 LAKH A YEAR<br><small>(top-up plan, not main base)</small></td>
                                    <td>10 LAKH A YEAR<br><small>(top-up plan, not main base)</small></td>
                                </tr>
                                <tr>
                                    <th class="text-start fw-bold">Claim Process</th>
                                    <td>Cashless / Reimbursement</td>
                                    <td>Cashless / Reimbursement</td>
                                    <td>Cashless / Reimbursement</td>
                                </tr>
                                <tr>
                                    <th class="text-start fw-bold">Age Limit</th>
                                    <td>1 to 65 years</td>
                                    <td>1 to 75 years</td>
                                    <td>1 to 75 years</td>
                                </tr>
                                <tr>
                                    <th class="text-start fw-bold">Service Ability</th>
                                    <td>Anywhere in India</td>
                                    <td>Anywhere in India</td>
                                    <td>Anywhere in India</td>
                                </tr>
                                <tr>
                                    <th class="text-start fw-bold">Online Consultation</th>
                                    <td>Unlimited</td>
                                    <td>Unlimited</td>
                                    <td>Unlimited</td>
                                </tr>
                                <tr>
                                    <th class="text-start fw-bold">Co-pay</th>
                                    <td>50%</td>
                                    <td>40%</td>
                                    <td>30%</td>
                                </tr>
                                <tr>
                                    <th class="text-start fw-bold">Subscription Membership</th>
                                    <td>1, 2 & 3 Year</td>
                                    <td>1, 2 & 3 Year</td>
                                    <td>1, 2, & 3 Year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section style="background: #e3f0f7;">
        <div class="container">
            <div class="health-container">
                <h2>Personalised Healthcare</h2>
                <p> <b>In Sickness and in Health Too!</b>
                    We also create your unique health profile and design professionally made programs
                    to improve your health and reduce your chances of hospitalisation.
                </p>
                <h2>COVER FOR OPD</h2>
                <p>
                    Cut unlimited Consultation with whe
                    doctore and access INC approved lab Consultation at eccomended facilities and doctori's practise
                </p>
            </div>
        </div>
    </section>
    <!-- Content END-->

    </div>
    <?php include("includes/footer1.php") ?>
    <?php include("includes/script1.php") ?>

    <script type="text/javascript" src="project-assets/js/index.js"></script>
    <script type="text/javascript" src="project-assets/js/common-test.js"></script>
</body>

</html>