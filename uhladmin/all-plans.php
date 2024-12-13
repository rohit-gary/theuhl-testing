<?php 

    require_once('../uhl-management/include/autoloader.inc.php');
    include("../uhl-management/include/db-connection.php");
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
    <title>UHL</title>  
  <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
  <!-- header -->
  <?php include('includes/header.php'); ?>
    <div class="page-content bg-white">
       
        <div class="content-block">
    
     <div class="section-full content-inner">
  <div class="container">
    <div class="section-head text-center">
      <h2 class="title">Our Latest <span class="text-primary">Plans</span></h2>
      <p>There are many variations of passages of Lorem Ipsum typesetting industry has been the industry's standard dummy text ever since the been when an unknown printer.</p>
    </div>
<section class="section" id="pricing">
    <div class="container">
        <div class="row mt-5 pt-4">
          <?php if(!empty($AllPlan)) { ?>
          <?php foreach($AllPlan as $Plan) { ?>
          <div class="col-lg-4">
                <div class="pricing-box mt-4">
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
                              // If PlanHighlights is not an array, convert it into an array by splitting on new lines
                              // First, strip HTML tags and then split into an array


                              $highlightsArray = is_array($Plan['PlanHighlights']) ? $Plan['PlanHighlights'] : explode("\n", strip_tags($Plan['PlanHighlights']));
                              
                             
                              foreach ($highlightsArray as $highlight) {
                                  // Trim any whitespace around the highlight
                                  $highlight = trim($highlight);
                                  if (!empty($highlight)) { // Ensure the highlight is not empty
                                      echo '<p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>' . htmlspecialchars($highlight) . '</p>';
                                  }
                              }
                          } else {
                              // If there are no highlights available, show a message
                              echo '<p class="mb-2">No highlighted features available.</p>';
                          }
                          ?>
                      </div>


                    <!-- <p class="mt-4 pt-2 text-muted">Semper urna veal tempus pharetra elit habisse platea dictumst.
                    </p> -->
                    <div class="pricing-plan mt-4 pt-2">
                        <h4 class="text-muted"><s>₹ 9999</s> <span class="plan pl-3 text-dark">₹ <?php echo "₹ " . number_format($Plan['PlanCost'], 2); ?> </span></h4>
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