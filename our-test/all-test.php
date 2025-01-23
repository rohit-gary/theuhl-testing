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
		/* Modern Color Schemes - Choose one of these gradient options */

		/* Option 1: Professional Blue-Purple Gradient */
		:root {
			--primary-gradient: linear-gradient(135deg, #2c3e50, #3498db);
		}

		/* Option 2: Modern Medical Blue Gradient */
		:root {
			--primary-gradient: linear-gradient(135deg, #235789, #29A0B1);
		}

		/* Option 3: Sophisticated Teal Gradient */
		:root {
			--primary-gradient: linear-gradient(135deg, #136a8a, #267871);
		}

		/* Option 4: Premium Dark Blue Gradient */
		:root {
			--primary-gradient: linear-gradient(135deg, #1e3c72, #2a5298);
		}

		/* Option 5: Modern Corporate Gradient */
		:root {
			--primary-gradient: linear-gradient(135deg, #24C6DC, #514A9D);
		}

		/* Rest of your existing CSS remains the same, just update the root variables below */
		:root {
			/* Choose one of the gradients above and use it here */
			--primary-gradient: linear-gradient(135deg, #235789, #29A0B1);
			/* Currently using Option 2 */
			--primary-color: #235789;
			--secondary-color: #29A0B1;
			--accent-color: #f8f9fa;
			--text-dark: #2c3e50;
			--text-light: #ffffff;
			--shadow-sm: 0 2px 4px rgba(35, 87, 137, 0.05);
			--shadow-md: 0 4px 6px rgba(35, 87, 137, 0.1);
			--shadow-lg: 0 10px 20px rgba(35, 87, 137, 0.1);
			--border-radius: 15px;
			--transition: all 0.3s ease;
		}

		/* Updated styles for better contrast and professionalism */
		.test-card .upper-col {
			background: var(--primary-gradient);
			position: relative;
			overflow: hidden;
		}

		.test-card .upper-col::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), transparent);
		}

		.test-price-info {
			background: rgba(255, 255, 255, 0.15);
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.dis-span {
			background: #28a745;
			background: linear-gradient(135deg, #28a745, #20c997);
		}

		.cart-btn.btn-primary {
			background: var(--primary-gradient);
			border: none;
			position: relative;
			overflow: hidden;
		}

		.cart-btn.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: var(--shadow-md);
		}

		.cart-btn.btn-outline-warning {
			color: var(--primary-color);
			border-color: var(--primary-color);
		}

		.cart-btn.btn-outline-warning:hover {
			background: var(--primary-gradient);
			border-color: transparent;
			color: white;
		}

		/* Updated organ card styling */
		.organ-card {
			border: 1px solid rgba(35, 87, 137, 0.1);
		}

		.organ-card:hover {
			border-color: var(--primary-color);
		}

		/* Section background update */
		.section-highlight::before {
			background: linear-gradient(45deg,
					rgba(35, 87, 137, 0.05) 0%,
					rgba(41, 160, 177, 0.1) 100%);
		}

		/* Title styling update */
		.title span.text-primary {
			background: var(--primary-gradient);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			position: relative;
		}

		/* Info icons color update */
		.info-row i {
			color: var(--primary-color);
			opacity: 0.9;
		}
	</style>
</head>


<body id="bg" style="z-index:10">
	<div class="page-wraper">
		<div id="loading-area"></div>
		<!-- header -->
		<?php include('../includes/header1.php'); ?>
		<div class="content-area bg-white main-area-testpage">
			<section class="
			">
				<div class="container"
					style="background: linear-gradient(135deg, #8cc5e2, #5f9dc7); border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
					<div class="row align-items-center">
						<!-- Content Section -->
						<div class="col-md-6 col-lg-6 text-center text-md-start p-5">
							<h1 class="test-banner-heading mb-4" style="color: #fff; font-weight: 700;">
								Our Health Test<br>
								<span style="font-size: 0.8em; font-weight: 500;">आपकी सेहत, हमारी प्राथमिकता</span>
							</h1>
							<p class="test-banner-content" style="color: #fff; font-size: 1.2em;">
								आपकी सेहत, हमारी प्राथमिकता<br>
								<span style="font-size: 0.9em;">Your Health, Our Priority</span>
							</p>
							<p class="mt-4" style="color: #fff; font-size: 1.1em;">
								विश्वसनीय जांच, सटीक परिणाम<br>
								<span style="font-size: 0.9em;">Reliable Testing, Accurate Results</span>
							</p>
						</div>

						<!-- Image Section -->
						<div class="col-md-6 col-lg-6 text-center p-4">
							<img src="../project-assets/images/generic-old-2.png" alt="test-desktop-banner" class="img-fluid rounded"
								style="box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
						</div>
					</div>
				</div>
			</section>

			<style>
				/* Global Styles */
				.all_test_container {
					background-color: #f8f9fa;
					padding: 3rem 0;
				}

				/* Test Card Styles */
				.test-card {
					transition: var(--transition);
					border: none;
					border-radius: var(--border-radius);
					overflow: hidden;
					background: white;
					box-shadow: var(--shadow-sm);
				}

				.test-card:hover {
					transform: translateY(-5px);
					box-shadow: var(--shadow-lg);
				}

				.test-card .card-body {
					padding: 1.5rem;
				}

				.upper-col {
					background: var(--primary-gradient);
					margin: -1.5rem -1.5rem 1rem -1.5rem;
					padding: 1.5rem;
					border-radius: var(--border-radius) var(--border-radius) 0 0;
				}

				.test-name p {
					color: white;
					font-size: 1.2rem;
					font-weight: 600;
					margin: 0;
				}

				.test-price-info {
					background: rgba(255, 255, 255, 0.1);
					padding: 12px;
					border-radius: 10px;
					backdrop-filter: blur(5px);
				}

				.dis-span {
					background: #28a745;
					padding: 2px 8px;
					border-radius: 20px;
					font-size: 12px;
					color: white;
					display: inline-block;
					margin-left: 5px;
				}

				.info-row {
					padding: 10px 0;
					border-bottom: 1px solid #eee;
					margin-bottom: 10px;
				}

				.info-row i {
					color: #0d6efd;
					margin-right: 8px;
				}

				.cart-btn {
					width: 100%;
					padding: 12px;
					border-radius: 25px;
					transition: var(--transition);
					text-transform: uppercase;
					font-size: 14px;
					font-weight: 600;
					letter-spacing: 0.5px;
				}

				.btn-outline-warning:hover {
					background: #ffc107;
					color: #000;
				}

				/* Organ Section Styles */
				.organ-card {
					transition: var(--transition);
					border: none;
					border-radius: var(--border-radius);
					background: white;
					box-shadow: var(--shadow-sm);
					padding: 1.5rem;
				}

				.organ-card:hover {
					transform: translateY(-5px);
					box-shadow: var(--shadow-md);
				}

				.organ-card img {
					transition: var(--transition);
					height: 4em;
					margin-bottom: 1rem;
				}

				.organ-card:hover img {
					transform: scale(1.1);
				}

				.organ-card .title {
					color: #333;
					font-size: 1.1rem;
					margin: 0;
				}

				/* Section Styles */
				.section-highlight {
					position: relative;
					padding: 4rem 0;
					background: #fff;
				}

				.section-highlight::before {
					content: '';
					position: absolute;
					top: 0;
					left: 0;
					right: 0;
					bottom: 0;
					background: linear-gradient(45deg, rgba(140, 197, 226, 0.15) 0%, rgba(140, 197, 226, 0.4) 100%);
					z-index: 0;
				}

				.section-content {
					position: relative;
					z-index: 1;
				}

				.title {
					font-size: 2rem;
					font-weight: 700;
					margin-bottom: 1.5rem;
					color: #333;
				}

				.title span.text-primary {
					background: var(--primary-gradient);
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}

				.section-description {
					color: #666;
					line-height: 1.6;
					margin-bottom: 2rem;
				}
			</style>

			<section class="all_test_container">
				<div class="container">
					<div class="row g-4">
						<?php foreach ($all_test as $index => $test):
							$baseprice = intval($test['TestFee']);
							$off = 0.16 * $baseprice;
							$totaloff = intval($baseprice + $off);
							?>
							<div class="col-md-6 col-lg-4 col-sm-12">
								<div class="test-card card">
									<div class="card-body">
										<div class="upper-col">
											<div class="row align-items-center">
												<div class="col-7">
													<div class="test-name">
														<p><?php echo $test['TestName'] ?></p>
													</div>
												</div>
												<div class="col-5">
													<div class="test-price-info">
														<p class="mb-0">
															<span class="text-decoration-line-through text-white-50">₹<?php echo $totaloff ?></span>
															<span class="text-white fw-bold">₹<?php echo $test['TestFee'] ?></span>
															<span class="dis-span">16% OFF</span>
														</p>
													</div>
												</div>
											</div>
										</div>

										<div class="info-row row align-items-center">
											<div class="col-6">
												<div class="d-flex align-items-center">
													<i class="fas fa-file-alt"></i>
													<span>Reports within</span>
												</div>
											</div>
											<div class="col-6 text-end">
												<span class="fw-bold">6 hours</span>
											</div>
										</div>

										<div class="info-row row align-items-center">
											<div class="col-6">
												<div class="d-flex align-items-center">
													<i class="fas fa-microscope"></i>
													<span>Tests included</span>
												</div>
											</div>
											<div class="col-6 text-end">
												<span class="fw-bold">1 test</span>
											</div>
										</div>

										<div class="row g-2 mt-3">
											<div class="col-6">
												<a class="cart-btn btn btn-outline-warning" href="./red-blood-cell-count-details">
													View Details
												</a>
											</div>
											<div class="col-6">
												<button class="cart-btn btn btn-primary" data-product-id="<?php echo $test['ID'] ?>"
													data-product-name="<?php echo $test['TestName'] ?>"
													data-product-price="<?php echo $test['TestFee'] ?>">
													Add to cart
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>

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
											<a href="../../admin/authentication/login" class="text-decoration-none">
												<div class="organ-card text-center">
													<img src="../project-assets/images/test/<?php echo $organ['icon'] ?>"
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
											<a href="../../admin/authentication/login" class="text-decoration-none">
												<div class="organ-card text-center">
													<img src="../project-assets/images/test/<?php echo $checkup['icon'] ?>"
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
													<option value="" selected disabled>Select Test</option>
													<option value="Complete Blood Count (CBC) with ESR">
														Complete Blood Count (CBC) with ESR</option>
													<option value="Complete Blood Count (CBC) with ESR">Complete Blood Count (CBC) with ESR
													</option>
													<option value="I don't know/I need help">I don't know/I need help</option>
												</select>
												<div class="invalid-feedback">Please select a Test.</div>
											</div>
											<div class="col-md-3">
												<br>
												<div class="input-group mt-2 d-flex justify-content-between align-items-center w-100">
													<button type="submit" class="btn site-button appointment-btn btnhover13 btn-rounded"
														onclick="Submitenquiry(event)">Get a Call Back</button>
													<img src="../project-assets/images/whatsapp.png"
														style="width:50px; height:auto; cursor: pointer;" onclick="alert('Comming soon....')">
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
													<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq1"
														class="collapsed" aria-expanded="true">
														1. What are the benefits of subscribing to a United Health Lumina health plan?</a>
												</h6>
											</div>
											<div id="faq1" class="acod-body collapse" data-bs-parent="#accordion1">
												<div class="acod-content">United Health Lumina's subscription plans offer a range of benefits,
													including comprehensive coverage for outpatient department (OPD) services, in-patient
													treatment, and preventive care, with flexible claim options.</div>
											</div>
										</div>
										<div class="panel">
											<div class="acod-head">
												<h6 class="acod-title">
													<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq2"
														class="collapsed" aria-expanded="false">
														2. What makes United Health Lumina's OPD plans unique?</a>
												</h6>
											</div>
											<div id="faq2" class="acod-body collapse" data-bs-parent="#accordion1">
												<div class="acod-content">United Health Lumina's OPD-based health plans allow claims on
													outpatient treatments, offering subscribers flexibility for medical consultations,
													diagnostics, and more without needing hospitalization .</div>
											</div>
										</div>
										<div class="panel">
											<div class="acod-head">
												<h6 class="acod-title">
													<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq3"
														class="collapsed" aria-expanded="false">
														3. Can I customize my health plan with United Health Lumina? </a>
												</h6>
											</div>
											<div id="faq3" class="acod-body collapse" data-bs-parent="#accordion1">
												<div class="acod-content"> Yes, United Health Lumina provides customizable health plan options
													to cater to specific medical needs, lifestyle requirements, and family size.
												</div>
											</div>
										</div>
										<div class="panel">
											<div class="acod-head">
												<h6 class="acod-title">
													<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#faq4"
														class="collapsed" aria-expanded="false">
														4.How are claims handled in United Health Lumina subscription plans? </a>
												</h6>
											</div>
											<div id="faq4" class="acod-body collapse" data-bs-parent="#accordion1">
												<div class="acod-content">United Health Lumina offers a streamlined claims process with flexible
													reimbursement options, making it easier for members to claim expenses across OPD and
													in-patient services.</div>
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
<script type="text/javascript" src="../project-assets/js/all_test_new.js" defer></script>