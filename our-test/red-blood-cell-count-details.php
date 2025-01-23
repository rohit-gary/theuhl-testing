<?php session_start();
include('include/logic.php');
?>

<head>
  <?php include("../includes/meta.php") ?>
  <?php include("../includes/links1.php") ?>
  <title>Our Most Popular Test</title>
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../project-assets/css/all_test.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style type="text/css">
    .test-banner-heading-2 {
      font-weight: bolder;
      font-size: 32px;
      color: black;
      line-height: 50px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: #dddd;
      border-radius: 50%;
      width: 30px;
      height: 20px;
    }

    .card {
      background-color: #fff;
    }

    @media (max-width: 768px) {
      .test-info-section {
        margin-top: 18em !important;
      }
    }

    @media (min-width: 769px) {
      .test-info-section {
        margin-top: 13em;
      }
    }
  </style>
</head>


<body id="bg" style="z-index:10">
  <div class="page-wraper">
    <div id="loading-area"></div>
    <!-- header -->
    <?php include('../includes/header1.php'); ?>
    <div class="content-area bg-white main-area-testpage">
      <section class="banner-area-test-page " style="background-color:#fff ;">
        <div class="container"
          style="background: linear-gradient(135deg, #8cc5e2, #5f9dc7); border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
          <div class="row align-items-center">
            <!-- Product Image Section -->
            <div class="col-md-6">
              <img src="../project-assets/images/generic-old-2.png" alt="test-desktop-banner" class="img-fluid rounded"
                style="max-width: 100%; border-radius: 10px;">
            </div>

            <!-- Product Information Section -->
            <div class="col-md-6">
              <h2 class="test-banner-heading-2" style="font-size: 30px; font-weight: 700; color: #333;">
                Red Blood Cell Count (RBC Count)
              </h2>

              <!-- Pricing Section -->
              <div class="mt-4" style="font-size: 18px; font-weight: bold;">
                <span
                  style="color: #795548; text-decoration: line-through; margin-right: 10px; font-size: 20px;">&#8377;
                  267</span>
                <span style="color: #28a745; font-size: 24px; font-weight: 700;">&#8377; 220</span>
                <span class="dis-span" style="color: #fff; font-size: 18px; font-weight: 600;">16% OFF</span>
              </div>

              <!-- Add to Cart Button -->
              <div class="mt-4">
                <button class="btn cart-btn btn-success w-100 py-3" data-product-id="<?php echo $all_test[0]['ID'] ?>"
                  data-product-name="<?php echo $all_test[0]['TestName'] ?>"
                  data-product-price=" <?php echo $all_test[0]['TestFee'] ?>"
                  style="border-radius: 8px; font-size: 18px; font-weight: 700;">
                  Add to Cart
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="test-info-section">
        <div class="container">
          <!-- First Row - Reports and Parameters -->
          <div class="row">
            <!-- Desktop view: separate cards for Reports Within and Parameters -->
            <div class="col-lg-5 d-none d-lg-block text-center mb-2">
              <div class="card shadow-lg border-light rounded-3">
                <div class="card-body py-4">
                  <h5 class="card-title text-primary">Reports Within</h5>
                  <p class="card-text  text-muted"><b>6 Hours</b></p>
                </div>
              </div>
            </div>

            <div class="col-lg-2 d-none d-lg-block text-center mb-2">
              <div class="card shadow-lg border-light rounded-3">
                <div class="card-body py-4">
                  <h5 class="card-title text-primary">Parameters</h5>
                  <p class="card-text text-muted"><b>01</b></p>
                </div>
              </div>
            </div>

            <!-- Mobile view: combine both into one card -->
            <div class="col-12 d-block d-lg-none">
              <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                  <p class="card-text text-muted"><b><i class="fas fa-file-alt"></i> Reports Within:</b> 6 Hours</p>
                  <p class="card-text text-muted"><b><i class="fas fa-microscope"></i> Parameter Include:</b> 01</p>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="card shadow-lg border-light rounded-3">
                <div class="card-body py-4">
                  <h5 class="card-title text-primary text-center">Requisites</h5>
                  <div id="requisitesCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="col-sm-12 mx-auto text-center">
                          <p class="card-text text-muted hover-cursor">
                            <img src="../project-assets/images/blood-icon.webp" style="height: 25px;">
                            Blood Sample
                          </p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="col-sm-12 mx-auto text-center">
                          <p class="card-text text-muted hover-cursor">
                            <img src="../project-assets/images/no-fasting-icon.webp" style="height: 25px;">
                            No Fasting Required
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#requisitesCarousel"
                      data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#requisitesCarousel"
                      data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Third Row - Measures and Identifies -->
          <div class="row my-4">
            <!-- Desktop view: Measures and Identifies in separate cards -->
            <div class="col-lg-5 d-none d-lg-block mb-3">
              <div class="card shadow-lg border-light rounded-3">
                <div class="card-body py-4">
                  <h5 class="card-title text-primary">Measures</h5>
                  <p class="card-text text-muted">Number of red blood cells in the blood</p>
                </div>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block mb-3">
              <div class="card shadow-lg border-light rounded-3">
                <div class="card-body py-4">
                  <h5 class="card-title text-primary">Identifies</h5>
                  <p class="card-text text-muted">Red blood cell disorders</p>
                </div>
              </div>
            </div>

            <!-- Mobile view: Combine both into one card -->
            <div class="col-12 d-block d-lg-none">
              <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                  <p class="card-text text-muted"><b>Measures:</b> Number of red blood cells in the blood</p>
                  <p class="card-text text-muted"><b>Identifies:</b> Red blood cell disorders</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Fourth Row - Stats and Info Cards -->
          <div class="row my-3">
            <div class="col-lg-3 col-sm-6 my-2 text-center">
              <div class="card card-b shadow-lg border-light rounded-3">
                <div class="card-body">
                  <div class="info-1">
                    <h5 class="title text-primary">60</h5>
                  </div>
                  <div class="info-2">
                    <h5 class="card-title">Mins</h5>
                    <p class="card-text text-muted">Homes</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 my-2 text-center">
              <div class="card card-b shadow-lg border-light rounded-3">
                <div class="card-body">
                  <div class="info-1">
                    <h5 class="title text-primary">1M</h5>
                  </div>
                  <div class="info-2">
                    <h5 class="card-title">Happy</h5>
                    <p class="card-text text-muted">Customers</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 my-2 text-center">
              <div class="card card-b shadow-lg border-light rounded-3">
                <div class="card-body">
                  <div class="info-1">
                    <h5 class="title text-primary">4.9</h5>
                  </div>
                  <div class="info-2">
                    <h5 class="card-title">Google</h5>
                    <p class="card-text text-muted">Rating</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 my-2 text-center">
              <div class="card card-b shadow-lg border-light rounded-3">
                <div class="card-body">
                  <div class="info-1">
                    <h5 class="title text-primary"><i class="fa-solid fa-certificate"></i></h5>
                  </div>
                  <div class="info-2">
                    <h5 class="card-title">Certified</h5>
                    <p class="card-text text-muted">Labs</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="my-5">
        <div class="container">
          <div class="about-test">
            <h2 class="title">What is Red Blood Cell Count (RBC Count) Test</h2>
            <p>A Red Blood Cell test determines the total number of erythrocytes or red blood cells (RBCs) present in
              your blood. RBCs are produced in the bone marrow, the soft tissue inside large bones, and contain
              haemoglobin, an iron-rich protein essential for transporting oxygen. This oxygen supports cell growth,
              reproduction, and energy production, all necessary for your body to function. They also carry carbon
              dioxide, a waste product, back to your lungs to be exhaled.
              A healthy RBC count is crucial for your overall well-being. If you live in Bangalore, you can schedule an
              RBC test in Bangalore to help detect issues related to abnormal counts early, often before symptoms
              appear, allowing for prompt diagnosis and effective treatment.</p>
          </div>

          <div class="list-parameter">
            <h2 class="title">Red Blood Cell Count (RBC Count) Test Parameters</h2>
            <p>The Red Blood Cell test evaluates only one parameter: the total number of RBCs present in your blood
              sample.</p>
            <p>This test is typically included as part of a complete blood count (CBC), which measures the number of
              different types of cells in your blood. A small amount of your blood sample is required for testing. The
              process is instant, usually taking less than five minutes.</p>
          </div>

          <div class="test-preparation">
            <h2 class="title">Red Blood Cell Count (RBC Count) Test Preparation</h2>
            <p>Before undergoing a Red Blood Cell test, here are a few points to keep in mind:</p>
            <ul>
              <li><b>Prerequisites</b></li>
              <p>Fasting before getting an RBC test is not required.</p>
              <li><b>Best Time to Get Tested</b></li>
              <p>You can get this test done at any time throughout the day.</p>
              <li><b>Who Should Get an RBC Test?</b></li>
              <p>This test is often included in a CBC during routine checkups. It may also be needed to monitor
                treatments or investigate symptoms of abnormal red blood cell counts.</p>

              <li><b>Cautions Before Taking an RBC Test</b></li>
              <p>No special preparation is required for a Red Blood Cell test.</p>

            </ul>
          </div>

          <div class="why-test">
            <h2 class="title">Why Take the Red Blood Cell Count (RBC Count) Test?</h2>
            <p>Here are some key reasons why you might need the Red Blood Cell test in Bangalore:</p>
            <ul>
              <li><b>Routine health checkups:</b> To assess overall health as part of a complete blood count (CBC)
                during regular medical examinations.</li>
              <li><b>Diagnosing anaemia :</b>To detect anaemia, a condition caused by low levels of healthy red blood
                cells.</li>
              <li><b>Monitoring chronic conditions:</b> To assess the effects of health conditions such as chronic
                kidney disease that can affect red blood cell production.</li>

              <li><b>Evaluating symptoms :</b> To investigate symptoms which may indicate abnormal RBC levels.
                Indications of a low RBC count may include:
                <ul>
                  <li>Shortness of breath</li>
                  <li>Weakness or fatigue</li>
                  <li>Headache</li>
                  <li>Dizziness</li>
                  <li>Arrhythmia (trouble with the rate or rhythm of your heartbeat)</li>
                  <li>Pale skin</li>
                </ul>

              </li>

              <li>Indications of a high red blood cell count may include:
                <ul>
                  <li>Headache</li>
                  <li>Dizziness</li>
                  <li>Vision problems</li>
                  <li>Dizziness</li>
                  <li><b>Monitoring medical treatments :</b> To check the impact of treatments such as chemotherapy that
                    may affect blood cell counts.</li>

                </ul>

              </li>


            </ul>
          </div>
          <div class="faq-test">
            <h2 class="title">FAQs on Red Blood Cell Count (RBC Count) Test</h2>
            <div class="row my-5">
              <div class="col-lg-12 col-md-12 m-b30">
                <div class="dlab-accordion faq-1 box-sort-in m-b30" id="accordion1">
                  <!-- First three questions, always visible -->
                  <div class="panel">
                    <div class="acod-head">
                      <h6 class="acod-title">
                        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq1" class="collapsed"
                          aria-expanded="true">
                          1. What are the benefits of subscribing to a United Health Lumina health plan?</a>
                      </h6>
                    </div>
                    <div id="faq1" class="acod-body collapse" data-bs-parent="#accordion1">
                      <div class="acod-content">United Health Lumina's subscription plans offer a range of benefits,
                        including comprehensive coverage for outpatient department (OPD) services, in-patient treatment,
                        and preventive care, with flexible claim options.</div>
                    </div>
                  </div>
                  <div class="panel">
                    <div class="acod-head">
                      <h6 class="acod-title">
                        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq2" class="collapsed"
                          aria-expanded="false">
                          2. What makes United Health Lumina’s OPD plans unique?</a>
                      </h6>
                    </div>
                    <div id="faq2" class="acod-body collapse" data-bs-parent="#accordion1">
                      <div class="acod-content">United Health Lumina’s OPD-based health plans allow claims on outpatient
                        treatments, offering subscribers flexibility for medical consultations, diagnostics, and more
                        without needing hospitalization.</div>
                    </div>
                  </div>
                  <div class="panel">
                    <div class="acod-head">
                      <h6 class="acod-title">
                        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq3" class="collapsed"
                          aria-expanded="false">
                          3. Can I customize my health plan with United Health Lumina?</a>
                      </h6>
                    </div>
                    <div id="faq3" class="acod-body collapse" data-bs-parent="#accordion1">
                      <div class="acod-content">Yes, United Health Lumina provides customizable health plan options to
                        cater to specific medical needs, lifestyle requirements, and family size.</div>
                    </div>
                  </div>
                  <div id="hidden-faqs" style="display: none;">
                    <div class="panel">
                      <div class="acod-head">
                        <h6 class="acod-title">
                          <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq4"
                            class="collapsed" aria-expanded="false">
                            4. How are claims handled in United Health Lumina subscription plans?</a>
                        </h6>
                      </div>
                      <div id="faq4" class="acod-body collapse" data-bs-parent="#accordion1">
                        <div class="acod-content">United Health Lumina offers a streamlined claims process with flexible
                          reimbursement options, making it easier for members to claim expenses across OPD and
                          in-patient services.</div>
                      </div>
                    </div>
                    <div class="panel">
                      <div class="acod-head">
                        <h6 class="acod-title">
                          <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq5"
                            class="collapsed" aria-expanded="false">
                            5. Are there any wellness benefits included in United Health Lumina’s health plans?</a>
                        </h6>
                      </div>
                      <div id="faq5" class="acod-body collapse" data-bs-parent="#accordion1">
                        <div class="acod-content">Yes, United Health Lumina includes preventive health benefits like
                          routine check-ups, health screenings, and wellness programs to support overall well-being.
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <div class="acod-head">
                        <h6 class="acod-title">
                          <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq6"
                            class="collapsed" aria-expanded="false">
                            6. Is there a network of hospitals available for United Health Lumina subscribers?</a>
                        </h6>
                      </div>
                      <div id="faq6" class="acod-body collapse" data-bs-parent="#accordion1">
                        <div class="acod-content">United Health Lumina partners with a network of hospitals and clinics
                          to provide seamless access to quality healthcare services.</div>
                      </div>
                    </div>
                    <div class="panel">
                      <div class="acod-head">
                        <h6 class="acod-title">
                          <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq7"
                            class="collapsed" aria-expanded="false">
                            7. Can I add family members to my existing United Health Lumina Health Plan?</a>
                        </h6>
                      </div>
                      <div id="faq7" class="acod-body collapse" data-bs-parent="#accordion1">
                        <div class="acod-content">Yes, United Health Lumina allows you to add family members to your
                          plan, ensuring comprehensive coverage for your spouse, children, or other dependents.</div>
                      </div>
                    </div>
                  </div>


                  <div class="text-center mt-4">
                    <button class="site-button btnhover13 rounded" id="read-more-btn">Read More</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="section-rating">
        <div class="">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="sort-title clearfix text-center">

                  <h2 class="title">Customer <span class="text-primary">Google Rating</span></h2>
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
                      <p>Being the sole breadwinner, I was worried about my aging parents. UHL health plan provided the
                        ideal coverage with additional benefits like fastest claim settlement .</p>
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
                      <p>Choosing UHL HEALTH PLANS felt like an adventure. The website guided me smoothly and I was
                        thrilled with the ease of comparison. Cheers UHL. The website guided me smoothly</p>
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
                      <p>Having UHL heath plan which is so beneficial and the investment is also low. Service provided
                        is quick and on time. Online renewals are made so simple through online portal service.</p>
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
                      <p>I got the UHL Health Plan at a low cost, and the coverage is as high as promised. The service
                        is excellent, and their staff is available 24/7 to assist with any inquiries.</p>
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
                      <p>I’m securing my future by investing in the UHL Health Plan and opting for their retirement
                        health plans. In my opinion, it’s the best investment, as the policy covers 92% of my healthcare
                        needs.</p>
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
                      <p>The claims process is easy due to the fast service provided by their dedicated staff. Plus, it
                        offers tax-saving benefits, which is another great advantage. I'm very satisfied with it.</p>
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
                      <p>I purchased the UHL Health Plan, opting for their term health coverage. The premiums are
                        affordable, around Rs. 10K per year, making it a great option for my budget.</p>
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
                      <p>I have the UHL Health Plan for my family of four, and it has proven to be reliable with many
                        benefits and great returns on investment. The policy coverage is around 90%.</p>
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
                      <p>I’m securing my future by investing in the UHL Health Plan and opting for their retirement
                        health plans. In my opinion, it’s the best investment, as the policy covers 92% of my healthcare
                        needs.</p>
                    </div>
                    <div class="testimonial-detail"> <strong class="testimonial-name">Anil</strong> <span
                        class="testimonial-position">People</span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>
    </div>
  </div>
  <?php include("../includes/footer1.php") ?>
  <?php include("../includes/script1.php") ?>
</body>
<script type="text/javascript" src="../project-assets/js/all_test.js" defer></script>
<script>
  document.getElementById('read-more-btn').addEventListener('click', function () {
    const hiddenFaqs = document.getElementById('hidden-faqs');
    if (hiddenFaqs.style.display === 'none') {
      hiddenFaqs.style.display = 'block';
      this.textContent = 'Show Less';
    } else {
      hiddenFaqs.style.display = 'none';
      this.textContent = 'Read More';
    }
  });
</script>