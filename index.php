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
</head>

<body id="bg">
  <div class="page-wraper" style="background:#fff">
    <div id="loading-area"></div>
    <!-- header -->
    <?php include('includes/header1.php'); ?>

    <!-- header END -->

    <!-- header END -->
    <!-- Content -->
    <div class="page-content bg-white">
      <!-- Main Slider -->
      <div class="dz-industry-zone">
        <div class="position-absolute dz-social-icon">
        </div>
        <div class="container ">
          <div class="row">
            <!-- Desktop Banner -->
            <div class="col-12 position-relative d-none d-md-block">
              <div class="overlaytextbanner dz-media upper-bnr position-relative">
                <div class="container position-relative">
                  <!-- Banner Image -->
                  <img src="project-assets/images/banner/Desktop-Banner.png" alt="Banner Image" class="img-fluid"
                    style="width: 100%;">

                  <!-- Top left content -->
                  <div class="top-left position-absolute  ">
                    <h2 class="tag-line"><b>बीमारी का डर छोड़ो, UHL से नाता जोड़ो।</b></h2>
                    <h3 class="text-uppercase">With United Health Lumina Plans</h3>
                    <a href="#talktoexpert" class="btnhover13 bg-white text-black">Talk to Expert</a>
                  </div>

                  <!-- Bottom left content (features) -->
                  <div class="bottom-left d-flex justify-content-center position-absolute text-white w-100">
                    <div class="feature-item">
                      <h4>Free Doctor Consultation</h4>
                    </div>
                    <div class="feature-item">
                      <h4>24*7 Claims Support</h4>
                    </div>
                    <div class="feature-item">
                      <h4> Quick reimbursement</h4>
                    </div>
                    <div class="feature-item">
                      <h4>Zero waiting period</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Mobile Banner -->
          <div class="col-12 position-relative d-block d-md-none">
            <div class="dz-media upper-bnr Mobile-Banner">
              <!-- <img src="project-assets/images/banner/Mobile-Banner.png" alt="#" class="img-fluid"> -->

              <div class="overlaytextbanner dz-media upper-bnr position-relative">
                <div class="container position-relative">
                  <!-- Banner Image -->
                  <img src="project-assets/images/banner/mobile-banner-3.jpg" alt="Banner Image" class="img-fluid"
                    style="width: 100%;">

                  <!-- Top left content -->
                  <div class="top-left">
                    <h2 class="tag-line"><b>बीमारी का डर छोड़ो, UHL से नाता जोड़ो।</b></h2>
                    <h3 class="text-uppercase">With United Health Lumina Plans</h3>
                    <div class="mobile-banner-btn">
                      <!-- Main Heading -->
                      <h4 class="text-uppercase white-strip btnhover13" id="talktoexpert-mobile"
                        onclick="scrollToSection()">Check Our Plans</h4>
                      <!-- <p class="tagline-mobile ">#सुरक्षित रहो, बेफिक्र जियो</p> -->
                    </div>
                  </div>


                  <!-- Bottom left content (features) -->
                  <!-- Bottom left content (features) -->
                  <div class="bottom-left-mobile d-flex justify-content-center position-absolute text-white w-100">
                    <div class="feature-item-mobile">
                      <h4>Free Doctor Consultation</h4>
                    </div>
                    <div class="feature-item-mobile">
                      <h4>24*7 Claims Support</h4>
                    </div>
                    <div class="feature-item-mobile">
                      <h4> Quick reimbursement</h4>
                    </div>
                    <div class="feature-item-mobile">
                      <h4>Zero waiting period</h4>
                    </div>
                    <div class="feature-item-mobile">
                      <h4>Largest Network</h4>
                    </div>


                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>


        <div class="row">
          <!-- About Us -->
          <div class="section-full bg-white my-5">
            <div class="container">
              <!-- Heading in the middle -->
              <h2 class="title text-center">Popular <span class="text-primary">Categories</span></h2>

              <div class="row my-4">
                <!-- Card 1 -->
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                  <a href="https://unitedhealthlumina.com/view-plan-details.php?id=OQ==">
                    <div class="card text-center h-100">

                      <div class="card-body">
                        <img src="project-assets/images/icon/hygiene.png" style="height:4em">
                        <h4 class="title">REGULAR HEALTH GUARD (INDIVIDUAL)</h4>
                      </div>

                    </div>
                  </a>
                </div>
                <!-- Card 2 -->
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                  <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTA=">
                    <div class="card text-center h-100">
                      <div class="card-body">
                        <img src="project-assets/images/icon/family-insurance.png" style="height:4em">
                        <h4 class="title">REGULAR HEALTH GUARD 2.0</h4>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- Card 3 -->
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                  <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTE=">
                    <div class="card text-center h-100">
                      <div class="card-body">
                        <img src="project-assets/images/icon/umbrella.png" style="height:4em">
                        <h4 class="title">REGULAR HEALTH GUARD 3.0</h4>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- Card 4 -->
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                  <a href="https://unitedhealthlumina.com/view-plan-details.php?id=MTI=">
                    <div class="card text-center h-100">
                      <div class="card-body">
                        <img src="project-assets/images/icon/patient.png" style="height:4em">
                        <h4 class="title">CARE ADVANTAGE SHIELD</h4>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- Card 5 -->
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                  <a href="#">
                    <div class="card text-center h-100">
                      <div class="card-body">
                        <img src="project-assets/images/icon/health-insurance.png" style="height:4em">
                        <h4 class="title">MED BENEFIT PRO (MED 2.0)</h4>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- Card 6 -->
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                  <a href="#">
                    <div class="card text-center h-100">
                      <div class="card-body">
                        <img src="project-assets/images/icon/shield.png" style="height:4em">
                        <h4 class="title">UHL PRO HEALTH PLUS</h4>
                      </div>
                    </div>
                  </a>
                </div>

              </div>
            </div>
          </div>

          <!-- About Us End -->

        </div>
      </div>

    </div>



    <!-- here health plan subscription -->

    <section class="section-full bg-white content-inner" id="talktoexpert">
      <div class="container">
        <div class="row mobile-form" style="margin-top:-16em">
          <div class="col-md-12">
            <div class="card gradient-bg d-none">
              <div class="card-header gradient-bg">
                <h2 class="title">Looking to buy a new life <span class="text-primary">Health plan?</span></h2>
                <p>Our experts are happy to help you!</p>
              </div>
              <div class="card-body">
                <form id="tte-review-form">
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label for="needformName" class="form-label">Name</label>
                      <input type="text" class="form-control" id="needformName" name="needformName"
                        placeholder="Enter full name" required>
                      <div class="invalid-feedback">Please enter your name.</div>
                    </div>
                    <div class="col-md-3">
                      <label for="needformMobile" class="form-label">Mobile No.</label>
                      <div class="input-group">
                        <span class="input-group-text">+91</span>
                        <input type="tel" class="form-control" id="needformMobile" name="needformMobile"
                          placeholder="Enter mobile number" maxlength="10" required>
                        <div class="invalid-feedback">Please enter your mobile number.</div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="planSelect" class="">Plan</label>
                      <select class="form-control" id="planSelect" name="planSelect" required>
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
                    <div class="col-md-3">
                      <br>
                      <div class="input-group mt-2">
                        <button type="submit" class="btn site-button appointment-btn btnhover13 btn-rounded"
                          onclick="Submitenquiry(event)">Get a Call Back</button>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="form-text">
                  United Health Lumina Plan Ltd will send you updates on your policy, new products & services.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <section class="section-full bg-white content-inner">
        <div class="container">
          <div class="section-head text-center">
            <h2 class="title">Comprehensive <span class="text-primary">Health Tests</span></h2>
            <p>Get insights into your health with our wide range of diagnostic tests and health packages</p>
          </div>

          <div class="row g-4">
            <!-- Test Category 1 -->
            <div class="col-lg-4 col-md-6">
              <div class="card h-100 test-card">
                <div class="card-body">
                  <div class="test-icon mb-3">
                    <i class="fas fa-heartbeat fa-2x text-primary"></i>
                  </div>
                  <h4 class="card-title">Cardiac Health</h4>
                  <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i>ECG Test</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Lipid Profile</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Stress Test</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Heart Risk Assessment</li>
                  </ul>
                  <!-- <a href="#talktoexpert" class="btn btn-outline-primary mt-3">Book Now</a> -->
                </div>
              </div>
            </div>

            <!-- Test Category 2 -->
            <div class="col-lg-4 col-md-6">
              <div class="card h-100 test-card">
                <div class="card-body">
                  <div class="test-icon mb-3">
                    <i class="fas fa-flask fa-2x text-primary"></i>
                  </div>
                  <h4 class="card-title">Diabetes Care</h4>
                  <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Blood Sugar Fasting</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>HbA1c Test</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Glucose Tolerance</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Diabetes Screening</li>
                  </ul>
                  <!-- <a href="#talktoexpert" class="btn btn-outline-primary mt-3">Book Now</a> -->
                </div>
              </div>
            </div>

            <!-- Test Category 3 -->
            <div class="col-lg-4 col-md-6">
              <div class="card h-100 test-card">
                <div class="card-body">
                  <div class="test-icon mb-3">
                    <i class="fas fa-dna fa-2x text-primary"></i>
                  </div>
                  <h4 class="card-title">Full Body Checkup</h4>
                  <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Complete Blood Count</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Liver Function Test</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Kidney Function Test</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Thyroid Profile</li>
                  </ul>
                  <!-- <a href="#talktoexpert" class="btn btn-outline-primary mt-3">Book Now</a> -->
                </div>
              </div>
            </div>
          </div>

          <!-- Features Row -->
          <div class="row mt-5">
            <div class="col-md-3 col-6 text-center">
              <div class="test-feature">
                <i class="fas fa-hospital fa-2x mb-3 text-primary"></i>
                <h5>NABL Accredited Labs</h5>
              </div>
            </div>
            <div class="col-md-3 col-6 text-center">
              <div class="test-feature">
                <i class="fas fa-user-md fa-2x mb-3 text-primary"></i>
                <h5>Expert Technicians</h5>
              </div>
            </div>
            <div class="col-md-3 col-6 text-center">
              <div class="test-feature">
                <i class="fas fa-clock fa-2x mb-3 text-primary"></i>
                <h5>Same Day Reports</h5>
              </div>
            </div>
            <div class="col-md-3 col-6 text-center">
              <div class="test-feature">
                <i class="fas fa-home fa-2x mb-3 text-primary"></i>
                <h5>Home Sample Collection</h5>
              </div>
            </div>
          </div>
        </div>
      </section>




    </section>

    <section class="featured-tests py-5">
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
  <div class="text-center mt-5">
    <a href="./our-test/all-test" class="see-more-btn">
      See More Tests
      <i class="fas fa-arrow-right ms-2"></i>
    </a>
  </div>

  <section class="section-full  content-inner" style="background-color: aliceblue; margin-top:3.5em;z-index:-1">
    <div class="container" style="margin-top:-2em">
      <div class="text-center">
        <h2 class="title text-center">How to knows Which <span class="text-primary">Health Plan Do you need ?</span>
        </h2>

        <p>Figuring out your health plan coverage can seem detailed, but it becomes easy once you understand it better.
          Here's what you should think about when calculating how much health plan coverage you need</p>
      </div>

      <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/your-family.svg" class="card-img-top"
              alt="Health Plan for your Family’s Financial Security">
            <div class="card-body">
              <h3 class="card-title">Assess Your Healthcare Needs</h3>
              <p class="card-text">Consider your medical history, any chronic conditions, and frequency of doctor
                visits.If you have dependents, evaluate their healthcare needs as well.</p>
            </div>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/your-financial.svg" class="card-img-top"
              alt="Income-Based Health Plan Coverage">
            <div class="card-body">
              <h3 class="card-title">Flexibility</h3>
              <p class="card-text">Choose between plans like HMOs, PPOs, or high-deductible options based on how much
                flexibility you want in choosing providers.</p>
            </div>
          </div>
        </div>
      </div>



      <div class="row g-4 mt-4">
        <!-- Card 3 -->

        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/income-replace.svg" class="card-img-top"
              alt="Income Replacement Insurance">
            <div class="card-body">
              <h3 class="card-title">Check Network Coverage</h3>
              <p class="card-text">Ensure your preferred doctors, hospitals, and specialists are in the plan’s network
                to avoid higher costs.</p>
            </div>
          </div>
        </div>



        <!-- Card 4 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/loans-debets.svg" class="card-img-top" alt="Loans and Debts Insurance">
            <div class="card-body">
              <h3 class="card-title">Customer Service and Support</h3>
              <p class="card-text">We provide a great customer service & support. We value you and your health. You have
                a query, feel free to call us, it will be our pleasure to help you out.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4 mt-4">
        <!-- Card 5 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/medical-emergency.svg" class="card-img-top"
              alt="Medical Emergencies Insurance">
            <div class="card-body">
              <h3 class="card-title">Future Considerations</h3>
              <p class="card-text">Think about any changes in your health needs that may arise in the coming years and
                whether the plan can accommodate them.</p>
            </div>
          </div>
        </div>
        <!-- Card 6 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/change-life.svg" class="card-img-top"
              alt="Changes in Life Stage Insurance">
            <div class="card-body text-start">
              <h3 class="card-title">Prescription Medicine Coverage</h3>
              <p class="card-text">If you take regular medications, review the plan’s formulary (list of covered drugs)
                and the cost-sharing structure for prescriptions</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>



  <section class="section-full bg-white  ">
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





  <section class="section-full  content-inner my-5" style="background-color: aliceblue;">
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


  <section class="section-full bg-white content-inner">
    <div class="newbie-sec happy-mem-sect">
      <div class="container page-container">
        <div class="section-top-title">
          <h2 class="title text-center">Happy <span class="text-primary">Members</span></h2>
        </div>
        <div class="row mt-4">
          <!-- Image Section -->
          <div class="col-md-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
            <div class="newbie-lhs ani-rhs">
              <img class="img-fluid" src="project-assets/images/happy-member_compressed.png"
                alt="Happy Customer Image | UHL Health" title="Happy Customer Image">
            </div>
          </div>

          <!-- Cards Section -->
          <div class="col-md-8">
            <div class="row">
              <!-- Card 1 -->
              <div class="col-6 col-md-4 col-sm-6 mt-2">
                <a href="uhladmin/admin/authentication/login">
                  <div class="card text-center h-100">
                    <div class="card-body">
                      <img src="project-assets/images/icon/pay-premium.png" style="height:4em">
                      <h4 class="title">Renewal Subscription Plan </h4>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Card 2 -->
              <div class="col-6 col-md-4 col-sm-6 mt-2">
                <a href="uhladmin/admin/authentication/login">
                  <div class="card text-center h-100">
                    <div class="card-body">
                      <img src="project-assets/images/icon/download-Statement.png" style="height:4em">
                      <h4 class="title">Download Documents</h4>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Card 3 -->
              <div class="col-6 col-md-4 col-sm-6 mt-2">
                <a href="uhladmin/admin/authentication/login">
                  <div class="card text-center h-100">
                    <div class="card-body">
                      <img src="project-assets/images/icon/register-claim.png" style="height:4em">
                      <h4 class="title">Register Reimbursement</h4>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Card 4 -->
              <div class="col-6 col-md-4 col-sm-6 mt-2">
                <a href="./contact-us">
                  <div class="card text-center h-100">
                    <div class="card-body">
                      <img src="project-assets/images/icon/raise-service-request.png" style="height:4em">
                      <h4 class="title">Raise Service Request</h4>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Card 5 -->
              <div class="col-6 col-md-4 col-sm-6 mt-2">
                <a href="uhladmin/admin/authentication/login">
                  <div class="card text-center h-100">
                    <div class="card-body">
                      <img src="project-assets/images/icon/other-services.png" style="height:4em">
                      <h4 class="title">Other Services</h4>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Card 6 -->
              <div class="col-6 col-md-4 col-sm-6 mt-2">
                <a href="uhladmin/admin/authentication/login">
                  <div class="card text-center h-100">
                    <div class="card-body">
                      <img src="project-assets/images/icon/whatsapp-payment.png" style="height:4em">
                      <h4 class="title">Pay Premium using WhatsApp</h4>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <!-- Login Button -->
            <div class="col-12 mt-5 text-center">
              <a class="btn site-button appointment-btn btnhover13 btn-rounded" href="./uhladmin">My Health Plan
                Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>


  </section>


  <section class="section-full content-inner" style="background-color: aliceblue;">
    <div class="container" style="margin-top: -1.5em">
      <div class="text-center mb-5">
        <h2 class="title text-center">Benefits of <span class="text-primary">UHL Health Plan</span></h2>

        <p>Here are the important reasons why you must have Health Plan</p>
      </div>

      <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/wealth-plans.svg" class="card-img-top"
              alt="Health Plan for your Family’s Financial Security">
            <div class="card-body">
              <h3 class="card-title">Medical Protection</h3>
              <p class="card-text"> United Health Lumina health plans offer free or low-cost preventative care (e.g.,
                annual check-ups, vaccinations, screenings) to catch potential health issues early, reducing the need
                for more expensive treatments later.</p>
            </div>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/performance.svg" class="card-img-top"
              alt="Income-Based Health Plan Coverage">
            <div class="card-body">
              <h3 class="card-title">Prescription Medicine Coverage</h3>
              <p class="card-text">United Health Lumina Health plans often include coverage for prescription
                medications, helping to manage the costs of both generic and brand-name drugs. Most of our plans provide
                a list of approved pharmacies where individuals can fill prescriptions at lower prices.
              </p>
            </div>
          </div>
        </div>
      </div>



      <div class="row g-4 mt-4">
        <!-- Card 3 -->

        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/assured-return.svg" class="card-img-top"
              alt="Income Replacement Insurance">
            <div class="card-body">
              <h3 class="card-title">Mental Health and Wellness Benefits</h3>
              <p class="card-text">Our health plans include coverage for mental health services, such as therapy,
                counseling, and psychiatric care, which can be critical for overall well-being.
                Some Health plans offer programs or incentives to encourage healthy behaviors, such as fitness
                discounts, smoking cessation programs, and weight management resources.
              </p>
            </div>
          </div>
        </div>



        <!-- Card 4 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/tax-benefits.svg" class="card-img-top" alt="Loans and Debts Insurance">
            <div class="card-body">
              <h3 class="card-title">Prescription & Lab Test Coverage</h3>
              <p class="card-text">These plans often include coverage for consultations, reducing out-of-pocket
                lab test expenses</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4 mt-4">
        <!-- Card 5 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/low-premium.svg" class="card-img-top"
              alt="Medical Emergencies Insurance">
            <div class="card-body">
              <h3 class="card-title">Telemedicine and Virtual Care</h3>
              <p class="card-text">Our health plans now cover telemedicine visits, allowing individuals to consult with
                doctors remotely, saving time and reducing exposure to illnesses in waiting rooms. Virtual visits are
                often less expensive than in-person visits, providing a more affordable alternative for non-emergency
                situations</p>
            </div>
          </div>
        </div>
        <!-- Card 6 -->
        <div class="col-md-6 col-lg-6">
          <div class="card h-100 d-flex flex-row align-items-center">
            <img src="project-assets/images/icon/low-premium.svg" class="card-img-top"
              alt="Changes in Life Stage Insurance">
            <div class="card-body text-start">
              <h3 class="card-title">Peace of Mind</h3>
              <p class="card-text">Knowing that unexpected medical expenses are covered can relieve stress and provide
                peace of mind. Plans allows individuals to focus on their health and well-being without worrying about
                financial strain.
              </p>
            </div>
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
              <h2 class="title">Need Help to Choose the Right <span class="text-primary">Health plan?</span></h2>
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
  <div class="section-full bg-gary content-inner" style="background-color:aliceblue;">
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
  <div class="section-full bg-white content-inner">
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

  <!-- Company staus End -->
  <!-- Team member -->
  <!--   <div class="section-full " style="background-color:aliceblue;">
        <div class="container content-inner">
          <div class="section-head text-center ">
           
            <h2 class="title">Meet Our <span class="text-primary">Doctors</span></h2>
            <p>Discover our team of expert doctors dedicated to providing top-notch care. With diverse specialties and years of experience, they are here to ensure your health and well-being.</p>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp">
              <div class="dlab-box m-b30 dlab-team1">
                <div class="dlab-media">
                  <a href="team-1.html">
                    <img width="358" height="460" alt="" src="project-assets/images/our-team/doctor-1.jpg" class="lazy" data-src="project-assets/images/our-team/doctor-2.jpg">
                  </a> 
                </div>
                <div class="dlab-info">
                  <h4 class="dlab-title"><a href="team-1.html">Nashid Martines</a></h4>
                  <span class="dlab-position">Director</span>
                  <ul class="dlab-social-icon dez-border">
                    <li><a class="fab fa-facebook-f" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-twitter" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-linkedin-in" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-pinterest-p" href="javascript:void(0);"></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
              <div class="dlab-box m-b30 dlab-team1">
                <div class="dlab-media">
                  <a href="team-1.html">
                    <img width="358" height="460" alt="" src="project-assets/images/our-team/doctor-1.jpg" class="lazy" data-src="project-assets/images/our-team/doctor-1.jpg">
                  </a>
                </div>
                <div class="dlab-info">
                  <h4 class="dlab-title"><a href="team-1.html">Konne Backfield</a></h4>
                  <span class="dlab-position">Doctor</span>
                  <ul class="dlab-social-icon dez-border">
                    <li><a class="fab fa-facebook-f" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-twitter" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-linkedin-in" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-pinterest-p" href="javascript:void(0);"></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
              <div class="dlab-box m-b30 dlab-team1">
                <div class="dlab-media">
                  <a href="team-1.html">
                    <img width="358" height="460" alt="" src="project-assets/images/our-team/doctor-2.jpg" class="lazy" data-src="project-assets/images/our-team/doctor-2.jpg">
                  </a>
                </div>
                <div class="dlab-info">
                  <h4 class="dlab-title"><a href="team-1.html">Hackson Willingham</a></h4>
                  <span class="dlab-position">Doctor</span>
                  <ul class="dlab-social-icon dez-border">
                    <li><a class="fab fa-facebook-f" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-twitter" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-linkedin-in" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-pinterest-p" href="javascript:void(0);"></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.8s">
              <div class="dlab-box m-b30 dlab-team1">
                <div class="dlab-media">
                  <a href="team-1.html">
                    <img width="358" height="460" alt="" src="project-assets/images/our-team/doctor-1.jpg" class="lazy" data-src="project-assets/images/our-team/doctor-1.jpg">
                  </a>
                </div>
                <div class="dlab-info">
                  <h4 class="dlab-title"><a href="team-1.html">Konne Backfield</a></h4>
                  <span class="dlab-position">Doctor</span>
                  <ul class="dlab-social-icon dez-border">
                    <li><a class="fab fa-facebook-f" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-twitter" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-linkedin-in" href="javascript:void(0);"></a></li>
                    <li><a class="fab fa-pinterest-p" href="javascript:void(0);"></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
  <!-- Team member End -->
  <!-- Testimonials Style 9 -->
  <div class="section-full  content-inner-2" style="background-color:aliceblue;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="sort-title clearfix text-center">

            <h2 class="title">Reviews from <span class="text-primary">UHL family members</span></h2>
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

  <section class="section-full bg-white content-inner" style="margin-bottom: 5rem;" style="background-color:white;">
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
    style="background-color:aliceblue; margin-top:-3em">
    <div class="container content-inner">
      <div class="section-head text-center">
        <h2 class="title">Latest <span class="text-primary">blog post</span></h2>
        <p>Our health plan offers comprehensive coverage with free doctor consultations, 24/7 claims support, and fast
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