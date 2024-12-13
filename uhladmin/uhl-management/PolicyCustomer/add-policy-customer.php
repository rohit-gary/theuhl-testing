<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 

@session_start();
require_once "../include/autoloader.inc.php";

$conf = new Conf();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>Add Policy Customer -United Health Lumina</title>
    <?php
    include "../include/common-head.php";
    include "../include/get-db-connection.php";
    $dbh = new Dbh();
    $Masterconn = $dbh->_connectodb();
    $core = new Core();
    $authentication = new Authentication($Masterconn);
    $UserType = $authentication->SessionCheck();

    $plan = new Plans($conn);
    $state_obj = new State($conn);
    $All_Pans = $plan->GetAllPlan();
    $All_State = $state_obj->GetAllState();
    // print_r($All_Pans);
    // die();

    $CenterID = -1;
    if (isset($_SESSION["CenterID"])) {
        $CenterID = $_SESSION["CenterID"];
    }

    $access = false;
    if ($UserType == "Client Admin" || $UserType == "Channel Partner") {
        $access = true;
    }
    ?>
<link rel="stylesheet" href="../theme-assets/plugins/richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="../theme-assets/plugins/richtexteditor/rte.js"></script>
<script type="text/javascript" src='../theme-assets/plugins/richtexteditor/plugins/all_plugins.js'></script>

<style>
    
    /* Optional custom styles for modal */
#paymentLinkModal .modal-content {
    border-radius: 8px;
    border: 1px solid #ddd;
}

#paymentLinkModal .modal-header {
    background-color: #007bff;
    color: white;
}

#paymentLinkModal .modal-header .btn-close {
    background-color: transparent;
    border: none;
    color: white;
}

#paymentLinkModal .modal-body {
    padding: 20px;
}

#paymentLinkModal .input-group input {
    border-radius: 5px;
}

#paymentLinkModal .btn {
    border-radius: 5px;
}

#paymentLinkModal .btn-outline-secondary {
    border-left: 1px solid #ddd;
}

#paymentLinkModal .modal-footer {
    display: none;
}

</style>
</head>

<body class="app sidebar-mini ltr light-mode">
    <div class="page">
        <div class="page-main">
            <?php
            include "../navigation/top-header.php";
            include "../navigation/side-navigation.php";
            ?>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header mb-3">
                            <h1 class="page-title">ADD POLICY</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Policy</li>
                                </ol>
                            </div>
                        </div>    
                    </div>
                               <div class="card">
                                    <div class="card-header ">
                                        <h3 class="card-title">Customer Information</h3>
                                    </div>
                                    <div class="card-body">
                                    <form id="customer_policy_form" onsubmit="return false;" >
                                        <div class="row">

                                           <div class="row">
                                            <div class="col-md-10"> 
                                            <div class="form-group">
                                                <label class="form-label">Select Plan <span class="text-red">*</span></label>
                                                <select class="form-control form-select" name="plan" id="plan" onchange="planSelected(this)">
                                                    <option value="" disabled selected>Select a Plan</option>
                                                        <option value="" disabled selected>Select a Plan</option>
                                                        <?php // Assuming $All_Plans contains the array of plans from the GetAllPlan method
                                                        foreach (
                                                            $All_Pans
                                                            as $plan
                                                        ) {
                                                            $planID =
                                                                $plan["ID"];
                                                            $planName =
                                                                $plan[
                                                                    "PlanName"
                                                                ];
                                                            $planCost =
                                                                $plan[
                                                                    "PlanCost"
                                                                ];
                                                            $planDurationFormat =
                                                                $plan[
                                                                    "PlanDurationFormat"
                                                                ];
                                                            $planFamilyMember = $plan["PlanFamilyMember"];
                                                            $planMinFamilyMember = $plan["PlanMinimumFamilyMember"];


                                                            $planDuration = $plan["PlanDuration"];
                                                            echo "<option value='$planID' data-cost='$planCost' data-duration-format='$planDurationFormat' data-duration='$planDuration' data-family-member='$planFamilyMember' data-min-family-member='$planMinFamilyMember'>$planName</option>";
                                                        } ?>
                                                </select>
                                            </div>
                                           
                                            <div class="row">
                                       <div class="col-md-12">

                                        <div id="planCostDisplay" class="form-group" style="display: none;">
                                            <div class="row">
                                                <div class="col-md-3">
                                           <label class="form-label">Plan Cost</label>
                                            <input type="text" id="planCostInput" class="form-control" readonly>
                                          <input type="hidden" id="planCostHidden" name="plan_cost">
                                           </div>

                                           <div class="col-md-3">
                                          <label class="form-label">Plan Duration</label>
                                         <input type="text" id="planDurationInput" class="form-control" readonly>
                                         <input type="hidden" id="planDurationHidden" name="plan_duration">
                                           </div>

                                           <div class="col-md-3">
                                          <label class="form-label">Plan Duration Format</label>
                                         <input type="text" id="planDurationFormatInput" class="form-control" readonly>
                                         <input type="hidden" id="planDurationFormatHidden" name="plan_duration_format">
                                           </div>

                                           

                                         <div class="col-md-3">
                                              <label class="form-label">Members Covered</label>
                                                <input type="text" id="planFamilyMemberInput" class="form-control" readonly>
                                                <input type="hidden" id="planFamilyMemberHidden" name="plan_family_member">
                                                </div>
                                                 <input type="hidden" id="planMinFamilyMemberInput" class="form-control" readonly>
                                                <input type="hidden" id="planMinFamilyMemberHidden" name="data-min-family-member">
                                                </div>
                                         </div>
                                        </div>
                                         </div>

                                            </div>
                                            <div class="col-md-2 mt-6"> 
                                           
                                                <button id="viewPlanDetailsBtn" class="btn btn-primary" onclick="viewPlanDetails()" disabled style="cursor: pointer; display:none">
                                                    See Plan Details
                                                </button>
                                          

                                            </div>
                                        </div>


                                            <div class="col-md-12">
                                                <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Name <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="name" name="poc_name" id="poc_name"> 
                                                </div>
                                            </div>

                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Contact Number<span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="ContactNumber" name="poc_contact_number" id="poc_contact_number">
                                                </div>
                                            </div>

                                            </div>

                                            </div>
                                            
                                            
                                            <div class="col-md-12 ">
                                                <div class="form-group ">
                                                    <label class="form-label">Gender <span class="text-red">*</span></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" >
                                                        <label class="form-check-label" for="genderMale">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" >
                                                        <label class="form-check-label" for="genderFemale">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class=row>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Date of Birth <span class="text-red">*</span></label>
                                                    <input type="date" class="form-control" name="dob" id="dob" >
                                                </div>
                                            </div>

                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email<span class="text-red">*</span></label>
                                                    <input type="email" class="form-control" placeholder="Email" autocomplete="username" name="email" id="email">
                                                </div>
                                            </div>

                                            </div>
                                            </div>   
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Full Address <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Home Address" name="address" id="address">
                                                </div>
                                            </div>
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

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Pin Code <span class="text-red">*</span></label>
                                                    <input type="number" class="form-control" placeholder="ZIP Code" name="pincode" id="pincode">
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">POC Issue Date <span class="text-red">*</span></label>
                                                    <input type="date" class="form-control" name="issue_date" id="issue_date">
                                                </div>
                                            </div>
 -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Buying Plan For <span class="text-red">*</span></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="buying_for" id="buyingMyself" value="myself"  onclick="toggleMemberNumber(false)">
                                                        <label class="form-check-label" for="buyingMyself">
                                                            Myself
                                                        </label>
                                                    </div>

                                                    <div class="form-check" id="buying_for_other_div" style="display: none;">
                                                        <input class="form-check-input" type="radio" name="buying_for" id="buyingOther" value="other"  onclick="toggleMemberNumber(true)">
                                                        <label class="form-check-label" for="buyingOther">
                                                            Other
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Member Number Input (hidden by default) -->
                                            <div class="col-md-12" id="memberNumberDiv" style="display: none;">
                                                <div class="form-group">
                                                    <label class="form-label">Member Number <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" id="familyMemberCount" name="familyMemberCount" placeholder="Enter Member Number"  min="1" onchange="generateFamilyMemberForm()">
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="familyMemberFormsContainer"></div>

                                             <div class="row">
            

                                             <input type="hidden" id="form_action" name="form_action" value="add" />
                                               <input type="hidden" id="form_id" name="form_id" value="-1" />

                                      <div class="mt-5 text-center">
                                    <button class="btn btn-success text-white" id="addCusPolicyBtn"
                                        onclick="AddUpdateCustomerPolicyForm()"></button>
                                     </div>
                                        </div>
                                    </div>
                                     


                        </form>
                                </div>
                </div>
            </div>



            <div id="loader" style="display:none;">
    <img src="../project-assets/images/loder-1.gif" alt="Loading..." />
</div>


        <?php include "../navigation/right-side-navigation.php"; ?>

        </div>

        <?php include "../include/common-script.php"; ?>


<!-- Modal for Payment Link -->
<!-- Modal for Payment Link -->
<div id="paymentLinkModal" class="modal fade" tabindex="-1" aria-labelledby="paymentLinkModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentLinkModalLabel">Payment Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <p>Your payment link is:</p>
                <div class="input-group">
                    <input type="text" id="paymentLink" value="" readonly class="form-control" />
                    <button class="btn btn-outline-secondary" id="copyLinkBtn" type="button">Copy</button>
                </div>
                <p class="mt-3">You can also share it:</p>
                <button id="shareLinkEmailBtn" class="btn btn-primary w-100 mb-2">Share via Email</button>
                <button id="shareLinkWhatsappBtn" class="btn btn-success w-100">Share on WhatsApp</button>
            </div>
        </div>
    </div>
</div>



       <script src="../project-assets/js/customer-policy.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
              $("#nav_program").addClass("active");
            });
        </script>

     



<script>
    var editor = new RichTextEditor("#Answer");
    
 
</script>


</body>

</html>


