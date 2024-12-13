<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/meta.php") ?>
    <?php include("includes/links.php") ?>
    <title>UHL</title>  
<link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

<style>

  
  .upper-bnr{
    border-radius: 10%;
    margin-top: -3rem;
   
  }
  .upper-bnr img{
     border-radius: 1%;
  }

  /* Card default appearance */
.section-full .card {
  border: 1px solid transparent; 
  transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional initial shadow */
}


.section-full .card:hover {
  border-color: #28a745; 
  transform: translateY(-10px) scale(1.05); 
  box-shadow: 0 8px 16px rgba(0, 128, 0, 0.3); 
}

/
.section-full .card-body i {
  color: #007bff; 
  transition: color 0.3s ease;
}


.section-full .card:hover .card-body i {
  color: #28a745; 
}

.section-full .card {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
  transition: transform 0.2s;
}

.section-full .card:hover {
  transform: translateY(-5px); 
}

.section-full .card-body i {
  color: #007bff;
}

 .gradient-bg {
            background: linear-gradient(to bottom right, #ffffff, #d4edda); /* White to light green */
            border-radius: 8px; /* Optional: rounded corners */
            padding: 20px; /* Optional: padding for the card */
        }

        .title {
            margin: 0; /* Optional: remove margin for the title */
        }

        .appointment-btn {
            width: 100%; /* Make the button full width */
        }

@media (max-width: 767.98px) {
    .nav-tabs {
        display: none;
    }
}


 
</style>

</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
  <!-- header -->
  <?php include('includes/header.php'); ?>

<!-- header END -->

    <!-- header END -->
    <!-- Content -->
    <div class="page-content bg-white">
    <!-- Main Slider -->
        <div class="dz-industry-zone">
      <div class="position-absolute dz-social-icon">
        <!-- <ul>
          <li><a target="_blank" href="https://www.instagram.com">INSTAGRAM</a></li>
          <li><a target="_blank" href="https://www.facebook.com">FACEBOOK</a></li>
          <li><a target="_blank" href="https://twitter.com">TWITTER</a></li>
        </ul> -->
      </div>
      <div class="container ">
        <div class="row">
         <div class="col-12">
                    <div class="dz-media upper-bnr">
                        <img src="project-assets/images/banner/bnruhl1.png" alt="#">
                      </div>



          </div>
        </div>
        <div class="row">
            <!-- About Us -->
      <div class="section-full content-inner bg-white">
  <div class="container">
    <!-- Heading in the middle -->
    <h2 class="title text-center">Popular <span class="text-primary">Categories</span></h2>
    
    <div class="row">
      <!-- Card 1 -->
   <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="flaticon-robot-arm fa-3x mb-3"></i>
                        <h4 class="card-title">Platinum Health Plan</h4>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="flaticon-factory-1 fa-3x mb-3"></i>
                        <h4 class="card-title">Gold Health Plan</h4>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="flaticon-fuel-station fa-3x mb-3"></i>
                        <h4 class="card-title">Silver Health Plan</h4>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="flaticon-engineer-1 fa-3x mb-3"></i>
                        <h4 class="card-title">Catastrophic Health Plan</h4>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="flaticon-conveyor-1 fa-3x mb-3"></i>
                        <h4 class="card-title">Bronze Health Plan</h4>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="flaticon-engineer-1 fa-3x mb-3"></i>
                        <h4 class="card-title">Platinum Health Plan</h4>
                    </div>
                </div>
            </div>

    </div>
  </div>
</div>

      <!-- About Us End -->

        </div>
      </div>
  
    </div>
     <section class="section-full bg-white content-inner">
    <div class="container" style="margin-top: -4rem;">
        <div class="mt-2">
            <h2 class="title text-center">Types of <span class="text-primary">Health Plan</span></h2>
        </div>
        
        <!-- Tabs for Desktop -->
        <div class="dz-bannerlist d-none d-md-block">
            <ul class="nav nav-tabs dz-bannerlist d-flex justify-content-space-evenly" id="insuranceTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="term-plans-tab" data-bs-toggle="tab" href="#term-plans" role="tab" aria-controls="term-plans" aria-selected="true">Health Plans</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="savings-plans-tab" data-bs-toggle="tab" href="#savings-plans" role="tab" aria-controls="savings-plans" aria-selected="false">Health Plans</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ulip-plans-tab" data-bs-toggle="tab" href="#ulip-plans" role="tab" aria-controls="ulip-plans" aria-selected="false">Health Plans</a>
                </li>
            </ul>
        </div>
        
        <!-- Accordion for Mobile -->
        <div class="accordion d-md-none" id="insuranceAccordion">
            <!-- Term Plans Accordion Item -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Health Plans
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#insuranceAccordion">
                    <div class="accordion-body">
                        <!-- Term Plans Content -->
                        <div class="row">
                            <div class="col-md-4">
                                <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="Term Plans">
                            </div>
                            <div class="col-md-8">
                                <h3>Term Plans</h3>
                                <p>A <a href="/life-insurance-plans/term-insurance.html" class="text-primary fw-bold"><u>term insurance plan</u></a> helps you secure the future of your loved ones and shields your family from uncertainties in life. With a term insurance plan, one can get a large life cover (Sum Assured) at a lower premium. In case of an unfortunate event such as the death of the life assured, the nominee is paid the sum assured as pre-defined in the policy.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Get Life Cover</h4>
                                        <p>Provides Life Cover against uncertainties of Life.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Tax Benefits</h4>
                                        <p><a href="/blogs/life-insurance/know-the-tax-benefits-of-insurance-policies.html" class="text-primary fw-bold"><u>Get Tax Benefits</u></a> as per applicable tax laws.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mt-3">
                                    <a href="#" class="btn site-button appointment-btn btnhover13 btn-rounded">Calculate Premium</a>
                                    <a href="/life-insurance-plans/term-insurance.html" class="btn btn-outline-success">Know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Savings Plans Accordion Item -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Health Plans
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#insuranceAccordion">
                    <div class="accordion-body">
                        <!-- Savings Plans Content -->
                        <div class="row">
                            <div class="col-md-4">
                                <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="Savings Plans">
                            </div>
                            <div class="col-md-8">
                                <h3>Savings Plans</h3>
                                <p>Savings plans are <a href="/life-insurance-plans.html" class="text-primary fw-bold"><u>insurance plans</u></a> that combine the benefits of protection and savings. With a term insurance plan, one can get a large life cover (Sum Assured) at a lower premium. In case of an unfortunate event such as the death of the life assured, the nominee is paid the sum assured as pre-defined in the policy.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Guaranteed Returns</h4>
                                        <p>With a savings plan, you can <a href="/life-insurance-plans/savings-solutions/guaranteed-return-insurance-plan.html" class="text-primary fw-bold"><u>get guaranteed returns</u></a>.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Rider Options</h4>
                                        <p>You can increase the coverage of your policy by adding additional riders.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mt-3">
                                    <a href="#" class="btn site-button appointment-btn btnhover13 btn-rounded">Calculate Premium</a>
                                    <a href="/life-insurance-plans/savings-solutions.html" class="btn btn-outline-success">Know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ULIP Plans Accordion Item -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Health Plans
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#insuranceAccordion">
                    <div class="accordion-body">
                        <!-- ULIP Plans Content -->
                        <div class="row">
                            <div class="col-md-4">
                                <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="ULIP Plans">
                            </div>
                            <div class="col-md-8">
                                <h3>ULIP Plans</h3>
                                <p>ULIP plans combine insurance with investments to give policyholders the benefit of wealth accumulation along with protection. With a term insurance plan, one can get a large life cover (Sum Assured) at a lower premium. In case of an unfortunate event such as the death of the life assured, the nominee is paid the sum assured as pre-defined in the policy.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Investment Options</h4>
                                        <p>Invest in funds as per your risk appetite.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Wealth Creation</h4>
                                        <p>Potential for wealth creation over the long term.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mt-3">
                                    <a href="#" class="btn site-button appointment-btn btnhover13 btn-rounded">Calculate Premium</a>
                                    <a href="/life-insurance-plans/ulip-insurance.html" class="btn btn-outline-success">Know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Content for Desktop -->
        <div class="tab-content mt-4 d-none d-md-block" id="insuranceTabContent">
            <!-- Term Plans Content -->
            <div class="tab-pane fade show active" id="term-plans" role="tabpanel" aria-labelledby="term-plans-tab">
                <!-- (same content as inside accordion) -->
                 <!-- Term Plans Content -->
                        <div class="row">
                            <div class="col-md-4">
                                <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="Term Plans">
                            </div>
                            <div class="col-md-8">
                                <h3>Term Plans</h3>
                                <p>A <a href="/life-insurance-plans/term-insurance.html" class="text-primary fw-bold"><u>term insurance plan</u></a> helps you secure the future of your loved ones and shields your family from uncertainties in life. With a term insurance plan, one can get a large life cover (Sum Assured) at a lower premium. In case of an unfortunate event such as the death of the life assured, the nominee is paid the sum assured as pre-defined in the policy.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Get Life Cover</h4>
                                        <p>Provides Life Cover against uncertainties of Life.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Tax Benefits</h4>
                                        <p><a href="/blogs/life-insurance/know-the-tax-benefits-of-insurance-policies.html" class="text-primary fw-bold"><u>Get Tax Benefits</u></a> as per applicable tax laws.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mt-3">
                                    <a href="#" class="btn site-button appointment-btn btnhover13 btn-rounded">Calculate Premium</a>
                                    <a href="/life-insurance-plans/term-insurance.html" class="btn btn-outline-success">Know More</a>
                                </div>
                            </div>
                        </div>
            </div>

            <!-- Savings Plans Content -->
            <div class="tab-pane fade" id="savings-plans" role="tabpanel" aria-labelledby="savings-plans-tab">
                <!-- (same content as inside accordion) -->
                <!-- Savings Plans Content -->
                        <div class="row">
                            <div class="col-md-4">
                                <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="Savings Plans">
                            </div>
                            <div class="col-md-8">
                                <h3>Savings Plans</h3>
                                <p>Savings plans are <a href="/life-insurance-plans.html" class="text-primary fw-bold"><u>insurance plans</u></a> that combine the benefits of protection and savings. With a term insurance plan, one can get a large life cover (Sum Assured) at a lower premium. In case of an unfortunate event such as the death of the life assured, the nominee is paid the sum assured as pre-defined in the policy.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Guaranteed Returns</h4>
                                        <p>With a savings plan, you can <a href="/life-insurance-plans/savings-solutions/guaranteed-return-insurance-plan.html" class="text-primary fw-bold"><u>get guaranteed returns</u></a>.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Rider Options</h4>
                                        <p>You can increase the coverage of your policy by adding additional riders.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mt-3">
                                    <a href="#" class="btn site-button appointment-btn btnhover13 btn-rounded">Calculate Premium</a>
                                    <a href="/life-insurance-plans/savings-solutions.html" class="btn btn-outline-success">Know More</a>
                                </div>
                            </div>
                        </div>
            </div>

            <!-- ULIP Plans Content -->
            <div class="tab-pane fade" id="ulip-plans" role="tabpanel" aria-labelledby="ulip-plans-tab">
                <!-- (same content as inside accordion) -->
                <!-- ULIP Plans Content -->
                        <div class="row">
                            <div class="col-md-4">
                                <img src="project-assets/images/plan/dummyplan.png" class="img-fluid" alt="ULIP Plans">
                            </div>
                            <div class="col-md-8">
                                <h3>ULIP Plans</h3>
                                <p>ULIP plans combine insurance with investments to give policyholders the benefit of wealth accumulation along with protection. With a term insurance plan, one can get a large life cover (Sum Assured) at a lower premium. In case of an unfortunate event such as the death of the life assured, the nominee is paid the sum assured as pre-defined in the policy.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Investment Options</h4>
                                        <p>Invest in funds as per your risk appetite.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Wealth Creation</h4>
                                        <p>Potential for wealth creation over the long term.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mt-3">
                                    <a href="#" class="btn site-button appointment-btn btnhover13 btn-rounded">Calculate Premium</a>
                                    <a href="/life-insurance-plans/ulip-insurance.html" class="btn btn-outline-success">Know More</a>
                                </div>
                            </div>
                        </div>

            </div>
        </div>
    
</section>




    </div>



 <section class="section-full bg-white content-inner">
  <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card gradient-bg">
                    <div class="card-header gradient-bg">
                        <h2 class="title">Looking to buy a new life <span class="text-primary">Health plan?</span></h2>
                        <p>Our experts are happy to help you!</p>
                    </div>
                    <div class="card-body">
                        <form id="tte-review-form">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="needformName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="needformName" placeholder="Enter full name" required>
                                    <div class="invalid-feedback">Please enter your name.</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="needformMobile" class="form-label">Mobile No.</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+91</span>
                                        <input type="tel" class="form-control" id="needformMobile" placeholder="Enter mobile number" maxlength="10" required>
                                        <div class="invalid-feedback">Please enter your mobile number.</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="planSelect" class="">Plan</label>
                                    <select class="form-control" id="planSelect" required>
                                        <option selected disabled>Select plan</option>
                                        <option value="Term plans">Term plans</option>
                                        <option value="Saving plans">Saving plans</option>
                                        <option value="Retirement plans">Retirement plans</option>
                                        <option value="Wealth plans">Wealth plans</option>
                                        <option value="I don't know/I need help">I don't know/I need help</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a plan.</div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="input-group mt-2">
                                        <button type="submit" class="btn site-button appointment-btn btnhover13 btn-rounded">Get a Call Back</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-text">
                            UHL Plan Ltd will send you updates on your policy, new products & services, insurance solutions, or related information. Select here to opt-in.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</section>


    <!-- Main Slider -->
        <!-- contact area -->
        <div class="content-block">
      <!-- About Company -->
      <div class="section-full bg-gray content-inner about-carousel-ser">
        <div class="container">
          <div class="section-head text-center">
            <h2 class="title">Clients & <span class="text-primary">Partnerships</span></h2>
            <p>Partnering for Excellence in Healthcare.Together, we deliver outstanding care and innovative solutions.</p>
          </div>
          <div class="about-ser-carousel owl-carousel owl-theme owl-btn-center-lr owl-dots-primary-full owl-btn-3 m-b30 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
            <div class="item">
              <div class="dlab-box service-media-bx">
                <div class="dlab-media"> 
                  <a href="about-1.html"><img src="project-assets/images/client-partership/3.webp" class="lazy" data-src="project-assets/images/client-partership/3.webp" alt=""></a> 
                </div>
                
              </div>
            </div>
            <div class="item">
              <div class="dlab-box service-media-bx">
                <div class="dlab-media"> 
                  <a href="about-1.html"><img src="project-assets/images/client-partership/7.webp" class="lazy" data-src="project-assets/images/client-partership/7.webp" alt=""></a> 
                </div>
                
              </div>
            </div>
            <div class="item">
              <div class="dlab-box service-media-bx">
                <div class="dlab-media"> 
                  <a href="about-1.html"><img src="project-assets/images/client-partership/6.webp" class="lazy" data-src="project-assets/images/client-partership/6.webp" alt=""></a> 
                </div>
                
              </div>
            </div>
          </div>
        </div>  
      </div>
      <!-- About Company END -->
      <!-- Our Projects  -->
      <div class="section-full bg-img-fix content-inner-2 overlay-black-dark contact-action style2" style="background-image:url(project-assets/images/background/.jpg);">
        <div class="container">
          <div class="row relative">
            <div class="col-md-12 col-lg-8 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.2s">
              <div class="contact-no-area">
                <h2 class="title">Your Health, Our Priority</h2>
                <div class="contact-no">
                  <div class="contact-left">
                    <h3 class="no"><i class="sl-call-in"></i><a href="tel:+4733378901" class="text-primary">123-456-7890</a></h3>
                  </div>
                  <div class="contact-right">
                    <a href="contact-4.html" class="site-button appointment-btn btnhover13">Book Your Health Consultation Today</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-4 contact-img-bx wow fadeInRight relative" data-wow-duration="2s" data-wow-delay="0.2s">
              <img src="project-assets/images/doctor-7.png" alt="" class="h-150">  
            </div>
          </div>
        </div>
      </div>
      <!-- Our Projects END -->
     <div class="section-full content-inner">
  <div class="container">
    <div class="section-head text-center">
      <h2 class="title">Our Latest <span class="text-primary">Plans</span></h2>
      <p>There are many variations of passages of Lorem Ipsum typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
    </div>
<section class="section" id="pricing">
    
<?php include('new-plan-lunch.php') ?>
   
</section>
  
  </div>
      </div>
      <!-- Our Services End -->
      <!-- Company staus -->
      <div class="section-full text-white bg-img-fix content-inner overlay-black-dark counter-staus-box" style="background-image:url(project-assets/images/background/.jpg);">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.2s">
              <div class="section-head text-white">
                <a href="https://www.youtube.com/watch?v=_FRZVScwggM" class="popup-youtube video play-btn"><span><i class="fas fa-play"></i></span>Play Now</a>
                <h2 class="title">We're Enhancing Health with Every Service Plan</h2>
              </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
              <div class="row sp20">
                <div class="col-md-4 col-sm-4 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                  <div class="icon-bx-wraper center counter-style-5">
                    <div class="icon-xl m-b20">
                      <span class="icon-cell"><img src="project-assets/images/icon/HAPPY-CLIENT.png"  ></span>
                    </div>
                    <div class="icon-content">
                      <div class="dlab-separator bg-primary"></div>
                      <h2 class="dlab-tilte counter">1226</h2>
                      <p>Happy Client</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                  <div class="icon-bx-wraper center counter-style-5">
                    <div class="icon-xl m-b20">
                      <span class="icon-cell"><img src="project-assets/images/icon/DOCTORS-HAND.png"  ></span>
                    </div>
                    <div class="icon-content">
                      <div class="dlab-separator bg-primary"></div>
                      <h2 class="dlab-tilte counter">1552</h2>
                      <p>Doctors Hand</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
                  <div class="icon-bx-wraper center counter-style-5">
                    <div class="icon-xl m-b20">
                      <span class="icon-cell"><img src="project-assets/images/icon/ACTIVE-PLANS.png"  ></span>
                    </div>
                    <div class="icon-content">
                      <div class="dlab-separator bg-primary"></div>
                      <h2 class="dlab-tilte counter">1156</h2>
                      <p>Active Plans</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Company staus End -->
      <!-- Team member -->
      <div class="section-full bg-gray content-inner">
        <div class="container">
          <div class="section-head text-center ">
            <!-- <h2 class="title"> Meet The Team</h2> -->
            <h2 class="title">Meet Our <span class="text-primary">Doctors</span></h2>
            <p>Discover our team of expert doctors dedicated to providing top-notch care. With diverse specialties and years of experience, they are here to ensure your health and well-being.</p>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
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
      </div>
      <!-- Team member End -->
      <!-- Testimonials blog -->
      <div class="section-full overlay-black-middle bg-secondry content-inner-2 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s" style="background-image:url(project-assets/images/background/map-bg.png);">
        <div class="container">
          <div class="section-head text-white text-center">
            <h2 class="title">What People Are Saying</h2>
            <p>There are many variations of passages of Lorem Ipsum typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
          </div>
          <div class="section-content">
            <div class="testimonial-two-dots owl-carousel owl-none owl-theme owl-dots-primary-full owl-loaded owl-drag">
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic3.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic2.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic1.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic3.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic1.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic2.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic1.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic2.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-15 text-white">
                  <div class="testimonial-text quote-left quote-right">
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make.</p>
                  </div>
                  <div class="testimonial-detail clearfix">
                    <div class="testimonial-pic radius shadow"><img src="project-assets/images/testimonials/pic3.jpg" width="100" height="100" alt=""></div>
                    <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Testimonials blog End -->
      <!-- Latest blog -->
      <div class="section-full content-inner bg-gray wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
        <div class="container">
          <div class="section-head text-center">
            <h2 class="title">Latest blog post</h2>
            <p>There are many variations of passages of Lorem Ipsum typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
          </div>
          <div class="blog-carousel owl-none owl-carousel">
            <div class="item">
              <div class="blog-post post-style-1">
                <div class="dlab-post-media dlab-img-effect rotate">
                  <a href="blog-single.html"><img src="project-assets/images/blog/latest-blog/pic1.jpg" alt=""></a>
                </div>
                <div class="dlab-post-info">
                  <div class="dlab-post-meta">
                    <ul>
                      <li class="post-date"> <strong>10 Aug</strong> <span> 2016</span> </li>
                      <li class="post-author"> By <a href="blog-single.html">demongo</a> </li>
                    </ul>
                  </div>
                  <div class="dlab-post-title">
                    <h3 class="post-title"><a href="blog-single.html">Why You Should Not Go To Industry</a></h3>
                  </div>
                  <div class="dlab-post-readmore">
                    <a href="blog-single.html" title="READ MORE" rel="bookmark" class="site-button btnhover13">READ MORE</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="blog-post post-style-1">
                <div class="dlab-post-media dlab-img-effect rotate">
                  <a href="blog-single.html"><img src="project-assets/images/blog/latest-blog/pic2.jpg" alt=""></a>
                </div>
                <div class="dlab-post-info">
                  <div class="dlab-post-meta">
                    <ul>
                      <li class="post-date"> <strong>10 Aug</strong> <span> 2016</span> </li>
                      <li class="post-author"> By <a href="blog-single.html">AARON</a> </li>
                    </ul>
                  </div>
                  <div class="dlab-post-title ">
                    <h3 class="post-title"><a href="blog-single.html">Seven Doubts You Should Clarify About</a></h3>
                  </div>
                  <div class="dlab-post-readmore">
                    <a href="blog-single.html;" title="READ MORE" rel="bookmark" class="site-button btnhover13">READ MORE</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="blog-post post-style-1">
                <div class="dlab-post-media dlab-img-effect rotate"> 
                  <a href="blog-single.html"><img src="project-assets/images/blog/latest-blog/pic3.jpg" alt=""></a>
                </div>
                <div class="dlab-post-info">
                  <div class="dlab-post-meta">
                    <ul>
                      <li class="post-date"> <strong>10 Aug</strong> <span> 2016</span> </li>
                      <li class="post-author"> By <a href="blog-single.html">VICTORIA</a> </li>
                    </ul>
                  </div>
                  <div class="dlab-post-title">
                    <h3 class="post-title"><a href="blog-single.html">Seven Outrageous Ideas Industry</a></h3>
                  </div>
                  <div class="dlab-post-readmore">
                    <a href="blog-single.html" title="READ MORE" rel="bookmark" class="site-button btnhover13">READ MORE</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
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
    <?php include("includes/footer.php") ?>
    <?php include("includes/script.php") ?>
</body>
</html>