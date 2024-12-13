<?php
     error_reporting(E_ALL);
        ini_set('display_errors', 1); 
        ini_set('display_startup_errors', 1); 
    require_once('uhladmin/uhl-management/include/autoloader.inc.php');
    include("uhladmin/uhl-management/include/db-connection.php");

    $conf = new Conf();
    $dbh = new Dbh();
    $core = new Core();
    $masterconn = $dbh->_connectodb();
    $plans = new Plans($conn);

    if (isset($_GET['id'])) {
      
        $planID = base64_decode($_GET['id']);
         

        $planDetails = $plans->GetPlanDetailsbyID($planID); 

        $state_obj = new State($conn);
    
         $All_State = $state_obj->GetAllState();
         
        $planCost = $planDetails[0]['PlanCost']; // Original plan cost
        $discountPercentage = 28; // Percentage to subtract

        // Calculate the cost after subtracting 28%
        $newCost = $planCost * (1 - $discountPercentage / 100);
        $originalCost = round($newCost * 1.28); // Calculating 28% extra of the plan cost
        
    }
    ?>
    <head>
         <?php include("includes/meta.php") ?>
        <?php include("includes/links.php") ?>
        <title>Plan Details</title>  
     <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
     <style type="text/css">
      

     </style>
    </head>

    <?php include('includes/header.php'); ?>
    <body id="bg">
    <div class="page-wraper">
    <div id="loading-area"></div>
        <div class="page-content bg-white">

            <!-- inner page banner -->
            <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url('project-assets/images/banner/back-screen.png');">
                <div class="container">
                    <div class="dlab-bnr-inr-entry">
                        <h1 class="text-white">Plans Details</h1>
                        <!-- Breadcrumb row -->
                        <div class="breadcrumb-row">
                            <ul class="list-inline">
                                <li><a href="index.html">Home</a></li>
                                <li>Plan Details</li>
                            </ul>
                        </div>
                        <!-- Breadcrumb row END -->
                    </div>
                </div>
            </div>
            <!-- inner page banner END -->
            <!-- contact area -->
            <div class="section-full content-inner bg-white">
                <!-- Product details -->
                <div class="container woo-entry">
                    <div class="row m-b30">
                        <div class="col-md-5 col-lg-5 col-sm-12">
                            <div class="product-gallery on-show-slider lightgallery" id="lightgallery"> 
                                <div id="sync1 ">
                                    <div class="item">
                                        <div class="mfp-gallery mt-4">
                                            <div class="dlab-box">
                                                <div class="dlab-thum-bx">
                                                    <img src="../uhladmin/uhl-management/project-assets/plan/<?php echo $planDetails[0]['PlanImage']; ?>" alt="imgddf">
                                                    <div class="overlay-bx">
                                                        <div class="overlay-icon">
                                                            <span data-exthumbimage="../uhladmin/uhl-management/project-assets/plan/<?php echo $planDetails[0]['PlanImage']; ?>" data-src="../uhladmin/uhl-management/project-assets/plan/<?php echo $planDetails[0]['PlanImage']; ?>" class="check-km" title="Image 1 Title will come here">       
                                                                <i class="ti-fullscreen"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                   
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12">
                           
                                <div class="dlab-post-title">
                                    <h4 class="post-title"><a href="javascript:void(0);"><?php echo $planDetails[0]['PlanName']; ?></a></h4>
                                    <p class="m-b10"><?php 
                             
                              if (!empty($planDetails[0]['PlanHighlights'])) {
                                 

                                  $highlightsString = strip_tags($planDetails[0]['PlanHighlights']);
                                   preg_match_all('/"(.*?)"/', $highlightsString, $matches);
                                 
                                  if (!empty($matches[1])) {
                                    foreach ($matches[1] as $highlight) {
                                        // Trim whitespace around the highlight
                                        $highlight = trim($highlight);
                                        if (!empty($highlight)) { // Ensure the highlight is not empty
                                            echo '<p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2 me-3"></i>' . htmlspecialchars($highlight) . '</p>';
                                        }
                                    }
                                } 

                                                               // Check if CoverageComments exists and is not empty
    
                                        if (!empty($planDetails[0]['CoverageComments'])) {

                                            $CoverageCommentsString = strip_tags($planDetails[0]['CoverageComments']);
                                            preg_match_all('/"(.*?)"/', $CoverageCommentsString, $matches);
                                            echo '<div class="accordion mt-3" id="coverageAccordion">';
                                            
                                            // Accordion Header
                                            echo '<div class="accordion-item">';
                                            echo '<h2 class="accordion-header" id="headingCoverage">';
                                            echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCoverage" aria-expanded="false" aria-controls="collapseCoverage">';
                                            echo '<b>Full Checkup Panel 3 Features:</b>';
                                            echo '</button>';
                                            echo '</h2>';

                                            // Accordion Body (Starts Closed)
                                            echo '<div id="collapseCoverage" class="accordion-collapse collapse" aria-labelledby="headingCoverage" data-bs-parent="#coverageAccordion">';
                                            echo '<div class="accordion-body">';
                                            
                                            // Assuming CoverageComments is a multi-line string
                                           
                                             if (!empty($matches[1])) {
                                            foreach ($matches[1] as $highlight) {
                                        // Trim whitespace around the highlight
                                        $highlight = trim($highlight);
                                        if (!empty($highlight)) { // Ensure the highlight is not empty
                                            echo '<p class="mb-2"><i class="mdi mdi-arrow-right text-info f-18 mr-2 me-3"></i>' . htmlspecialchars($highlight) . '</p>';
                                        }
                                    }
                                } 
                                            
                                            echo '</div>'; // Close accordion-body
                                            echo '</div>'; // Close accordion-collapse
                                            echo '</div>'; // Close accordion-item
                                            
                                            echo '</div>'; // Close accordion
                                        }

                                                     } else {
                                  
                                  echo '<p class="mb-2">No highlighted features available.</p>';
                              }
                              ?></p>
                                    <div class="dlab-divider bg-gray tb15">
                                        <i class="icon-dot c-square"></i>
                                    </div>
                                </div>
                                <div class="relative">
                                    <h3 class="m-tb10">₹<?php echo number_format($newCost, 2);?></h3>
                                    <div class="shop-item-rating">
                                    </div>
                                </div>
                               
                                <div class="dlab-divider bg-gray tb15">
                                    <i class="icon-dot c-square"></i>
                                </div>
                                
                                
                                <button class="site-button radius-no" id="buyPlanBtn" data-plan-id="6">
                                    <i class="ti-shopping-cart"></i> Buy Plans
                                </button>

                                

                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dlab-tabs  product-description tabs-site-button">
                                <ul class="nav nav-tabs ">
                                    <li><a data-bs-toggle="tab" href="#graphic-design-1" class="active"><i class="far fa-image"></i> Additional Information</a></li>
                                    <li><a data-bs-toggle="tab" href="#web-design-1" ><i class="fas fa-globe"></i>Description </a></li>
                                    
                                    <!-- <li><a data-bs-toggle="tab" href="#developement-1"><i class="fas fa-cog"></i> Product Review</a></li> -->
                                </ul>
                                <div class="tab-content">
                                    <div id="web-design-1" class="tab-pane ">
                                        <p><?php 
                             
                              if (!empty($planDetails[0]['PlanDescription'])) {
                                 

                                  $DescriptionArray = is_array($planDetails[0]['PlanDescription']) ? $planDetails[0]['PlanDescription'] : explode("\n", strip_tags($planDetails[0]['PlanDescription']));
                                  
                                 
                                  foreach ($DescriptionArray as $Description) {
                                     
                                      $Description = trim($Description);
                                      if (!empty($Description)) { 
                                          echo '<p class="mb-2">' . htmlspecialchars($Description) . '</p>';
                                      }
                                  }
                              } else {
                                  
                                  echo '<p class="mb-2">No highlighted features available.</p>';
                              }
                              ?></p>
                                    </div>
                                    <div id="graphic-design-1" class="tab-pane active">
                                        <table class="table table-bordered" >
                                            <tr>
                                                <td>Family Members Covered</td>
                                                <td><?php echo $planDetails[0]['PlanFamilyMember']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Plan Duration</td>
                                                <td><?php echo $planDetails[0]['PlanDuration']; ?></td>
                                            </tr>

                                             <tr>
                                                <td>Plan Duration Format</td>
                                                <td><?php echo $planDetails[0]['PlanDurationFormat']; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Cost</td>
                                                <td>₹<?php echo $planDetails[0]['PlanCost']; ?>(Including All GST   )</td>
                                            </tr>

                                            <tr>
                                                <td>Rating</td>
                                                <td>
                                                    <span class="rating-bx"> 
                                                        <i class="fas fa-star"></i> 
                                                        <i class="fas fa-star"></i> 
                                                        <i class="fas fa-star"></i> 
                                                        <i class="fas fa-star"></i> 
                                                        <i class="fas fa-star"></i> 
                                                    </span> 
                                                </td>
                                            </tr>
                                           
                                           
                                        </table>
                                    </div>
                                    <div id="developement-1" class="tab-pane">
                                     
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
                </div>
               
            </div>


        </div>
         <?php include("includes/footer.php") ?>
         <?php include("includes/script.php") ?>
        <button class="scroltop fas fa-chevron-up" ></button>
    </div>



        <!-- Modal HTML Structure -->
    <div class="modal fade" id="buyPlanModal" tabindex="-1" aria-labelledby="buyPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#85b94e !important;">
                    <h5 class="modal-title" id="buyPlanModalLabel">Buy Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <div class="card">
                        
                        <div class="card-body">
                            <form id="customer_policy_form" onsubmit="return false;">
                                <div class="row">
                                   
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Selected Plan <span class="text-red">*</span></label>
                                            <select class="form-control form-select" name="plan" id="plan" onchange="planSelected(this)">
                                                <option value="<?php echo $planDetails[0]['ID']; ?>"selected><?php echo $planDetails[0]['PlanName']; ?></option>
                                            </select>


                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Plan Cost: (Including All GST   )</label>
                                            <input type="text" id="planCostInput" class="form-control"  value="<?php echo $planDetails[0]['PlanCost']; ?>" readonly>
                                            <input type="hidden" id="planCostHidden" name="plan_cost" value="<?php echo $planDetails[0]['PlanCost']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Plan Duration</label>
                                            <input type="text" id="planDurationInput" class="form-control" value="<?php echo $planDetails[0]['PlanDuration']; ?>"readonly>
                                            <input type="hidden" id="planDurationHidden" name="plan_duration" value="<?php echo $planDetails[0]['PlanDuration']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Plan Duration Format:</label>
                                            <input type="text" id="planDurationFormatInput" class="form-control" value="<?php echo $planDetails[0]['PlanDurationFormat']; ?>"readonly>
                                            <input type="hidden" id="planDurationFormatHidden" name="plan_duration_format" value="<?php echo $planDetails[0]['PlanDurationFormat']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Family Member Coverd</label>
                                            <input type="text" id="planFamilyMemberInput" class="form-control" value="<?php echo $planDetails[0]['PlanFamilyMember']; ?>"readonly>
                                            <input type="hidden" id="planFamilyMemberHidden" name="plan_family_member" value="<?php echo $planDetails[0]['PlanFamilyMember']; ?>">
                                        </div>

                                        <input type="hidden" id="planMinFamilyMemberInput" class="form-control" value="<?php echo $planDetails[0]['PlanMinimumFamilyMember']; ?>"readonly>
                                            <input type="hidden" id="planMinFamilyMemberHidden" name="plan_min-family_member" value="<?php echo $planDetails[0]['PlanMinimumFamilyMember']; ?>">
                                    </div>


                                </div>

                                <!-- Example of two inputs in one row -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Name <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="POC Name" name="poc_name" id="poc_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Contact Number<span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Contact Number" name="poc_contact_number" id="poc_contact_number">
                                        </div>
                                    </div>
                                </div>

                                <!-- Gender Selection -->
                                        <div class="row mb-3">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                         <label class="form-label">Gender <span class="text-red">*</span></label>
                                                        <div class="">

                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male">
                                                                <label class="form-check-label" for="genderMale">Male</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                                                                <label class="form-check-label" for="genderFemale">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Date of Birth <span class="text-red">*</span></label>
                                                <input type="date" class="form-control" name="dob" id="dob">
                                            </div>
                                        </div>
                                        </div>




                                <!-- Buying Plan For -->
                                <div class="row mb-3">


                                       <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Email<span class="text-red">*</span></label>
                                                        <input type="email" class="form-control" placeholder="Email" autocomplete="username" name="email" id="email">
                                                    </div>
                                                </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                                        <label class="form-label">Address <span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Home Address" name="address" id="address">
                                                    </div>
                                       
                                             </div>

                                          
                                </div>


                                
                                <div class="row mb-3">
                                  <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">State<span class="text-red">*</span></label>
                                                <select class="form-control form-select" name="state" id="state" required>
                                                    <option value="">Select State</option>
                                                    <?php
                                                    // Assuming $All_State is the array containing state data
                                                    foreach ($All_State as $state) {
                                                        echo '<option value="' . htmlspecialchars($state['ID']) . '">' . htmlspecialchars($state['StateName']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                        <div class="form-group">
                                                        <label class="form-label">Pin Code <span class="text-red">*</span></label>
                                                        <input type="number" class="form-control" placeholder="ZIP Code" name="pincode" id="pincode">
                                                    </div>
                                                    </div>
                                       
                                    </div>

                                          
                                          </div>
                                           <div class="row mb-3">
                                        <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Buying Plan For <span class="text-red">*</span></label>
                                                        <div class="form-check d-flex">
                                                            <input class="form-check-input" type="radio" name="buying_for" id="buyingMyself" value="myself"  onclick="toggleMemberNumber(false)">
                                                            <label class="form-check-label" for="buyingMyself">
                                                                Myself
                                                            </label>
                                                        </div>
                                                        <?php if ($planDetails[0]['PlanFamilyMember'] > 1): ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="buying_for" id="buyingOther" value="other" onclick="toggleMemberNumber(true)">
                                                                <label class="form-check-label" for="buyingOther">
                                                                    Other
                                                                </label>
                                                            </div>
                                                            <?php endif; ?>

                                                    </div>
                                                </div>
                                   

                                          <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                       <div class="form-group">
                                                        <label class="form-label">POC Issue Date <span class="text-red">*</span></label>
                                                        <input type="date" class="form-control" name="issue_date" id="issue_date">
                                                    </div>
                                                    </div>
                                                </div> -->
                                          </div>

                                      

                                <!-- Member Number Input (Hidden by default) -->
                                <div class="row mb-3" id="memberNumberDiv" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Member Number <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="familyMemberCount" name="familyMemberCount" placeholder="Enter Member Number" min="1" onchange="generateFamilyMemberForm()">
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Family Member Forms -->
                                <div class="col-md-12" id="familyMemberFormsContainer"></div>

                                <div class="row">
                                    <input type="hidden" id="form_action" name="form_action" value="add" />
                                    <input type="hidden" id="form_id" name="form_id" value="-1" />
                                    <div class="mt-4 text-center">
                                        <button class="site-button radius-no" id="addCusPolicyBtn" onclick="AddUpdateCustomerPolicyForm()">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="site-button radius-no" data-bs-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    </div>





    <script type="text/javascript" src="./project-assets/js/plans.js"defer> </script>


<script>
    var maxFamilyMembers = <?= isset($planDetails[0]['PlanFamilyMember']) ? (int)$planDetails[0]['PlanFamilyMember'] : 0; ?>;
    var minFamilyMembers = <?= isset($planDetails[0]['PlanMinimumFamilyMember']) ? (int)$planDetails[0]['PlanMinimumFamilyMember'] : 0; ?>;
</script>






