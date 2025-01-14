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

    </style>
</head>


<body id="bg" style="z-index:10">
  <div class="page-wraper">
      <div id="loading-area"></div>
      <!-- header -->
       <?php include('../includes/header1.php'); ?>
        <div class="content-area bg-white main-area-testpage">  
           <sction class="banner-area-test-page  py-5" >
           	<!-- style="background-color: #d0d0d052; -->
               <div class="container" style="background-color: #8cc5e2; border-radius: 15px;">
			        <div class="row align-items-center">
			            <!-- Content Section -->
			            <div class="col-md-6 col-lg-6 text-center text-md-start">
			                <p><span class="test-banner-heading ms-3 mt-3">Our Popular Test</span></p>
			                <p class="test-banner-content ms-3 mt-3"></p>
			               
			            </div>

			            <!-- Image Section -->
			            <div class="col-md-6 col-lg-6 text-center">
			                <img src="../project-assets/images/generic-old-2.png" alt="test-desktop-banner" class="img-fluid rounded">
			            </div>
			        </div>
    			</div>
           </sction>   

          <section class="all_test_container py-4">
          	<div class="container">
          		<div class="row">
          		    <?php foreach ($all_test as $index => $test):
                        $baseprice=intval($test['TestFee']);
                        $off=0.16*$baseprice;
                        $totaloff=intval($baseprice+$off);
          		     ?>
          				<div class="col-md-6 col-lg-4 col-sm-12 my-2">
          				<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-12 upper-col">
										<div class="row upper-row">
											<div class="col-7">
												<div class="test-name my-4">
									             <p><b><?php echo $test['TestName']?> </b></p>
								                </div>
											</div>
											<div class="col-5">
												<div class="test-price-info my-4">
												<p style="font-size: 16px; font-weight: bold; margin: 0;">
											    <span style="color: #795548; text-decoration: line-through; margin-right: 10px;">&#8377; <?php echo  $totaloff?></span>
											    <span style="color: #fff; font-size: 18px; font-weight: bold;">&#8377; <?php echo $test['TestFee']?> </span>
											    <span class="dis-span">16% OFF</span>
											    </p>	

								 	        </div>
											</div>
										</div>
									</div>
								</div>

							<div class="row">
							    <div class="col-6 d-flex align-items-center">
							        <h4 class="me-2"><i class="fas fa-file-alt"></i></h4> <!-- File icon -->
							        <h4>Reports within </h4>
							    </div>
							    <div class="col-6 d-flex align-items-center justify-content-end">
							        <h4 class="me-2"><i class="fas fa-microscope"></i></h4> <!-- Microscope icon -->
							        <h4>1 tests  </h4>
							    </div>
							</div>

								<div class="row">
								    <div class="col-6 d-flex align-items-center">
								       
								        <h4><span>6 hours </span></h4>
								    </div>
								    <div class="col-6 d-flex align-items-center justify-content-end">
								       
								        <h4><span>included</span></h4>
								    </div>
								</div>

								<div class="row">
									<div class="col-6"><a class="cart-btn  btn btn-outline-warning btnhover13" href="./red-blood-cell-count-details">View Details</a></div>
									<div class="col-6"><button class="site-button cart-btn btnhover13" data-product-id="<?php echo $test['ID']?>" data-product-name="<?php echo $test['TestName']?>" data-product-price=" <?php echo $test['TestFee']?>">Add to cart</button></div>
								</div>
								
							</div>
						</div>
          			</div>
          			<?php endforeach ?>


          		</div>
          	</div>
      

				<section class="section-full bg-white content-inner my-2"> 
						<div class="newbie-sec happy-mem-sect py-4" style="background-color:#8cc5e23d">
						    <div class="container page-container">
						        <div class="row mt-4">
						            <!-- Image Section -->
						               <div class="col-md-4 d-flex justify-content-center align-items-center mb-4 mb-md-0">
						                <div class="">
						                    <div class="row">
						                    	<h2 class="title">Health Checks for Key <span class="text-primary">Organs</span></h2>
						                    </div>
						                    <div class="row">
						                    	<p>Discover our extensive suite of diagnostic tests designed specifically for vital body organs. These specialized tests are aimed at assessing the health and functionality of your essential organs, providing you with the insights and care you need to maintain optimal health.</p>
						                    </div>
						                </div> 
						            </div>

						            <!-- Cards Section -->
						            <div class="col-md-8">
						                <div class="row" style="margin-bottom: 2.5em;">
						                    <!-- Card 1 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                   <img src="../project-assets/images/test/heart.png" style="height:4em">
						                                    <h4 class="title">Heart</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 2 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                    <img src="../project-assets/images/test/kidney.png" style="height:4em">
						                                    <h4 class="title">Kidney</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 3 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                   <img src="../project-assets/images/test/liver.png" style="height:4em">
						                                    <h4 class="title">Liver</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 4 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="./contact-us">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                    <img src="../project-assets/images/test/fracture.png" style="height:4em">
						                                    <h4 class="title">Bone</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 5 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                     <img src="../project-assets/images/test/supplement.png" style="height:4em">
						                                    <h4 class="title">Vitamin</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 6 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                     <img src="../project-assets/images/test/hormones.png" style="height:4em">
						                                    <h4 class="title">Hormones</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                     <img src="../project-assets/images/test/gut-microbiota.png" style="height:4em">
						                                    <h4 class="title">Gut Health</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                     <img src="../project-assets/images/test/blood.png" style="height:4em">
						                                    <h4 class="title">Blood</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                     <img src="../project-assets/images/test/reph.png" style="height:4em">
						                                    <h4 class="title">Reproductive Organs</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>
						                </div>
						            </div>
						         
						        </div>
						    </div>
						</div>
				</section>

                   
				<section class="section-full bg-white content-inner"> 
						<div class="newbie-sec happy-mem-sect py-4" style="background-color:#ffff; margin-top:-5em">
						    <div class="container page-container">
						        <div class="row mt-4">
						            <!-- Image Section -->	              
						            <!-- Cards Section -->
						            <div class="col-md-8">
						                <div class="row">
						                    <!-- Card 1 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                   <img src="../project-assets/images/test/Women-Health.png" style="height:4em">
						                                    <h4 class="title">Women Health</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 2 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                    <img src="../project-assets/images/test/Lifestyle-Checkup.png" style="height:4em">
						                                    <h4 class="title">Lifestyle Checkup</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 3 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                   <img src="../project-assets/images/test/Cancer-Checkup.png" style="height:4em">
						                                    <h4 class="title">Cancer Checkup</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 4 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="./contact-us">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                    <img src="../project-assets/images/test/Senior.png" style="height:4em">
						                                    <h4 class="title">Senior Citizen</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 5 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                     <img src="../project-assets/images/test/Full-Body-Checkups.png" style="height:4em">
						                                    <h4 class="title">Full Body Checkups</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>

						                    <!-- Card 6 -->
						                    <div class="col-6 col-md-4 col-sm-6 mt-2">
						                        <a href="../../admin/authentication/login">
						                            <div class="card text-center h-100">
						                                <div class="card-body">
						                                     <img src="../project-assets/images/test/Diabetes.png" style="height:4em">
						                                    <h4 class="title">Diabetes Checkup</h4>
						                                </div>
						                            </div>
						                        </a>
						                    </div>
						                </div>
						            </div>

						             <div class="col-md-4 d-flex">
						                <div class="">
						                    <div class="row">
						                    	<h2 class="title">Prioritize Your Wellness with<span class="text-primary"> Personalized Care</span></h2>
						                    </div>
						                    <div class="row">
						                    	<p>Our customized health checkups are designed to meet your unique needs, focusing on your lifestyle, age, and medical history. Discover a tailored approach to preventive healthcare.</p>
						                    </div>
						                </div> 
						            </div>
						         
						        </div>
						    </div>
						</div>
				</section>


				</section>  
			 <section class="my-3">
			  <div class="container mb-3">
			        <div class="row">
			            <div class="col-md-12">
			                <div class="card gradient-bg">
			                    <div class="card-header gradient-bg mb-3" style="margin-bottom: 3em;">
			                        <h2 class="title">Looking to buy a new life <span class="text-primary">Health Test?</span></h2>
			                        <p>Our experts are happy to help you!</p>
			                    </div>
			                    <div class="card-body">
			                        <form id="tte-review-form">
			                            <div class="row mb-3">
			                                <div class="col-md-3">
			                                    <label for="needformName" class="form-label">Name</label>
			                                    <input type="text" class="form-control" id="needformName" name="needformName"  placeholder="Enter full name" required>
			                                    <div class="invalid-feedback">Please enter your name.</div>
			                                </div>
			                                <div class="col-md-3">
			                                    <label for="needformMobile" class="form-label">Mobile No.</label>
			                                    <div class="input-group">
			                                        <span class="input-group-text">+91</span>
			                                        <input type="tel" class="form-control" id="needformMobile" name="needformMobile" placeholder="Enter mobile number" maxlength="10" required>
			                                        <div class="invalid-feedback">Please enter your mobile number.</div>
			                                    </div>
			                                </div>
			                                <div class="col-md-3">
			                                    <label for="planSelect" class="">Plan</label>
			                                    <select class="form-control" id="planSelect" name="planSelect" required>
			                                        <option value="" selected disabled>Select Test</option> 
			                                        <option value="Complete Blood Count (CBC) with ESR">
			                                        Complete Blood Count (CBC) with ESR</option>
			                                        <option value="Complete Blood Count (CBC) with ESR">Complete Blood Count (CBC) with ESR</option>
			                                        <option value="I don't know/I need help">I don't know/I need help</option>
			                                    </select>
			                                    <div class="invalid-feedback">Please select a Test.</div>
			                                </div>
			                                <div class="col-md-3">
			                                    <br>
			                                    <div class="input-group mt-2 d-flex justify-content-between align-items-center w-100">
												    <button type="submit" class="btn site-button appointment-btn btnhover13 btn-rounded" onclick="Submitenquiry(event)">Get a Call Back</button>
												    <img src="../project-assets/images/whatsapp.png" style="width:50px; height:auto; cursor: pointer;" onclick="alert('Comming soon....')">
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
			</section>
			<section class="section-full my-2"> 
						<div class="newbie-sec happy-mem-sect py-4" style="background-color:#8cc5e23d">
						    <div class="container page-container">
						        <div class="row mt-4">
						      <div class="row">
						<div class="col-lg-12 col-md-12 m-b30">
							<div class="dlab-accordion faq-1 box-sort-in m-b30" id="accordion1">
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq1" class="collapsed" aria-expanded="true">
											1. What are the benefits of subscribing to a United Health Lumina health plan?</a> </h6>
									</div>
									<div id="faq1" class="acod-body collapse" data-bs-parent="#accordion1">
										<div class="acod-content">United Health Lumina's subscription plans offer a range of benefits, including comprehensive coverage for outpatient department (OPD) services, in-patient treatment, and preventive care, with flexible claim options.</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq2" class="collapsed" aria-expanded="false">
											2. What makes United Health Lumina’s OPD plans unique?</a> </h6>
									</div>
									<div id="faq2" class="acod-body collapse" data-bs-parent="#accordion1">
										<div class="acod-content">United Health Lumina’s OPD-based health plans allow claims on outpatient treatments, offering subscribers flexibility for medical consultations, diagnostics, and more without needing hospitalization	.</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a href="javascript:void(0);" data-bs-toggle="collapse"  data-bs-target="#faq3" class="collapsed" aria-expanded="false">
											3. Can I customize my health plan with United Health Lumina? </a> </h6>
									</div>
									<div id="faq3" class="acod-body collapse"  data-bs-parent="#accordion1">
										<div class="acod-content"> Yes, United Health Lumina provides customizable health plan options to cater to specific medical needs, lifestyle requirements, and family size.
										</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a href="javascript:void(0);" data-bs-toggle="collapse"  data-bs-target="#faq4" class="collapsed" aria-expanded="false">
											4.How are claims handled in United Health Lumina subscription plans? </a> </h6>
									</div>
									<div id="faq4" class="acod-body collapse" data-bs-parent="#accordion1">
										<div class="acod-content">United Health Lumina offers a streamlined claims process with flexible reimbursement options, making it easier for members to claim expenses across OPD and in-patient services.</div>
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