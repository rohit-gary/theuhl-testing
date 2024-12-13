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
    <?php include("includes/links.php") ?>
    <title>Plans-United Health Limina</title>
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
  <!-- header -->
  <?php include('includes/header.php'); ?>
   <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle " style="background-image:url(project-assets/images/banner/back-screen.png);">
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
      <p>Our experts have tailored out plans for you and your family needs. The plans have been crafted to suit your needs so that you live a healthy and long life</p>
    </div>
<section class="section" id="pricing">
    <div class="container">
        <div class="row ">
          <?php if(!empty($AllPlan)) { ?>
          <?php foreach($AllPlan as $Plan) { ?>
            <?php if($Plan['IsDisplay'] == 1) { // Check if IsDisplay is 1 ?>
          <div class="col-lg-6">
                <div class="pricing-box ">
                   <div class="pricing-badge">
                      
                    </div>
                    <?php 
                       
                        if ($Plan['PlanFamilyMember'] > 1) {
                            // Multiple members icon
                            echo '<i class="mdi mdi-account-multiple h1 text-primary"></i>';
                        } else {
                            // Single member icon
                            echo '<i class="mdi mdi-account h1 text-primary"></i>';
                        }
                        ?>
                   <h4 class="f-20"><?php echo $Plan['PlanName']; ?></h4>

                   <div class="mt-4 pt-2">
    <p class="mb-2 f-18"><b>Highlighted Features</b></p>

    <?php 
    // Check if PlanHighlights is set and not empty
    if (!empty($Plan['PlanHighlights'])) {
        // Assuming PlanHighlights contains the highlights in quotes
        $highlightsString = strip_tags($Plan['PlanHighlights']); // Strip HTML tags if any

        // Use regex to extract quoted strings
        preg_match_all('/"(.*?)"/', $highlightsString, $matches);

        // Check if any matches were found
        if (!empty($matches[1])) {
            foreach ($matches[1] as $highlight) {
                // Trim whitespace around the highlight
                $highlight = trim($highlight);
                if (!empty($highlight)) { // Ensure the highlight is not empty
                    echo '<p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2 me-3"></i>' . htmlspecialchars($highlight) . '</p>';
                }
            }
        } else {
            // If no valid highlights were found, show a message
            echo '<p class="mb-2">No highlighted features available.</p>';
        }
    } else {
        // If PlanHighlights is not set or empty, show a message
        echo '<p class="mb-2">No highlighted features available.</p>';
    }
    ?>
</div>


                    <!-- <p class="mt-4 pt-2 text-muted">Semper urna veal tempus pharetra elit habisse platea dictumst.
                    </p> -->
                    <div class="pricing-plan mt-4 pt-2">
                    <?php
                                $planCost = $Plan['PlanCost']; // Original plan cost
                                $discountPercentage = 28; // Percentage to subtract
                                
                                // Calculate the cost after subtracting 28%
                                $newCost = $planCost * (1 - $discountPercentage / 100);
                                $originalCost = round($newCost * 1.28); // Calculating 28% extra of the plan cost
                                ?>
                                <h4 class="text-muted">
                                    <s>₹ <?php echo $originalCost; ?> </s>
                                    <span class="plan pl-3 text-dark">₹ <?php echo number_format($newCost, 2); ?> </span>
                                    <p class="d-inline text-success mb-0 small" style="margin-left: -0.5rem !important;">(28% Off)</p>
                                </h4>
                               
                              <p class="text-muted mb-0">
                                <i class="mdi mdi-calendar me-2" style="font-size: 18px;"></i> <?php echo $Plan['PlanDuration']; ?>&nbsp;<?php echo $Plan['PlanDurationFormat']; ?>
                            </p>
                            <p class="text-muted mb-0">
                              <?php 
                                  if ($Plan['PlanFamilyMember'] == 1) {
                                      // Single member icon
                                      echo '<i class="mdi mdi-account me-2" style="font-size: 18px;"></i> Single member';
                                  } else {
                                      // Multiple members icon
                                      echo '<i class="mdi mdi-account-multiple me-2" style="font-size: 18px;"></i> Up to ' . $Plan['PlanFamilyMember'] . ' members';
                                  }
                              ?>
                          </p>


                    </div>


                    <div class="mt-4 pt-3">
            <?php
            
            $encryptedPlanID = base64_encode($Plan['ID']);
            ?>
            <a href="view-plan-details.php?id=<?php echo htmlspecialchars($encryptedPlanID); ?>" class="btn site-button appointment-btn btnhover13 btn-rounded">View Plan Details</a>
        </div>

                </div>
            </div>

            <?php } // End if IsDisplay == 1 ?>

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
    <?php include("includes/footer.php") ?>
    <?php include("includes/script.php") ?>
</body>
</html>