<?php
require_once('../uhl-management/include/autoloader.inc.php');
include("../uhl-management/include/db-connection.php");
$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$plans = new Plans($conn);

if (isset($_GET['id'])) {
  
    $planID = base64_decode($_GET['id']);
     

    $planDetails = $plans->GetPlanDetailsbyID($planID); 

     // print_r($planDetails);
     
     
    
}
?>
<head>
     <?php include("includes/meta.php") ?>
    <?php include("includes/links.php") ?>
    <title>Plan Details</title>  
 <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
 
</head>

<?php include('includes/header.php'); ?>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
    <div class="page-content bg-white">

        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url('../uhl-management/project-assets/plan/<?php echo $planDetails[0]['PlanImage']; ?>');">
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
                                                <img src="../uhl-management/project-assets/plan/<?php echo $planDetails[0]['PlanImage']; ?>" alt="imgddf">
                                                <div class="overlay-bx">
                                                    <div class="overlay-icon">
                                                        <span data-exthumbimage="../uhl-management/project-assets/plan/<?php echo $planDetails[0]['PlanImage']; ?>" data-src="../uhl-management/project-assets/plan/<?php echo $planDetails[0]['PlanImage']; ?>" class="check-km" title="Image 1 Title will come here">       
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
                             

                              $highlightsArray = is_array($planDetails[0]['PlanHighlights']) ? $planDetails[0]['PlanHighlights'] : explode("\n", strip_tags($planDetails[0]['PlanHighlights']));
                              
                             
                              foreach ($highlightsArray as $highlight) {
                                 
                                  $highlight = trim($highlight);
                                  if (!empty($highlight)) { 
                                      echo '<p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>' . htmlspecialchars($highlight) . '</p>';
                                  }
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
                                <h3 class="m-tb10">₹<?php echo $planDetails[0]['PlanCost']; ?> </h3>
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
                                <li><a data-bs-toggle="tab" href="#web-design-1" class="active"><i class="fas fa-globe"></i>Description </a></li>
                                <li><a data-bs-toggle="tab" href="#graphic-design-1"><i class="far fa-image"></i> Additional Information</a></li>
                                <!-- <li><a data-bs-toggle="tab" href="#developement-1"><i class="fas fa-cog"></i> Product Review</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div id="web-design-1" class="tab-pane active">
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
                                <div id="graphic-design-1" class="tab-pane">
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
                                            <td>₹<?php echo $planDetails[0]['PlanCost']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Rating</td>
                                            <td>
                                                <span class="rating-bx"> 
                                                    <i class="fas fa-star"></i> 
                                                    <i class="fas fa-star"></i> 
                                                    <i class="fas fa-star"></i> 
                                                    <i class="fas fa-star"></i> 
                                                    <i class="far fa-star"></i> 
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
    <div class="modal-dialog" style="max-width: 80vw; overflow-y: auto; margin-top: 0px !important">
        <div class="modal-content">
            <div class="modal-header" style="background:#85b94e !important;">
                <h5 class="modal-title" id="buyPlanModalLabel">Buy Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="card">
                    
                    <div class="card-body">
                        <form id="customer_policy_form" onsubmit="return false;">
                            <!-- <div class="row">
                               
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Select Plan <span class="text-red">*</span></label>
                                        <select class="form-control form-select" name="plan" id="plan" onchange="planSelected(this)">
                                            <option value="" disabled selected>Select a Plan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <button id="viewPlanDetailsBtn" class="btn btn-primary" onclick="viewPlanDetails()" disabled>
                                        See Plan Details
                                    </button>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Plan Cost:</label>
                                        <input type="text" id="planCostInput" class="form-control" readonly>
                                        <input type="hidden" id="planCostHidden" name="plan_cost">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Plan Duration Format:</label>
                                        <input type="text" id="planDurationFormatInput" class="form-control" readonly>
                                        <input type="hidden" id="planDurationFormatHidden" name="plan_duration_format">
                                    </div>
                                </div>
                            </div> -->

                            <!-- Example of two inputs in one row -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">POC Name <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" placeholder="POC Name" name="poc_name" id="poc_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">POC Contact Number<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" placeholder="Contact Number" name="poc_contact_number" id="poc_contact_number">
                                    </div>
                                </div>
                            </div>

                            <!-- Gender Selection -->
            <div class="row mb-3">
    <div class="col-md-6">

        <div class="form-group">
             <label class="form-label">POC Gender <span class="text-red">*</span></label>
            <div class="d-flex">

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
                                        <label class="form-label">POC Date of Birth <span class="text-red">*</span></label>
                                        <input type="date" class="form-control" name="dob" id="dob">
                                    </div>
                                </div>
</div>


                            <!-- Buying Plan For -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                     <label class="form-label">Buying Plan For <span class="text-red">*</span></label>
                                    <div class="form-group d-flex">
                                       
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="buying_for" id="buyingMyself" value="myself" onclick="toggleMemberNumber(false)">
                                            <label class="form-check-label" for="buyingMyself">Myself</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="buying_for" id="buyingOther" value="other" onclick="toggleMemberNumber(true)">
                                            <label class="form-check-label" for="buyingOther">Other</label>
                                        </div>
                                    </div>
                                </div>

                                      <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">POC Email<span class="text-red">*</span></label>
                                                    <input type="email" class="form-control" placeholder="Email" autocomplete="username" name="email" id="email">
                                                </div>
                                            </div>
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
                                    <button class="site-button radius-no" id="addCusPolicyBtn" onclick="AddUpdateCustomerPolicyForm()">Submit</button>
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