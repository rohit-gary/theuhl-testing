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

<body id="bg">
  <div class="page-wraper" style="background:#fff">
    <div id="loading-area"></div>
    <!-- header -->
    <?php include('includes/header1.php'); ?>
    <!-- Content -->
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
                <a href="./our-test/all-test" class="custom-cta-button">Book Test</a>
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
    <div class="container-fluid my-3" style="background-color: #fff;">
      <div class="tp-banner-container container">
        <div class="tp-banner">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <!-- Carousel Indicators -->
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1" style="background-color:#673AB7 "></button>
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
                <img src="project-assets/images/banner/nb-2101.png" class="d-none d-md-block w-100" alt="Slide-1">
                <!-- Mobile Image -->
                <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100" alt="Mobile-Slide-1">
              </div>
              <div class="carousel-item">
                <img src="project-assets/images/banner/nb2-2502.png" class="d-none d-md-block w-100" alt="Slide-2">
                <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100" alt="Mobile-Slide-2">
              </div>
              <div class="carousel-item">
                <img src="project-assets/images/banner/nb3-2502.png" class="d-none d-md-block w-100" alt="Slide-3">
                <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100" alt="Mobile-Slide-3">
              </div>
              <div class="carousel-item">
                <img src="project-assets/images/banner/nb-2101.png" class="d-none d-md-block w-100" alt="Slide-4">
                <img src="project-assets/images/banner/nbm-2101.png" class="d-md-none w-100" alt="Mobile-Slide-4">
              </div>
            </div>

            <!-- Carousel Controls -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section>

    <div class="health-services-section">
      <div class="container page-container">
        <div class="row">
          <!-- Left Side - Health Plans Carousel -->
          <div class="col-lg-6 mb-4">
            <div class="health-category-box bg-soft-blue">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="category-title mb-0"><i class="fas fa-shield-alt"></i> Popular Health Plan Services</h3>
                <div class="carousel-controls">
                  <button class="btn btn-sm btn-outline-primary" data-bs-target="#planServicesCarousel"
                    data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-primary" data-bs-target="#planServicesCarousel"
                    data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </div>
              </div>

              <div id="planServicesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <!-- First Slide -->
                  <div class="carousel-item active">
                    <div class="row g-3">
                      <!-- First Row -->
                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/indi.png" alt="Renewal">
                              </div>
                              <h5>Individual Health Plan</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/family.png" alt="Claims">
                              </div>
                              <h5>Family Health Plan</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- Second Row -->
                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/sinior.png" alt="Service">
                              </div>
                              <h5>Senior Citizen Health Plan</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/unlimited.png" alt="Documents">
                              </div>
                              <h5>Unlimited Health Benefit Plan</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Second Slide -->
                  <div class="carousel-item">
                    <div class="row g-3">
                      <!-- Add more service cards here for the second slide if needed -->
                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/family.png" alt="Family Plans">
                              </div>
                              <h5>Family Plans</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/unlimited.png" alt="Documents">
                              </div>
                              <h5>Unlimited Health Benefit Plan</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/sinior.png" alt="Service">
                              </div>
                              <h5>Senior Citizen Health Plan</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="./all-plans" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-blue">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/plan/indi.png" alt="Renewal">
                              </div>
                              <h5>Individual Health Plan</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>


                      <!-- Add more cards as needed -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Side - Health Tests Carousel -->
          <div class="col-lg-6 mb-4">
            <div class="health-category-box bg-soft-green">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="category-title mb-0"><i class="fas fa-heartbeat"></i> Popular Health Tests Services</h3>
                <div class="carousel-controls">
                  <button class="btn btn-sm btn-outline-success me-2" data-bs-target="#healthTestsCarousel"
                    data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-success" data-bs-target="#healthTestsCarousel"
                    data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </div>
              </div>

              <div id="healthTestsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <!-- First Slide -->
                  <div class="carousel-item active">
                    <div class="row g-3">
                      <!-- First Row -->
                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/heart.png" alt="Checkup">
                              </div>
                              <h5>Heart Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card_1">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/kidney.png" alt="Lab Tests">
                              </div>
                              <h5>Kidney Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <!-- Second Row -->
                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/liver.png" alt="Consultation">
                              </div>
                              <h5>Liver Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/fracture.png" alt="Packages">
                              </div>
                              <h5>Bone Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Second Slide -->
                  <div class="carousel-item">
                    <div class="row g-3">
                      <!-- Add more health test cards here for the second slide if needed -->
                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/supplement.png" alt="Wellness">
                              </div>
                              <h5>Vitamin Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/hormones.png" alt="Wellness">
                              </div>
                              <h5>Hormones Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/gut-microbiota.png" alt="Wellness">
                              </div>
                              <h5>Gut Health Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="./our-test/all-test" class="service-card">
                          <div class="card h-100 service-item gradient-card-green">
                            <div class="card-body">
                              <div class="icon-wrapper">
                                <img src="./project-assets/images/test/blood.png" alt="Wellness">
                              </div>
                              <h5>Blood Checkups</h5>

                              <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                            </div>
                          </div>
                        </a>
                      </div>



                      <!-- Add more cards as needed -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <style>
      /* Add these styles to your existing CSS */

      .carousel-controls .btn {
        width: 32px;
        height: 32px;
        padding: 0;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
      }

      .carousel-controls .btn:hover {
        transform: translateY(-2px);
      }

      .hover-arrow {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        opacity: 0;
        transition: all 0.3s ease;
      }
    </style>
  </section>

  <section class="featured-tests py-5 d-none">
    <div class="container">
      <!-- Section Header -->
      <div class="row mb-5 text-center">
        <div class="col-lg-8 mx-auto">
          <h2 class="display-6 fw-bold mb-3">Our Medical <span class="text-primary">Test Services</span></h2>
          <p class="lead text-muted">Comprehensive diagnostic solutions for your well-being</p>
          <div class="divider-center"></div>
        </div>
      </div>

      <!-- Test Cards Container -->
      <div class="row g-4">
        <?php
        // Limit to first 20 tests
        $limited_tests = array_slice($all_test, 0, 8);
        foreach ($limited_tests as $index => $test):
          $testID = base64_encode($test['ID']);
          $baseprice = intval($test['TestFee']);
          $off = 0.16 * $baseprice;
          $totaloff = intval($baseprice + $off);
          ?>
          <div class="col-12  col-lg-3">
            <div class="test-card-modern">
              <div class="ribbon">
                <span>16% OFF</span>
              </div>

              <div class="test-card-header gradient-bg">
                <div class="icon-wrapper">
                  <i class="fas fa-flask"></i>
                </div>
                <h3 class="test-title" title="<?php echo $test['TestName'] ?>">
                  <?php echo strlen($test['TestName']) > 30 ? substr($test['TestName'], 0, 30) . '...' : $test['TestName']; ?>
                </h3>
              </div>

              <div class="test-card-body">
                <div class="price-tag">
                  <div class="price-details">
                    <span class="original">₹<?php echo $totaloff ?></span>
                    <span class="current">₹<?php echo $test['TestFee'] ?></span>
                  </div>
                  <span class="save-text">Save ₹<?php echo $totaloff - $test['TestFee'] ?></span>
                </div>

                <div class="features-list">
                  <div class="feature">
                    <i class="fas fa-clock text-primary"></i>
                    <span>Results in 6 hours</span>
                  </div>
                  <div class="feature">
                    <i class="fas fa-home text-primary"></i>
                    <span>Home Collection</span>
                  </div>
                  <div class="feature">
                    <i class="fas fa-certificate text-primary"></i>
                    <span>NABL Certified</span>
                  </div>
                </div>
              </div>

              <div class="test-card-footer">
                <a href="./our-test/test-details?ID=<?php echo $testID ?>" class="btn btn-link">
                  <i class="fas fa-info-circle"></i> Details
                </a>
                <button class="btn btn-primary book-now cart-btn" data-product-id="<?php echo $test['ID'] ?>"
                  data-product-id="<?php echo $test['ID'] ?>" data-product-name="<?php echo $test['TestName'] ?>"
                  data-product-price="<?php echo $test['TestFee'] ?>">
                  <i class="fas fa-calendar-check"></i> Book Now
                </button>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>

      <!-- See More Button -->

    </div>

  </section>
  </div>
  <div class="text-center mt-5 d-none">
    <a href="./our-test/all-test" class="see-more-btn">
      See More Tests
      <i class="fas fa-arrow-right ms-2"></i>
    </a>
  </div>
  <style>
    .hover-shadow {
      transition: all 0.3s ease;
    }

    .hover-shadow:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2) !important;
    }

    .icon-md {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }

    .icon-lg {
      width: 70px;
      height: 70px;
      object-fit: contain;
    }

    .max-w-800 {
      max-width: 800px;
    }

    .rounded-lg {
      border-radius: 1rem;
    }

    .transition {
      transition: all 0.3s ease;
    }

    .service-card_1 {
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .category-title {
      position: relative;
      padding-bottom: 15px;
    }

    .category-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 3px;
      background: #e6f3ff;
    }

    .opacity-90 {
      opacity: 0.9;
    }

    .service-card_1,
    .feature-card {
      background: rgba(255, 255, 255, 1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
  </style>
  <section class="section-full content-inner position-relative py-5"
    style="background: linear-gradient(135deg, #367eb7 0%, #196dad 100%); color: white;">
    <div class="container">
      <!-- Section Header -->
      <div class="section-head text-center mb-5">
        <h2 class="title text-white">Understanding Your <span style="color: #e6f3ff">Healthcare Journey</span></h2>
        <div class="sub-title mt-3">
          <p class="lead max-w-800 mx-auto text-white opacity-90">We help you navigate through comprehensive health
            testing and personalized insurance plans to ensure your complete wellness and protection.</p>
        </div>
      </div>

      <!-- Main Content Cards -->
      <div class="row g-4">
        <!-- Health Assessment Column -->
        <div class="col-lg-6">
          <div class="health-category-wrapper p-4">
            <h3 class="category-title mb-4 text-white">Health Assessment Services</h3>
            <div class="row g-4">
              <!-- Test Card 1 -->
              <div class="col-12">
                <div
                  class="service-card_1 d-flex align-items-center p-3 bg-white rounded-lg shadow-sm hover-shadow transition">
                  <div class="icon-wrapper me-4">
                    <img src="project-assets/images/icon/your-family.svg" class="icon-md"
                      alt="Comprehensive Health Screening">
                  </div>
                  <div class="content-wrapper">
                    <h4 class="h5 mb-2 text-dark">Comprehensive Health Screening</h4>
                    <p class="mb-0 text-secondary">Regular health checkups and preventive screenings to detect potential
                      health issues early.</p>
                  </div>
                </div>
              </div>
              <!-- Test Card 2 -->
              <div class="col-12">
                <div
                  class="service-card_1 d-flex align-items-center p-3 bg-white rounded-lg shadow-sm hover-shadow transition">
                  <div class="icon-wrapper me-4">
                    <img src="project-assets/images/icon/medical-emergency.svg" class="icon-md"
                      alt="Specialized Medical Tests">
                  </div>
                  <div class="content-wrapper">
                    <h4 class="h5 mb-2 text-dark">Specialized Medical Tests</h4>
                    <p class="mb-0 text-secondary">Advanced diagnostic services tailored to your specific health
                      concerns and family history.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Insurance Plans Column -->
        <div class="col-lg-6">
          <div class="health-category-wrapper p-4">
            <h3 class="category-title mb-4 text-white">Health Plan Coverage Options</h3>
            <div class="row g-4">
              <!-- Plan Card 1 -->
              <div class="col-12">
                <div
                  class="service-card_1 d-flex align-items-center p-3 bg-white rounded-lg shadow-sm hover-shadow transition">
                  <div class="icon-wrapper me-4">
                    <img src="project-assets/images/icon/your-financial.svg" class="icon-md"
                      alt="Flexible Coverage Plans">
                  </div>
                  <div class="content-wrapper">
                    <h4 class="h5 mb-2 text-dark">Flexible Coverage Plans</h4>
                    <p class="mb-0 text-secondary">Customizable insurance options including HMOs, PPOs, and
                      high-deductible plans to match needs.</p>
                  </div>
                </div>
              </div>
              <!-- Plan Card 2 -->
              <div class="col-12">
                <div
                  class="service-card_1 d-flex align-items-center p-3 bg-white rounded-lg shadow-sm hover-shadow transition">
                  <div class="icon-wrapper me-4">
                    <img src="project-assets/images/icon/income-replace.svg" class="icon-md"
                      alt="Comprehensive Benefits">
                  </div>
                  <div class="content-wrapper">
                    <h4 class="h5 mb-2 text-dark">Comprehensive Benefits</h4>
                    <p class="mb-0 text-secondary">Extended coverage including prescription medicines, specialist
                      consultations,preventive care.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Feature Cards -->
      <div class="row g-4 mt-5">
        <div class="col-md-4">
          <div class="feature-card text-center p-4 bg-white rounded-lg shadow-sm hover-shadow transition">
            <img src="project-assets/images/icon/change-life.svg" class="icon-lg mb-3" alt="24/7 Support">
            <h4 class="h5 text-dark">24/7 Support</h4>
            <p class="mb-0 text-secondary">Round-the-clock assistance for all your healthcare needs and inquiries.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card text-center p-4 bg-white rounded-lg shadow-sm hover-shadow transition">
            <img src="project-assets/images/icon/loans-debets.svg" class="icon-lg mb-3" alt="Network Coverage">
            <h4 class="h5 text-dark">Extensive Network</h4>
            <p class="mb-0 text-secondary">Access to a wide network of healthcare providers and testing facilities.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card text-center p-4 bg-white rounded-lg shadow-sm hover-shadow transition">
            <img src="project-assets/images/icon/your-financial.svg" class="icon-lg mb-3" alt="Smart Claims">
            <h4 class="h5 text-dark">Smart Claims Process</h4>
            <p class="mb-0 text-secondary">Quick and hassle-free digital claims processing for your convenience.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mt-5">
    <div class="row">
      <!-- Health Solutions Section -->
      <div class="health-solutions-section">
        <div class="section-background"></div>
        <div class="container position-relative">
          <!-- Section Header -->
          <div class="section-header text-center mb-5">
            <span class="subtitle">Comprehensive Healthcare</span>
            <h2 class="title">Our Health <span class="text-primary">Solutions</span></h2>
            <div class="title-separator"></div>
            <p class="section-description">Discover our range of healthcare plans and diagnostic services designed for
              your wellbeing</p>
          </div>

          <!-- Tab Navigation -->
          <ul class="nav nav-pills justify-content-center mb-5" id="healthSolutionsTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="plans-tab" data-bs-toggle="pill" data-bs-target="#plans"
                type="button">
                <i class="fas fa-shield-alt me-2"></i>Health Plans
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tests-tab" data-bs-toggle="pill" data-bs-target="#tests" type="button">
                <i class="fas fa-flask me-2"></i>Health Tests
              </button>
            </li>
          </ul>

          <!-- Tab Content -->
          <div class="tab-content" id="healthSolutionsContent">
            <div class="tab-pane fade show active" id="plans" role="tabpanel">
              <!-- Plans Carousel -->
              <div id="plansCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Carousel Controls at Top -->
                <div class="carousel-controls-top">
                  <button class="carousel-control-prev" type="button" data-bs-target="#plansCarousel"
                    data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#plansCarousel"
                    data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </div>

                <div class="carousel-inner">
                  <!-- First Slide -->
                  <div class="carousel-item active">
                    <div class="row g-4">
                      <!-- Plan Card 1 -->
                      <div class="col-md-4 col-sm-12">
                        <div class="solution-card">
                          <div class="card-badge">Popular</div>
                          <div class="test-card-header"
                            style="background: linear-gradient(135deg, #235789, #29A0B1); color: #fff;">
                            <div class="solution-icon">
                              <img src="project-assets/images/icon/hygiene.png" alt="Regular Health Guard">
                            </div>
                            <h4 style="color: #fff;">Regular Health Guard (Individual)</h4>
                          </div>
                          <div class="solution-content">
                            <p>Comprehensive individual health coverage for your peace of mind.</p>

                            <ul class="features-list">
                              <li><i class="fas fa-check-circle"></i> 24/7 Medical Support</li>
                              <li><i class="fas fa-check-circle"></i> Cashless Treatment</li>
                              <li><i class="fas fa-check-circle"></i> Wide Hospital Network</li>
                            </ul>
                            <a href="https://unitedhealthlumina.com/view-plan-details.php?id=OQ=="
                              class="btn btn-primary">
                              View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                          </div>
                        </div>
                      </div>

                      <!-- Plan Card 2 -->
                      <div class="col-md-4">
                        <div class="solution-card">
                          <div class="card-badge">Family</div>
                          <div class="test-card-header"
                            style="background: linear-gradient(135deg, #235789, #29A0B1); color: #fff;">
                            <div class="solution-icon">
                              <img src="project-assets/images/icon/family-insurance.png" alt="Family Health">
                            </div>
                            <h4 style="color: #fff;">REGULAR HEALTH GUARD 2.0</h4>
                          </div>
                          <div class="solution-content">
                            <p>Enhanced protection for you and your loved ones.</p>

                            <ul class="features-list">
                              <li><i class="fas fa-check-circle"></i> Family Coverage</li>
                              <li><i class="fas fa-check-circle"></i> Enhanced Benefits</li>
                            </ul>
                            <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTA="
                              class="btn btn-primary">
                              View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                          </div>
                        </div>
                      </div>

                      <!-- Plan Card 3 -->
                      <div class="col-md-4">
                        <div class="solution-card">
                          <div class="test-card-header"
                            style="background: linear-gradient(135deg, #235789, #29A0B1); color: #fff;">
                            <div class="solution-icon">
                              <img src="project-assets/images/icon/umbrella.png" alt="Health Guard">
                            </div>
                            <h4 style="color: #fff;">REGULAR HEALTH GUARD 3.0</h4>
                          </div>
                          <div class="solution-content">

                            <p>Advanced health protection with comprehensive coverage.</p>
                            <ul class="features-list">
                              <li><i class="fas fa-check-circle"></i> Premium Coverage</li>
                              <li><i class="fas fa-check-circle"></i> Advanced Features</li>
                            </ul>
                            <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTE="
                              class="btn btn-primary">
                              View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Second Slide -->
                  <div class="carousel-item">
                    <div class="row g-4">
                      <!-- Plan Card 4 -->
                      <div class="col-md-4">
                        <div class="solution-card">
                          <div class="test-card-header"
                            style="background: linear-gradient(135deg, #235789, #29A0B1); color: #fff;">
                            <div class="solution-icon">
                              <img src="project-assets/images/icon/patient.png" alt="Care Shield">
                            </div>
                            <h4 style="color: #fff;">CARE ADVANTAGE SHIELD</h4>
                          </div>
                          <div class="solution-content">
                            <p>Superior healthcare protection with added advantages.</p>
                            <ul class="features-list">

                              <li><i class="fas fa-check-circle"></i> Premium Benefits</li>
                              <li><i class="fas fa-check-circle"></i> Specialized Care</li>
                            </ul>
                            <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTI="
                              class="btn btn-primary">
                              View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                          </div>
                        </div>
                      </div>

                      <!-- Plan Card 5 -->
                      <div class="col-md-4">
                        <div class="solution-card">
                          <div class="card-badge">Pro</div>
                          <div class="test-card-header"
                            style="background: linear-gradient(135deg, #235789, #29A0B1); color: #fff;">
                            <div class="solution-icon">
                              <img src="project-assets/images/icon/health-insurance.png" alt="Med Benefit">
                            </div>
                            <h4 style="color: #fff;">MED BENEFIT PRO (MED 2.0)</h4>
                          </div>
                          <div class="solution-content">

                            <p>Professional medical benefits package with enhanced coverage.</p>
                            <ul class="features-list">
                              <li><i class="fas fa-check-circle"></i> Professional Coverage</li>
                              <li><i class="fas fa-check-circle"></i> Enhanced Medical Benefits</li>
                            </ul>
                            <a href="view-plan-details.php?id=MTM=" class="btn btn-primary">
                              View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                          </div>
                        </div>
                      </div>

                      <!-- Plan Card 6 -->
                      <div class="col-md-4">
                        <div class="solution-card">
                          <div class="test-card-header"
                            style="background: linear-gradient(135deg, #235789, #29A0B1); color: #fff;">
                            <div class="solution-icon">
                              <img src="project-assets/images/icon/patient.png" alt="Care Shield">
                            </div>
                            <h4 style="color: #fff;">CARE ADVANTAGE SHIELD</h4>
                          </div>
                          <div class="solution-content">
                            <p>Superior healthcare protection with added advantages.</p>
                            <ul class="features-list">

                              <li><i class="fas fa-check-circle"></i> Premium Benefits</li>
                              <li><i class="fas fa-check-circle"></i> Specialized Care</li>
                            </ul>
                            <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTI="
                              class="btn btn-primary">
                              View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Health Tests Tab -->
            <div class="tab-pane fade" id="tests" role="tabpanel">
              <!-- Tests Carousel -->
              <div id="testsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <?php
                  $limited_tests = array_slice($all_test, 0, 5); // Showing 6 tests (2 slides of 3 tests each)
                  $chunks = array_chunk($limited_tests, 3); // Split into groups of 3 for carousel
                  
                  foreach ($chunks as $index => $chunk):
                    ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                      <div class="row g-4">
                        <?php foreach ($chunk as $test):
                          $testID = base64_encode($test['ID']);
                          $baseprice = intval($test['TestFee']);
                          $off = 0.16 * $baseprice;
                          $totaloff = intval($baseprice + $off);
                          ?>
                          <div class="col-md-4">
                            <div class="solution-card">
                              <?php if ($index === 0 && $test === reset($chunk)): ?>
                                <div class="card-badge">Popular</div>
                              <?php endif; ?>
                              <div class="test-card-header gradient-bg-2"
                                style="background: linear-gradient(135deg, #235789, #29A0B1); color: #fff;">
                                <!-- <div class="solution-icon">
                                    <img src="project-assets/images/icon/laboratory.png"
                                      alt="<?php echo htmlspecialchars($test['TestName']); ?>">
                                  </div> -->
                                <h4 style="color: #fff;"><?php echo htmlspecialchars($test['TestName']); ?></h4>
                              </div>
                              <div class="solution-content">
                                <p>

                                  <?php echo htmlspecialchars($test['TestDescription'] ?? 'Comprehensive health screening'); ?>
                                </p>
                                <div class="price-section mb-3">
                                  <span class="current-price">₹<?php echo number_format($baseprice); ?></span>
                                  <span class="original-price">₹<?php echo number_format($totaloff); ?></span>
                                  <span class="discount">16% OFF</span>
                                </div>
                                <ul class="features-list">
                                  <li><i class="fas fa-check-circle"></i> Home Sample Collection</li>
                                  <li><i class="fas fa-check-circle"></i> 24-Hour Report</li>
                                </ul>
                                <a href="./our-test/test-details.php?ID=<?php echo $testID; ?>" class="btn btn-primary">
                                  Book Now <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>

                        <?php if ($index === count($chunks) - 1): // Add "See More" card in the last slide ?>
                          <div class="col-md-4">
                            <div class="solution-card see-more-card">
                              <div class="solution-icon">
                                <i class="fas fa-plus-circle"></i>
                              </div>
                              <div class="solution-content">
                                <h4>See More Tests</h4>
                                <p>Discover our complete range of diagnostic tests and health packages.</p>
                                <a href="./our-test/all-test.php" class="btn btn-outline-primary mt-4">
                                  View All Tests <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>

                <!-- Carousel Controls -->
                <div class="carousel-controls-top">
                  <button class="carousel-control-prev" type="button" data-bs-target="#testsCarousel"
                    data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#testsCarousel"
                    data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ----new test card secton----- -->

  <!-- Health Checks Section -->
  <section class="section-highlight mt-5">
    <div class="container section-content">
      <div class="row align-items-center mb-5">
        <div class="col-md-4">
          <h2 class="title">Health Checks for Key <span class="text-primary">Organs</span></h2>
          <p class="section-description">
            Discover our extensive suite of diagnostic tests designed specifically for vital body organs.
            These specialized tests provide comprehensive insights for optimal health maintenance.
          </p>
        </div>

        <div class="col-md-8">
          <div class="row g-4">
            <!-- Organ Cards -->
            <?php
            $organs = [
              ['name' => 'Heart', 'icon' => 'heart.png'],
              ['name' => 'Kidney', 'icon' => 'kidney.png'],
              ['name' => 'Liver', 'icon' => 'liver.png'],
              ['name' => 'Bone', 'icon' => 'fracture.png'],
              ['name' => 'Vitamin', 'icon' => 'supplement.png'],
              ['name' => 'Hormones', 'icon' => 'hormones.png'],
              ['name' => 'Gut Health', 'icon' => 'gut-microbiota.png'],
              ['name' => 'Blood', 'icon' => 'blood.png'],
              ['name' => 'Reproductive Health', 'icon' => 'reph.png'],
            ];

            foreach ($organs as $organ): ?>
              <div class="col-md-4 col-6">
                 <a href="./our-test/all-test#test_container" class="text-decoration-none">
                  <div class="organ-card text-center">
                    <img src="./project-assets/images/test/<?php echo $organ['icon'] ?>"
                      alt="<?php echo $organ['name'] ?>">
                    <h4 class="title"><?php echo $organ['name'] ?></h4>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section class="section-full bg-white  d-none">
    <div class="container" style="margin-top: 4rem;">
      <div class="">
        <h2 class="title text-center">Medical Subscription Health Plans for <span class="text-primary">every stage of
            your life </span></h2>
      </div>

      <!-- Tabs for Desktop -->
      <div class="dz-bannerlist d-none d-md-block" style="margin-top:3em">
        <ul class="nav nav-tabs dz-bannerlist d-flex justify-content-space-evenly" id="insuranceTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="term-plans-tab" data-bs-toggle="tab" href="#term-plans" role="tab"
              aria-controls="term-plans" aria-selected="true">REGULAR HEALTH GUARD (INDIVIDUAL)</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="savings-plans-tab" data-bs-toggle="tab" href="#savings-plans" role="tab"
              aria-controls="savings-plans" aria-selected="false">REGULAR HEALTH GUARD 2.0</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="ulip-plans-tab" data-bs-toggle="tab" href="#ulip-plans" role="tab"
              aria-controls="ulip-plans" aria-selected="false">REGULAR HEALTH GUARD 3.0</a>
          </li>

          <!-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ulip-plans-tab" data-bs-toggle="tab" href="#ulip-plans-second" role="tab" aria-controls="ulip-plans" aria-selected="false">HAPPY SURAKSHA UNLIMITED (INDIVIDUAL)</a>
                </li> -->



        </ul>
      </div>

      <!-- Accordion for Mobile -->
      <div class="accordion d-md-none" id="insuranceAccordion">
        <!-- REGULAR HEALTH GUARD (INDIVIDUAL) Accordion Item -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
              aria-expanded="true" aria-controls="collapseOne">
              REGULAR HEALTH GUARD (INDIVIDUAL)
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
            data-bs-parent="#insuranceAccordion">
            <div class="accordion-body">
              <!-- REGULAR HEALTH GUARD (INDIVIDUAL) Content -->
              <div class="row">
                <div class="col-md-4">
                  <img src="project-assets/images/plan/dummyplan.png" class="img-fluid"
                    alt="REGULAR HEALTH GUARD (INDIVIDUAL)">
                </div>
                <div class="col-md-8">
                  <h3>REGULAR HEALTH GUARD (INDIVIDUAL)</h3>
                  <p>A<a href="#" class="text-primary fw-bold"><u>REGULAR HEALTH GUARD (INDIVIDUAL)</u></a>OPD-based
                    subscription health plan offers comprehensive support for outpatient care, covering doctor
                    consultations with general physicians and specialists, diagnostic tests like X-rays and blood work,
                    and prescribed medications—all helping to make routine treatments more affordable. It also includes
                    mental health services such as counseling and psychotherapy, ensuring care for emotional well-being.
                    With a fast, hassle-free claims process, including options for reimbursement or direct billing, you
                    can reduce out-of-pocket expenses. Plus, 24/7 claim support ensures help is available whenever you
                    need it.
                  </p>
                  <div class="row">
                    <div class="col-md-6">
                      <h4>Validity - 1 year with 365 days cancellation</h4>
                      <p>Provides one year Cover against uncertainties of Life.</p>
                    </div>
                    <div class="col-md-6">

                      <p><a href="https://unitedhealthlumina.com/view-plan-details.php?id=OQ=="
                          class="text-primary fw-bold">
                    </div>
                  </div>
                  <div class="d-flex gap-3 mt-3">
                    <a href="https://unitedhealthlumina.com/view-plan-details.php?id=OQ=="
                      class="btn site-button appointment-btn btnhover13 btn-rounded">Buy Plan</a>
                    <a href="https://unitedhealthlumina.com/view-plan-details.php?id=OQ=="
                      class="btn btn-outline-success">Know More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- REGULAR HEALTH GUARD 2.0 Accordion Item -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              REGULAR HEALTH GUARD 2.0
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
            data-bs-parent="#insuranceAccordion">
            <div class="accordion-body">
              <!-- REGULAR HEALTH GUARD 2.0 Content -->
              <div class="row">
                <div class="col-md-4">
                  <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="REGULAR HEALTH GUARD 2.0">
                </div>
                <div class="col-md-8">
                  <h3>REGULAR HEALTH GUARD 2.0</h3>
                  <p>REGULAR HEALTH GUARD 2.0 are <a href="/life-insurance-plans.html"
                      class="text-primary fw-bold"><u>REGULAR HEALTH GUARD 2.0</u></a> OPD-based health plans provide
                    budget-friendly coverage for everyday healthcare needs. They include limited coverage for
                    consultations with general physicians and specialists, as well as partial or full coverage for
                    diagnostic tests like X-rays and blood tests. Prescribed medications from OPD visits are covered,
                    making treatments more affordable. The plans also offer access to wellness programs for stress
                    management and mindfulness, plus limited e-sessions with nutritionists and psychologists. With
                    hassle-free reimbursement and direct billing, members experience minimal out-of-pocket costs,
                    supported by 24/7 claim assistance for added convenience.
                  </p>
                  <div class="row">
                    <div class="col-md-6">
                      <h4>Validity - 1 year with 365 days cancellation</h4>
                      <h4></h4>

                    </div>
                    <div class="col-md-6">
                      <h4>Rider Options</h4>
                      <p>You can increase the coverage of your policy by adding additional riders.</p>
                    </div>
                  </div>
                  <div class="d-flex gap-3 mt-3">
                    <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTA="
                      class="btn site-button appointment-btn btnhover13 btn-rounded">Buy Plan</a>
                    <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTA="
                      class="btn btn-outline-success">Know More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- REGULAR HEALTH GUARD 3.0 Accordion Item -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              REGULAR HEALTH GUARD 3.0
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
            data-bs-parent="#insuranceAccordion">
            <div class="accordion-body">
              <!-- REGULAR HEALTH GUARD 3.0 Content -->
              <div class="row">
                <div class="col-md-4">
                  <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="REGULAR HEALTH GUARD 3.0">
                </div>
                <div class="col-md-8">
                  <h3>REGULAR HEALTH GUARD 3.0</h3>
                  <p>OPD-based health plans offer comprehensive coverage for everyday healthcare, including unlimited
                    consultations with general physicians and specialists, as well as unlimited diagnostic tests like
                    X-rays and blood tests. They cover all prescribed medications, making treatments affordable, and
                    provide access to wellness programs for stress management and mindfulness. Members can enjoy
                    unlimited e-sessions with nutritionists and psychologists, along with hassle-free reimbursement and
                    direct billing to reduce out-of-pocket costs. The plans also include annual health check-ups for the
                    family and regular dental and eye exams, with the flexibility to add or remove family members. Plus,
                    24/7 claim support is always available.
                  </p>
                  <div class="row">
                    <div class="col-md-6">


                    </div>
                    <div class="col-md-6">
                      <h4>Validity - 1 year with 365 days cancellation</h4>


                    </div>
                  </div>
                  <div class="d-flex gap-3 mt-3">
                    <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTE="
                      class="btn site-button appointment-btn btnhover13 btn-rounded">Buy Plan</a>
                    <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTE="
                      class="btn btn-outline-success">Know More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabs Content for Desktop -->
      <div class="tab-content mt-4 d-none d-md-block" id="insuranceTabContent">
        <!-- REGULAR HEALTH GUARD (INDIVIDUAL) Content -->
        <div class="tab-pane fade show active" id="term-plans" role="tabpanel" aria-labelledby="term-plans-tab">
          <!-- (same content as inside accordion) -->
          <!-- REGULAR HEALTH GUARD (INDIVIDUAL) Content -->
          <div class="row">
            <div class="col-md-4">
              <img src="project-assets/images/plan/dummyplan.png" class="img-fluid"
                alt="REGULAR HEALTH GUARD (INDIVIDUAL)">
            </div>
            <div class="col-md-8">
              <h3>REGULAR HEALTH GUARD (INDIVIDUAL)</h3>
              <p>A <a href="#" class="text-primary fw-bold"><u>REGULAR HEALTH GUARD (INDIVIDUAL)</u></a> An OPD-based
                subscription health plan offers comprehensive support for outpatient care, covering doctor consultations
                with general physicians and specialists, diagnostic tests like X-rays and blood work, and prescribed
                medications—all helping to make routine treatments more affordable. It also includes mental health
                services such as counseling and psychotherapy, ensuring care for emotional well-being. With a fast,
                hassle-free claims process, including options for reimbursement or direct billing, you can reduce
                out-of-pocket expenses. Plus, 24/7 claim support ensures help is available whenever you need it.
              </p>
              <div class="row">
                <div class="col-md-6">
                  <h4>Validity - 1 year with 365 days cancellation</h4>
                  <p>Provides one year Cover against uncertainties of Life.</p>
                </div>
                <div class="col-md-6">


                  <p><a href="/blogs/life-insurance/know-the-tax-benefits-of-insurance-policies.html"
                      class="text-primary fw-bold">
                </div>
              </div>
              <div class="d-flex gap-3 mt-3">
                <a href="https://unitedhealthlumina.com/view-plan-details.php?id=OQ=="
                  class="btn site-button appointment-btn btnhover13 btn-rounded">Buy Plan</a>
                <a href="https://unitedhealthlumina.com/view-plan-details.php?id=OQ=="
                  class="btn btn-outline-success">Know More</a>
              </div>
            </div>
          </div>
        </div>

        <!-- REGULAR HEALTH GUARD 2.0 Content -->
        <div class="tab-pane fade" id="savings-plans" role="tabpanel" aria-labelledby="savings-plans-tab">
          <!-- (same content as inside accordion) -->
          <!-- REGULAR HEALTH GUARD 2.0 Content -->
          <div class="row">
            <div class="col-md-4">
              <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="REGULAR HEALTH GUARD 2.0">
            </div>
            <div class="col-md-8">
              <h3>REGULAR HEALTH GUARD 2.0</h3>
              <p>REGULAR HEALTH GUARD 2.0 are <a href="/life-insurance-plans.html"
                  class="text-primary fw-bold"><u>REGULAR HEALTH GUARD 2.0</u></a>OPD-based health plans provide
                budget-friendly coverage for everyday healthcare needs. They include limited coverage for consultations
                with general physicians and specialists, as well as partial or full coverage for diagnostic tests like
                X-rays and blood tests. Prescribed medications from OPD visits are covered, making treatments more
                affordable. The plans also offer access to wellness programs for stress management and mindfulness, plus
                limited e-sessions with nutritionists and psychologists. With hassle-free reimbursement and direct
                billing, members experience minimal out-of-pocket costs, supported by 24/7 claim assistance for added
                convenience.
              </p>
              <div class="row">
                <div class="col-md-6">
                  <h4>Validity - 1 year with 365 days cancellation</h4>
                  <h4></h4>

                </div>
                <div class="col-md-6">
                  <h4>Rider Options</h4>
                  <p>You can increase the coverage of your policy by adding additional riders.</p>
                </div>
              </div>
              <div class="d-flex gap-3 mt-3">
                <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTA="
                  class="btn site-button appointment-btn btnhover13 btn-rounded">Buy Plan</a>
                <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTA="
                  class="btn btn-outline-success">Know More</a>
              </div>
            </div>
          </div>
        </div>

        <!-- REGULAR HEALTH GUARD 3.0 Content -->
        <div class="tab-pane fade" id="ulip-plans" role="tabpanel" aria-labelledby="ulip-plans-tab">
          <!-- (same content as inside accordion) -->
          <!-- REGULAR HEALTH GUARD 3.0 Content -->
          <div class="row">
            <div class="col-md-4">
              <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="REGULAR HEALTH GUARD 3.0">
            </div>
            <div class="col-md-8">
              <h3>REGULAR HEALTH GUARD 3.0</h3>
              <p>OPD-based health plans offer comprehensive coverage for everyday healthcare, including unlimited
                consultations with general physicians and specialists, as well as unlimited diagnostic tests like X-rays
                and blood tests. They cover all prescribed medications, making treatments affordable, and provide access
                to wellness programs for stress management and mindfulness. Members can enjoy unlimited e-sessions with
                nutritionists and psychologists, along with hassle-free reimbursement and direct billing to reduce
                out-of-pocket costs. The plans also include annual health check-ups for the family and regular dental
                and eye exams, with the flexibility to add or remove family members. Plus, 24/7 claim support is always
                available.
              </p>
              <div class="row">
                <div class="col-md-6">
                  <h4>Validity - 1 year with 365 days cancellation</h4>


                </div>
                <div class="col-md-6">


                </div>
              </div>
              <div class="d-flex gap-3 mt-3">
                <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTE="
                  class="btn site-button appointment-btn btnhover13 btn-rounded">Buy Plan</a>
                <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTE="
                  class="btn btn-outline-success">Know More</a>
              </div>
            </div>
          </div>

        </div>
      </div>

  </section>





  <section class="section-full content-inner my-5 d-none" style="background-color: aliceblue; ">
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="margin-top: -1.5em;">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item ">
            <img src="project-assets/images/plan/bnruhl.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="project-assets/images/plan/bnruhl1.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item active">
            <img src="project-assets/images/plan/r4.png" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>


  <section class="section-full bg-gradient-light content-inner">
    <div class="health-services-section">
      <div class="container page-container">
        <div class="section-top-title">
          <h2 class="title text-center">Your Complete <span class="text-primary">Healthcare Journey</span></h2>
          <p class="text-center subtitle">Comprehensive health plans and preventive care solutions for your wellbeing
          </p>
        </div>

        <div class="row mt-5">
          <!-- Left Side - Health Plans -->
          <div class="col-lg-6 mb-4">
            <div class="health-category-box bg-soft-blue">
              <h3 class="category-title"><i class="fas fa-shield-alt"></i> Health Plan Services</h3>
              <div class="row g-3">
                <!-- Plan Service Cards -->
                <div class="col-6">
                  <a href="uhladmin/admin/authentication/login" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-blue">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/pay-premium.png" alt="Renewal">
                        </div>
                        <h5>Renewal & Payments</h5>
                        <p class="small">Manage your subscription plans easily</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-6">
                  <a href="uhladmin/admin/authentication/login" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-blue">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/register-claim.png" alt="Claims">
                        </div>
                        <h5>Claims & Reimbursements</h5>
                        <p class="small">Quick and easy claim processing</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-6">
                  <a href="./contact-us" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-blue">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/raise-service-request.png" alt="Service">
                        </div>
                        <h5>Support Services</h5>
                        <p class="small">24/7 assistance for your needs</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-6">
                  <a href="uhladmin/admin/authentication/login" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-blue">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/download-Statement.png" alt="Documents">
                        </div>
                        <h5>Policy Documents</h5>
                        <p class="small">Access all your documents instantly</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Side - Health Tests -->
          <div class="col-lg-6 mb-4">
            <div class="health-category-box bg-soft-green">
              <h3 class="category-title"><i class="fas fa-heartbeat"></i> Preventive Healthcare</h3>
              <div class="row g-3">
                <!-- Health Test Cards -->
                <div class="col-6">
                  <a href="#" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-green">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/health-checkup.png" alt="Checkup">
                        </div>
                        <h5>Health Checkups</h5>
                        <p class="small">Comprehensive health screening</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-6">
                  <a href="#" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-green">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/lab-test.png" alt="Lab Tests">
                        </div>
                        <h5>Lab Tests</h5>
                        <p class="small">Wide range of diagnostic tests</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-6">
                  <a href="#" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-green">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/doctor-consultation.png" alt="Consultation">
                        </div>
                        <h5>Doctor Consultation</h5>
                        <p class="small">Expert medical <br> advice</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-6">
                  <a href="#" class="service-card_1">
                    <div class="card h-100 service-item gradient-card-green">
                      <div class="card-body">
                        <div class="icon-wrapper">
                          <img src="project-assets/images/icon/health-packages.png" alt="Packages">
                        </div>
                        <h5>Health Packages</h5>
                        <p class="small">Customized wellness programs</p>
                        <div class="hover-arrow"><i class="fas fa-arrow-right"></i></div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->

      </div>
    </div>
  </section>


  <!-- Wellness Section -->
  <section class="section-highlight">
    <div class="container section-content">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="row g-4">
            <?php
            $checkups = [
              ['name' => 'Women Health', 'icon' => 'Women-Health.png'],
              ['name' => 'Lifestyle Checkup', 'icon' => 'Lifestyle-Checkup.png'],
              ['name' => 'Cancer Checkup', 'icon' => 'Cancer-Checkup.png'],
              ['name' => 'Senior Citizen', 'icon' => 'Senior.png'],
              ['name' => 'Full Body Checkups', 'icon' => 'Full-Body-Checkups.png'],
              ['name' => 'Diabetes Checkup', 'icon' => 'Diabetes.png'],
            ];

            foreach ($checkups as $checkup): ?>
              <div class="col-md-4 col-6">
                 <a href="./our-test/all-test#test_container" class="text-decoration-none">
                  <div class="organ-card text-center">
                    <img src="./project-assets/images/test/<?php echo $checkup['icon'] ?>"
                      alt="<?php echo $checkup['name'] ?>">
                    <h4 class="title"><?php echo $checkup['name'] ?></h4>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-4">
          <h2 class="title">Prioritize Your Wellness with <span class="text-primary">Personalized Care</span></h2>
          <p class="section-description">
            Our customized health checkups are designed to meet your unique needs, focusing on your lifestyle,
            age, and medical history. Discover a tailored approach to preventive healthcare.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="section-full content-inner benefits-section"
    style="background: linear-gradient(135deg, #367eb7 0%, #196dad 100%); color: white;">
    <div class="container">
      <div class="text-center mb-5">
        <span class="subtitle text-primary">Why Choose Us</span>
        <h2 class="title" style="color: white;">Benefits of <span class="">Our Health Services</span></h2>
        <p class="section-description" style="color: white;">Comprehensive healthcare solutions designed for your peace
          of mind</p>
      </div>

      <div class="benefits-grid">
        <!-- Benefit Card 1 -->
        <div class="benefit-card">
          <div class="benefit-icon">
            <div class="icon-wrapper">
              <img src="project-assets/images/icon/wealth-plans.svg" alt="Medical Protection">
            </div>
          </div>
          <div class="benefit-content">
            <h3>Medical Protection</h3>
            <p>Free or low-cost preventative care including annual check-ups, vaccinations, and early screening programs
            </p>
            <ul class="benefit-features">
              <li><i class="fas fa-check-circle"></i> Annual health check-ups</li>
              <li><i class="fas fa-check-circle"></i> Preventive screenings</li>
              <li><i class="fas fa-check-circle"></i> Vaccination coverage</li>
            </ul>
          </div>
        </div>

        <!-- Benefit Card 2 -->
        <div class="benefit-card">
          <div class="benefit-icon">
            <div class="icon-wrapper">
              <img src="project-assets/images/icon/performance.svg" alt="Prescription Coverage">
            </div>
          </div>
          <div class="benefit-content">
            <h3>Prescription Benefits</h3>
            <p>Comprehensive coverage for both generic and brand-name medications at approved pharmacies</p>
            <ul class="benefit-features">
              <li><i class="fas fa-check-circle"></i> Generic drug coverage</li>
              <li><i class="fas fa-check-circle"></i> Brand-name options</li>
              <li><i class="fas fa-check-circle"></i> Network pharmacies</li>
            </ul>
          </div>
        </div>

        <!-- Benefit Card 3 -->
        <div class="benefit-card">
          <div class="benefit-icon">
            <div class="icon-wrapper">
              <img src="project-assets/images/icon/assured-return.svg" alt="Mental Health">
            </div>
          </div>
          <div class="benefit-content">
            <h3>Mental Wellness</h3>
            <p>Comprehensive mental health support including therapy, counseling, and psychiatric care</p>
            <ul class="benefit-features">
              <li><i class="fas fa-check-circle"></i> Therapy sessions</li>
              <li><i class="fas fa-check-circle"></i> Counseling services</li>
              <li><i class="fas fa-check-circle"></i> Wellness programs</li>
            </ul>
          </div>
        </div>

        <!-- Benefit Card 4 -->
        <div class="benefit-card">
          <div class="benefit-icon">
            <div class="icon-wrapper">
              <img src="project-assets/images/icon/tax-benefits.svg" alt="Lab Coverage">
            </div>
          </div>
          <div class="benefit-content">
            <h3>Diagnostic Care</h3>
            <p>Extensive coverage for laboratory tests and diagnostic procedures</p>
            <ul class="benefit-features">
              <li><i class="fas fa-check-circle"></i> Lab test coverage</li>
              <li><i class="fas fa-check-circle"></i> Diagnostic imaging</li>
              <li><i class="fas fa-check-circle"></i> Preventive screenings</li>
            </ul>
          </div>
        </div>

        <!-- Benefit Card 5 -->
        <div class="benefit-card">
          <div class="benefit-icon">
            <div class="icon-wrapper">
              <img src="project-assets/images/icon/low-premium.svg" alt="Telemedicine">
            </div>
          </div>
          <div class="benefit-content">
            <h3>Virtual Care</h3>
            <p>24/7 access to healthcare professionals through telemedicine services</p>
            <ul class="benefit-features">
              <li><i class="fas fa-check-circle"></i> Video consultations</li>
              <li><i class="fas fa-check-circle"></i> Remote monitoring</li>
              <li><i class="fas fa-check-circle"></i> Digital prescriptions</li>
            </ul>
          </div>
        </div>

        <!-- Benefit Card 6 -->
        <div class="benefit-card">
          <div class="benefit-icon">
            <div class="icon-wrapper">
              <img src="project-assets/images/icon/low-premium.svg" alt="Peace of Mind">
            </div>
          </div>
          <div class="benefit-content">
            <h3>Peace of Mind</h3>
            <p>Comprehensive coverage that lets you focus on health, not expenses</p>
            <ul class="benefit-features">
              <li><i class="fas fa-check-circle"></i> Financial security</li>
              <li><i class="fas fa-check-circle"></i> Family protection</li>
              <li><i class="fas fa-check-circle"></i> 24/7 support</li>
            </ul>
          </div>
        </div>
      </div>
    </div>


  </section>




  <section class="section-full bg-white content-inner">
    <div class="container">
      <div class="row">
        <!-- Form Section -->
        <div class="col-md-6">
          <div class=" h-100">
            <div class="card-header">
              <h2 class="title">Need Help to Choose the Right <span class="text-primary">Health Solution</span></h2>
              <p>Our experts are happy to help you!</p>
            </div>
            <div class="card-body">
              <form id="tte-review-form_second">
                <div class="row mb-3">
                  <div class="col-md-12">
                    <label for="needformName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="needformName_second" name="needformName"
                      placeholder="Enter full name" required>
                    <div class="invalid-feedback">Please enter your name.</div>
                  </div>
                  <div class="col-md-12">
                    <label for="needformMobile" class="form-label">Mobile No.</label>
                    <div class="input-group">
                      <span class="input-group-text">+91</span>
                      <input type="tel" class="form-control" id="needformMobile_second" name="needformMobile"
                        placeholder="Enter mobile number" maxlength="10" required>
                      <div class="invalid-feedback">Please enter your mobile number.</div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="planSelect" class="form-label">Plan</label>
                    <select class="form-control" id="planSelect_second" name="planSelect" required>
                      <option value="" selected disabled>Select plan</option>

                      <option value="REGULAR HEALTH GUARD (INDIVIDUAL)(Individual)">
                        REGULAR HEALTH GUARD (INDIVIDUAL)(Individual)</option>
                      <option value="REGULAR HEALTH GUARD 2.0">REGULAR HEALTH GUARD 2.0</option>
                      <option value="REGULAR HEALTH GUARD 3.0">REGULAR HEALTH GUARD 3.0</option>
                      <option value="HAPPY SURAKSHA UNLIMITED (INDIVIDUAL)">
                        HAPPY SURAKSHA UNLIMITED (INDIVIDUAL)</option>
                      <option value="HAPPY SURAKSHA UNLIMITED (FAMILY FLOATER 3.0)">HAPPY SURAKSHA UNLIMITED (FAMILY
                        FLOATER 3.0)</option>
                      <option value="HAPPY SURAKSHA UNLIMITED (MAIGNIT 2.0)">HAPPY SURAKSHA UNLIMITED (MAIGNIT 2.0)
                      </option>
                      <option value="I don't know/I need help">I don't know/I need help</option>
                    </select>
                    <div class="invalid-feedback">Please select a plan.</div>
                  </div>
                  <div class="col-md-12 mt-4">
                    <button type="submit" class="btn site-button appointment-btn btnhover13 btn-rounded"
                      onclick="Submitenquiry_2(event)">Get a Call Back</button>
                  </div>
                </div>
              </form>
              <div class="form-text mt-3">
                United Health Lumina Plan Ltd will send you updates on your policy, new products & services.
              </div>
            </div>
          </div>
        </div>
        <!-- Image Section -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
          <img class="img-fluid" src="project-assets/images/icon/connect-to-get.svg"
            alt="Happy Customer Image | UHL Health" title="Happy Customer Image"
            style="height: 90%; object-fit: contain;">
        </div>
      </div>
    </div>
  </section>



  <!-- Clients & Partnerships Section -->
  <div class="section-full bg-gary content-inner d-none" style="background-color:aliceblue; ">
    <div class="container">
      <div class="section-head text-center">
        <h2 class="title">Our Acceptable <span class="text-primary">Hospital and Labs</span></h2>
        <p>Partnering for Excellence in Healthcare. Together, we deliver outstanding care and innovative solutions.</p>
      </div>

      <!-- Grid layout for clients/partnership logos -->
      <div class="clients-grid">
        <div class="client-item"><img src="project-assets/images/client-partership/3.webp" alt="Client 1"></div>
        <div class="client-item"><img src="project-assets/images/client-partership/7.webp" alt="Client 2"></div>
        <div class="client-item"><img src="project-assets/images/client-partership/6.webp" alt="Client 3"></div>
        <div class="client-item"><img src="project-assets/images/client-partership/1.webp" alt="Client 4"></div>
        <div class="client-item"><img src="project-assets/images/client-partership/2.webp" alt="Client 5"></div>
        <div class="client-item"><img src="project-assets/images/client-partership/4.webp" alt="Client 6"></div>

        <!-- Add more logos as needed -->
      </div>
    </div>
  </div>

  <!-- About Company END -->

  <!-- Our Projects END -->
  <div class="section-full bg-white content-inner d-none">
    <div class="container">
      <div class="section-head text-center">
        <h2 class="title">Our Latest <span class="text-primary">Plans</span></h2>
        <p>United Health Lumina (UHL) offers an affordable, subscription-based health plan with flexible options. It
          covers essential medical services, preventive care, and wellness benefits, providing hassle-free access to
          quality healthcare without high upfront costs.</p>
      </div>
      <section class="section" id="pricing">

        <?php include('new-plan-lunch.php') ?>

      </section>

      <section class="section-full bg-white content-inner mt-3" style="">
        <div class="choose-us-sec choose-us-sec-ht" data-aos="fade" data-aos-duration="1000" data-aos-delay="300"
          data-aos-offset="300">
          <div class="container">
            <div class="section-title text-center mb-5">
              <h2 class="title">Why Choose <span class="text-primary">UHL Health Plans</span></h2>

              <p>Select UHL Health Plans for comprehensive, affordable, and customizable healthcare coverage tailored to
                your needs. With a network of top-tier healthcare providers, competitive premiums, and a variety of plan
                options, you can ensure quality care for you and your family.
                Our customer service and wellness programs prioritize your health and provide peace of mind, making UHL
                the ideal choice for your health plan needs</p>
            </div>

            <div class="row align-items-center">
              <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                <img class="img-fluid" src="project-assets/images/icon/choose-us_compressed_uhl.png" alt="Choose Us">
              </div>
              <div class="col-lg-6 col-md-12">
                <div class="row g-4">
                  <div class="col-lg-6 col-md-6 col-6">
                    <div class="card  text-center p-3 border-0">
                      <img src="project-assets/images/icon/Families-protected-so-far.svg" class="mx-auto"
                        alt="Families protected">
                      <div class="card-body">
                        <h5 class="card-title">Comprehensive coverage</h5>
                        <p class="card-text">Comprehensive OPD coverage.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6">
                    <div class="card  text-center p-3 border-0">
                      <img src="project-assets/images/icon/Crores-Retail-Sum-Assured.svg" class="mx-auto"
                        alt="Retail Sum Assured">
                      <div class="card-body">
                        <h5 class="card-title">Customizable <br> Plans </br></h5>
                        <p class="card-text">Choose from a variety of plan options.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6">
                    <div class="card  text-center p-3 border-0">
                      <img src="project-assets/images/icon/Assets-Under-Management.svg" class="mx-auto"
                        alt="Assets Under Management">
                      <div class="card-body">
                        <h5 class="card-title">Customer-Centric Service</h5>
                        <p class="card-text">Benefit from dedicated customer service.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6">
                    <div class="card  text-center p-3 border-0">
                      <img src="project-assets/images/icon/Claim-Settlement-Ratio.svg" class="mx-auto"
                        alt="Claim Settlement Ratio">
                      <div class="card-body">
                        <h5 class="card-title">Top-Tier Provider Network</h5>
                        <p class="card-text">Access a broad network of trusted providers.</p>
                      </div>
                    </div>
                  </div>
                  <!--    <div class="col-lg-6 col-md-6 col-6">
                            <div class="card  text-center p-3 border-0">
                                <img src="project-assets/images/icon/Branches-Presence.svg" class="mx-auto" alt="Branches Presence">
                                <div class="card-body">
                                    <h5 class="card-title">500+ Branches</h5>
                                    <p class="card-text">Presence across major cities in India</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="card  text-center p-3 border-0">
                                <img src="project-assets/images/icon/AIA_Icon_settle claims.svg" class="mx-auto" alt="Express Claim Settlement">
                                <div class="card-body">
                                    <h5 class="card-title">4 Hours</h5>
                                    <p class="card-text">Express Claim Settlement<sup>10</sup></p>
                                    <p style="font-size: 10px; color: rgb(167,169,172);"><sup>10</sup>T&C apply</p>
                                </div>
                            </div>
                        </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



    </div>
  </div>


  <!-- Testimonials Style 9 -->
  <div class="section-full  content-inner-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="sort-title clearfix text-center">

            <h2 class="title">Reviews from UHL <span class="text-primary">family members</span>
            </h2>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="testimonial-two-dots owl-carousel owl-none owl-theme owl-dots-black-full">
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">2 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic1.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>Being the sole breadwinner, I was worried about my aging parents. UHL health plan provided the ideal
                  coverage with additional benefits like fastest claim settlement .</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Rahul Kashyap</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">2 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic2.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>Choosing UHL HEALTH PLANS felt like an adventure. The website guided me smoothly and I was thrilled
                  with the ease of comparison. Cheers UHL. The website guided me smoothly</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Adarsh Kumar</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">4 weeks ago</p>
                </div>
              </div>


              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic3.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>Having UHL heath plan which is so beneficial and the investment is also low. Service provided is
                  quick and on time. Online renewals are made so simple through online portal service.</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Kushagra</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">2 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic1.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>I got the UHL Health Plan at a low cost, and the coverage is as high as promised. The service is
                  excellent, and their staff is available 24/7 to assist with any inquiries.</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Mahima Pandey</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                  <i class="far fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">2 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic2.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>I’m securing my future by investing in the UHL Health Plan and opting for their retirement health
                  plans. In my opinion, it’s the best investment, as the policy covers 92% of my healthcare needs.</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Ajeet</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">1 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic3.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>The claims process is easy due to the fast service provided by their dedicated staff. Plus, it offers
                  tax-saving benefits, which is another great advantage. I'm very satisfied with it.</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Chitransh Trivedi</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">1 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic1.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>I purchased the UHL Health Plan, opting for their term health coverage. The premiums are affordable,
                  around Rs. 10K per year, making it a great option for my budget.</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Tushar</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">2 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic2.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>I have the UHL Health Plan for my family of four, and it has proven to be reliable with many benefits
                  and great returns on investment. The policy coverage is around 90%.</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Naina Verma</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
          <div class="item p-a5">
            <div class="testimonial-9">
              <div class="testimonial-icon d-flex align-items-center justify-content-between">

                <div class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="0.98em" height="1em" viewBox="0 0 256 262">
                    <path fill="#4285f4"
                      d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                    <path fill="#34a853"
                      d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                    <path fill="#fbbc05"
                      d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                    <path fill="#eb4335"
                      d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                  </svg>
                </div>

                <!-- 5-star rating -->
                <div class="stars mx-3">
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                  <i class="fas fa-star" style="color: #FFD700;"></i>
                </div>

                <!-- Time -->
                <div class="time mx-3">
                  <p class="mb-0">2 week ago</p>
                </div>
              </div>
              <!-- <div class="testimonial-pic radius style1"><img src="project-assets/images/testimonials/pic3.jpg" width="100" height="100" alt=""></div> -->
              <div class="testimonial-text">
                <p>I’m securing my future by investing in the UHL Health Plan and opting for their retirement health
                  plans. In my opinion, it’s the best investment, as the policy covers 92% of my healthcare needs.</p>
              </div>
              <div class="testimonial-detail"> <strong class="testimonial-name">Saurabh</strong> <span
                  class="testimonial-position">People</span> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="section-full bg-white content-inner d-none" style="margin-bottom: 5rem;"
    style="background-color:white;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card gradient-bg">

            <div class="card-body">

              <h2 class="title text-center">Purchase / Renew Subscription <span class="text-primary">Health Plan
                  Online</span></h2>
              <p class="text-center">If you are an existing UHL family member , <a href="#"
                  style="color: rgb(0,115,187);font-weight: bold;">you can quickly renew your subscription online</a>
                here!</p>

              <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                  <a class="btn site-button appointment-btn btnhover13 btn-rounded">Pay Now</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>



  </section>



  <!-- Latest blog -->
  <div class="section-full  wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s"
    style="background: linear-gradient(135deg, #367eb7 0%, #196dad 100%); color: white;  margin-top:-3em">
    <div class="container content-inner">
      <div class="section-head text-center">
        <h2 class="title">Latest <span class="text-primary">blog post</span></h2>
        <p style="color: white;">Our health plan offers comprehensive coverage with free doctor consultations, 24/7
          claims support, and fast
          claim settlements. Enjoy peace of mind with Quick reimbursement and access to the largest health network</p>
      </div>
      <div class="blog-carousel owl-none owl-carousel">
        <div class="item">
          <div class="blog-post post-style-1">
            <div class="dlab-post-media dlab-img-effect rotate">
              <a href="your-guide-to-choosing-the-right-coverage"><img
                  src="project-assets/images/blog/latest-blog/blog2.jpg" alt=""></a>
            </div>
            <div class="dlab-post-info">
              <div class="dlab-post-meta">
                <ul>
                  <li class="post-date"> <strong>22 Oct</strong> <span> 2024</span> </li>
                  <li class="post-author"> By <a href="your-guide-to-choosing-the-right-coverage">UHL</a> </li>
                </ul>
              </div>
              <div class="dlab-post-title">
                <h3 class="post-title"><a href="your-guide-to-choosing-the-right-coverage">Health Plans Unpacked: Your
                    Guide to Choosing the Right Coverage</a></h3>
              </div>
              <div class="dlab-post-readmore">
                <a href="your-guide-to-choosing-the-right-coverage" title="READ MORE" rel="bookmark"
                  class="site-button btnhover13">READ MORE</a>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="blog-post post-style-1">
            <div class="dlab-post-media dlab-img-effect rotate">
              <a href="how-virtual-care-is-transforming-patient-experiences"><img
                  src="project-assets/images/blog/latest-blog/blog1.jpg" alt=""></a>
            </div>
            <div class="dlab-post-info">
              <div class="dlab-post-meta">
                <ul>
                  <li class="post-date"> <strong>22 Oct</strong> <span> 2024</span> </li>
                  <li class="post-author"> By <a href="how-virtual-care-is-transforming-patient-experiences">UHL</a>
                  </li>
                </ul>
              </div>
              <div class="dlab-post-title ">
                <h3 class="post-title"><a href="how-virtual-care-is-transforming-patient-experiences">The Rise of
                    Telemedicine: How Virtual Care is Transforming Patient Experiences
                  </a></h3>
              </div>
              <div class="dlab-post-readmore">
                <a href="how-virtual-care-is-transforming-patient-experiences" title="READ MORE" rel="bookmark"
                  class="site-button btnhover13">READ MORE</a>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="blog-post post-style-1">
            <div class="dlab-post-media dlab-img-effect rotate">
              <a href="how-green-practices-are-Impacting-the-medical-industry"><img
                  src="project-assets/images/blog/latest-blog/blog3.jpg" alt=""></a>
            </div>
            <div class="dlab-post-info">
              <div class="dlab-post-meta">
                <ul>
                  <li class="post-date"> <strong>22 Oct</strong> <span> 2024</span> </li>
                  <li class="post-author"> By <a href="how-green-practices-are-Impacting-the-medical-industry">UHL</a>
                  </li>
                </ul>
              </div>
              <div class="dlab-post-title">
                <h3 class="post-title"><a href="how-green-practices-are-Impacting-the-medical-industry">Sustainable
                    Healthcare: How Green Practices Are Impacting the Medical Industry
                  </a></h3>
              </div>
              <div class="dlab-post-readmore">
                <a href="how-green-practices-are-Impacting-the-medical-industry" title="READ MORE" rel="bookmark"
                  class="site-button btnhover13">READ MORE</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>


  <!-- Your Faq -->
  <div class="section-full content-inner bg-white">
    <div class="container">
      <div class="section-head text-black text-left">
        <h2 class="title text-center">General <span class="text-primary">FAQ'S</span></h2>
      </div>
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="dlab-accordion faq-2 box-sort-in" id="accordion1">
            <div class="panel">
              <div class="acod-head">
                <h6 class="acod-title">
                  <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq1" class="collapsed"
                    aria-expanded="true">
                    1. What are the benefits of subscribing to a United Health Lumina health plan?</a>
                </h6>
              </div>
              <div id="faq1" class="acod-body collapse" data-bs-parent="#accordion1">
                <div class="acod-content">United Health Lumina's subscription plans offer a range of benefits, including
                  comprehensive coverage for outpatient department (OPD) services, in-patient treatment, and preventive
                  care, with flexible claim options.
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="acod-head">
                <h6 class="acod-title">
                  <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq2" class="collapsed"
                    aria-expanded="true">
                    2. What makes United Health Lumina’s OPD plans unique?</a>
                </h6>
              </div>
              <div id="faq2" class="acod-body collapse" data-bs-parent="#accordion1">
                <div class="acod-content">United Health Lumina’s OPD-based health plans allow claims on outpatient
                  treatments, offering subscribers flexibility for medical consultations, diagnostics, and more without
                  needing hospitalization.
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="acod-head">
                <h6 class="acod-title">
                  <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq3" class="collapsed"
                    aria-expanded="true">
                    3. Can I customize my health plan with United Health Lumina?</a>
                </h6>
              </div>
              <div id="faq3" class="acod-body collapse" data-bs-parent="#accordion1">
                <div class="acod-content"> Yes, United Health Lumina provides customizable health plan options to cater
                  to specific medical needs, lifestyle requirements, and family size.
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="acod-head">
                <h6 class="acod-title">
                  <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq4" class="collapsed"
                    aria-expanded="true">
                    4. How are claims handled in United Health Lumina subscription plans?</a>
                </h6>
              </div>
              <div id="faq4" class="acod-body collapse" data-bs-parent="#accordion1">
                <div class="acod-content">United Health Lumina offers a streamlined claims process with flexible
                  reimbursement options, making it easier for members to claim expenses across OPD and in-patient
                  services.
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="acod-head">
                <h6 class="acod-title">
                  <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq5" class="collapsed"
                    aria-expanded="true">
                    5. Are there any wellness benefits included in United Health Lumina’s health plans?
                  </a>
                </h6>
              </div>
              <div id="faq5" class="acod-body collapse" data-bs-parent="#accordion1">
                <div class="acod-content">Yes, United Health Lumina includes preventive health benefits like routine
                  check-ups, health screenings, and wellness programs to support overall well-being.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Faq Info END -->
    </div>
  </div>
  <!-- Your Faq End -->
  <!-- Latest blog END -->
  <!-- Client logo -->
  <!--  <div class="section-full dlab-we-find bg-img-fix p-t20 p-b20 bg-white wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
        <div class="container">
          <div class="section-content">
            <div class="client-logo-carousel mfp-gallery gallery owl-btn-center-lr owl-carousel owl-btn-3">
              <div class="item">
                <div class="ow-client-logo">
                  <div class="client-logo"><a href="javascript:void(0);"><img src="project-assets/images/client-logo/logo1.jpg" alt=""></a></div>
                </div>
              </div>
              <div class="item">
                <div class="ow-client-logo">
                  <div class="client-logo"> <a href="javascript:void(0);"><img src="project-assets/images/client-logo/logo2.jpg" alt=""></a> </div>
                </div>
              </div>
              <div class="item">
                <div class="ow-client-logo">
                  <div class="client-logo"> <a href="javascript:void(0);"><img src="project-assets/images/client-logo/logo1.jpg" alt=""></a> </div>
                </div>
              </div>
              <div class="item">
                <div class="ow-client-logo">
                  <div class="client-logo"> <a href="javascript:void(0);"><img src="project-assets/images/client-logo/logo3.jpg" alt=""></a> </div>
                </div>
              </div>
              <div class="item">
                <div class="ow-client-logo">
                  <div class="client-logo"> <a href="javascript:void(0);"><img src="project-assets/images/client-logo/logo4.jpg" alt=""></a> </div>
                </div>
              </div>
              <div class="item">
                <div class="ow-client-logo">
                  <div class="client-logo"> <a href="javascript:void(0);"><img src="project-assets/images/client-logo/logo3.jpg" alt=""></a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
  <!-- Client logo END -->
  </div>
  </div>
  <!-- Content END-->

  </div>
  <?php include("includes/footer1.php") ?>
  <?php include("includes/script1.php") ?>

  <script type="text/javascript" src="project-assets/js/index.js"></script>
  <script type="text/javascript" src="project-assets/js/common-test.js"></script>
</body>

</html>