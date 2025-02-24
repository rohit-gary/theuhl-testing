<?php

require_once('uhladmin/uhl-management/include/autoloader.inc.php');
include("uhladmin/uhl-management/include/db-connection.php");
@session_start();
$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$plans = new Plans($conn);
$AllPlan = $plans->GetAllPlan();
?>

<head>
  <?php include("includes/meta.php") ?>
  <?php include("includes/links1.php") ?>
  <title>Plans-United Health Limina</title>
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
  <style>
    .pricing-card {
      transition: all 0.3s ease;
      background: #fff;
      max-width: 350px;
      margin: 0 auto;
    }

    .pricing-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .pricing-amount h3 {
      font-size: 1.75rem;
    }

    .key-info {
      font-size: 0.9rem;
    }

    .mdi {
      font-size: 1.2rem;
    }

    .badge {
      font-size: 0.75rem;
      padding: 0.35em 0.65em;
    }

    .btn-outline-primary:hover {
      transform: translateY(-1px);
    }

    .pricing-card {
      transition: all 0.3s ease;
      background: #fff;
      max-width: 350px;
      margin: 0 auto;
      border: 2px solid #e6f3ff;
      border-radius: 8px;
    }

    .pricing-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
      border-color: #0d6efd;
    }

    .btn-outline-primary {
      transition: all 0.3s ease;
      font-weight: 500;
      padding: 10px 20px;
      border-width: 2px;
      letter-spacing: 0.5px;
    }

    .btn-outline-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(13, 110, 253, 0.15);
      background-color: #0d6efd;
      color: white;
    }

    .plan-details-btn {
      padding: 12px 24px;
      font-size: 1rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin-top: 1.5rem;
      border-radius: 6px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .plan-details-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
    }
  </style>

</head>

<body id="bg">
  <div class="page-wraper">
    <div id="loading-area"></div>
    <!-- header -->
    <?php include('includes/header1.php'); ?>
    <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle "
      style="background-image:url(project-assets/images/banner/back-screen.png);">
      <div class="container">
        <div class="dlab-bnr-inr-entry">
          <h1 class="text-white">Our Health Plans</h1>
          <!-- Breadcrumb row -->
          <div class="breadcrumb-row">
            <ul class="list-inline">
              <li><a href="./index">Home</a></li>
              <li>Our Subscription Plans</li>
            </ul>
          </div>
          <!-- Breadcrumb row END -->
        </div>
      </div>
    </div>
    <!-- inner page banner END -->
    <div class="page-content bg-white">

      <div class="content-block">

        <div class="section-full content-inner">
          <div class="container">
            <div class="section-head text-center">
              <h2 class="title">Our <span class="text-primary">Health Plans</span></h2>
              <p>Our experts have tailored out plans for you and your family needs. The plans have been
                crafted to suit your needs so that you live a healthy and long life</p>
            </div>
            <section class="section" id="pricing">
              <div class="container">
                <div class="row g-4">
                  <?php if (!empty($AllPlan)) { ?>
                    <?php foreach ($AllPlan as $Plan) { ?>
                      <?php if ($Plan['IsDisplay'] == 1) { ?>
                        <div class="col-lg-4 col-md-6"> <!-- Changed to col-lg-4 for smaller cards -->
                          <div class="pricing-card shadow-sm rounded-3 position-relative">
                            <!-- Card Header -->
                            <div class="card-header bg-white p-3 border-bottom-0">
                              <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><?php echo $Plan['PlanName']; ?></h5>
                                <?php if ($Plan['PlanFamilyMember'] > 1): ?>
                                  <i class="mdi mdi-account-multiple text-primary"></i>
                                <?php else: ?>
                                  <i class="mdi mdi-account text-primary"></i>
                                <?php endif; ?>
                              </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-3">
                              <!-- Price -->
                              <?php
                              $planCost = $Plan['PlanCost'];
                              $discountPercentage = 28;
                              $newCost = $planCost * (1 - $discountPercentage / 100);
                              ?>
                              <div class="pricing-amount mb-3">
                                <h3 class="mb-0">₹<?php echo number_format($newCost, 0); ?>
                                  <small
                                    class="text-muted fs-6">/<?php echo strtolower($Plan['PlanDurationFormat']); ?></small>
                                </h3>
                                <span class="badge bg-success-subtle text-success">28% off</span>
                              </div>

                              <!-- Key Info -->
                              <div class="key-info mb-3">
                                <div class="d-flex align-items-center mb-2">
                                  <i class="mdi mdi-calendar-clock me-2 text-primary"></i>
                                  <span><?php echo $Plan['PlanDuration'] . ' ' . $Plan['PlanDurationFormat']; ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                  <i class="mdi mdi-account-group me-2 text-primary"></i>
                                  <span>Up to <?php echo $Plan['PlanFamilyMember']; ?> members</span>
                                </div>
                              </div>

                              <!-- Action Button -->
                              <a href="view-plan-details.php?id=<?php echo htmlspecialchars(base64_encode($Plan['ID'])); ?>"
                                class="btn btn-outline-primary btn-sm w-100">
                                View Details
                              </a>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </section>

          </div>
        </div>



      </div>
    </div>
    <!-- Content END-->

  </div>
  <?php include("includes/footer1.php") ?>
  <?php include("includes/script1.php") ?>
</body>
<script type="text/javascript" src="project-assets/js/all_test_new.js"></script>

</html>