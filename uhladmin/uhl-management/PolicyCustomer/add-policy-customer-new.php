<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

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
    <title>Add Policy Customer - United Health Lumina</title>
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

    $CenterID = -1;
    if (isset($_SESSION["CenterID"])) {
        $CenterID = $_SESSION["CenterID"];
    }

    $access = false;
    if ($UserType == "Client Admin" || $UserType == "Channel Partner") {
        $access = true;
    }

    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../theme-assets/plugins/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="../theme-assets/plugins/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='../theme-assets/plugins/richtexteditor/plugins/all_plugins.js'></script>
    <link rel="stylesheet" type="text/css" href="../project-assets/css/add-new-policy.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">

     <style>
.member-form {
    font-family: 'Poppins', sans-serif;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    max-width: 800px;
    margin: 0 auto;
}

.member-form h1 {
    font-size: 28px;
    text-align: center;
    color: #4CAF50;
    margin-bottom: 20px;
    font-weight: bold;
}

/* Card Styles */
.card {
    background-color: #ffffff;
    border-radius: 8px;
    border: none;
    margin-bottom: 20px;
}

.card-header {
    background-color: #4CAF50;
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 10px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-body {
    padding: 20px;
}

/* Form Elements */
.form-label {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.input-group, .form-check, .form-group {
    margin-bottom: 20px;
}


/* Responsive Design */
@media (max-width: 768px) {
    .member-form {
        padding: 20px;
    }
    .card-body {
        padding: 15px;
    }
    .form-control {
        padding: 10px;
    }
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
            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        <div class="container my-5">
                            <div class="text-center mb-4">
                                <h3 class="display-6 fw-bold">Add Health Plan</h3>
                                <p class="text-muted">Follow the steps below to create a new Health policy.</p>
                            </div>

                            <!-- Step Progress -->
                            <div class="row justify-content-center mb-4">
                                <div class="col-lg-8">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="step-box active">
                                            <span class="step-number">1</span>
                                            <p class="step-title">Basic Details</p>
                                        </div>
                                        <div class="step-line"></div>
                                        <div class="step-box">
                                            <span class="step-number">2</span>
                                            <p class="step-title">Choose Policy</p>
                                        </div>
                                        <div class="step-line"></div>
                                        <div class="step-box">
                                            <span class="step-number">3</span>
                                            <p class="step-title">Member Details</p>
                                        </div>
                                        <div class="step-line"></div>
                                        <div class="step-box">
                                            <span class="step-number">4</span>
                                            <p class="step-title">Purchase Summary</p>
                                        </div>
                                        <!-- <div class="step-line"></div>
                                        <div class="step-box">
                                            <span class="step-number">5</span>
                                            <p class="step-title">Payment Link</p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <!-- Form Sections -->
                            <div id="step-1" class="form-section active">
                                <div class="card">
                                    <div class="card-header">Step 1: Basic Details</div>
                                    <div class="card-body">
                                        <form id="customer_form" onsubmit="return false;">
                                            <input type="hidden" id="form_action" name="form_action" value="" />
                                             <input type="hidden" id="form_id" name="form_id" value="" />
                                           <div class="col-md-12">
                                                <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Name <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Name" name="poc_name" id="poc_name"> 
                                                </div>
                                            </div>

                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Contact Number<span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Contact Number" name="poc_contact_number" id="poc_contact_number" oninput="validateNumericInput(this)">
                                                </div>
                                            </div>

                                            </div>

                                            </div>
                                            
                                            
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Gender <span class="text-red">*</span></label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male">
                                                            <label class="form-check-label" for="genderMale">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                                                            <label class="form-check-label" for="genderFemale">Female</label>
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
                                             <div class=row>
                                            <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">State<span class="text-red">*</span></label>
                                                <select class="form-control form-select" name="state" id="state" required>
                                                    <option value="">Select State</option>
                                                    <?php // Assuming $All_State is the array containing state data
                                                    foreach (
                                                        $All_State
                                                        as $state
                                                    ) {
                                                        echo '<option value="' .
                                                            htmlspecialchars(
                                                                $state["ID"]
                                                            ) .
                                                            '">' .
                                                            htmlspecialchars(
                                                                $state[
                                                                    "StateName"
                                                                ]
                                                            ) .
                                                            "</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Pin Code <span class="text-red">*</span></label>
                                                    <input type="number" class="form-control" placeholder="ZIP Code" name="pincode" id="pincode">
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
                                           
                                            <button type="button" class="btn btn-success" onclick="SaveCustomer()" id="savecustomerBtn">Save</button>
                                            <button type="button" class="btn btn-primary" id="gotosecondstep" onclick="goToNextStep()">Next</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Add additional form sections for other steps -->
                              <div id="step-2" class="form-section">
                            <div class="card">
                                <div class="card-header">Step 2: Choose Policy</div>
                                <div class="card-body">
                                 <form id="policy_form" onsubmit="return false;">
                                  <input type="hidden" id="form_action_policy" name="form_action" value="" />
                                  <input type="hidden" id="form_id" name="form_id" value="" />
                            <div class="row">
                                <?php
                                // Loop through each plan to display it
                                foreach ($All_Pans as $plan) {
                                    ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm plan-card" id="plan-card-<?php echo $plan['ID']; ?>" onclick="togglePlanSelection(<?php echo $plan['ID']; ?>)">
                                            <img src="<?php echo htmlspecialchars($plan['PlanImage']); ?>" class="card-img-top" alt="Plan Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo htmlspecialchars($plan['PlanName']); ?></h5>
                                                <p><strong>Duration:</strong> <?php echo htmlspecialchars($plan['PlanDuration']) . ' ' . htmlspecialchars($plan['PlanDurationFormat']); ?></p>
                                                <p><strong>Family Members Covered:</strong> <?php echo htmlspecialchars($plan['PlanFamilyMember']); ?></p>
                                                <p><strong>Cost:</strong> ₹<?php echo number_format(htmlspecialchars($plan['PlanCost']), 2); ?></p>

                                                <!-- Checkbox for selection -->
                                                <input type="checkbox" class="form-check-input" name="selected_plan[]" value="<?php echo htmlspecialchars($plan['ID']); ?>" id="plan-<?php echo $plan['ID']; ?>" style="display: none;">
                                                
                                                <!-- Green check mark (hidden by default) -->
                                                <div class="check-mark" id="check-mark-<?php echo $plan['ID']; ?>" style="display: none;">
                                                    <i class="fas fa-check-circle text-success"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                            <button type="button" class="btn btn-primary" onclick="goToPreviousStep()">Previous</button>
                            <button type="button" class="btn btn-success" onclick="saveSelectedPlans()" id="savePolicyBtn">Save</button>
                            <button type="button" class="btn btn-primary" id="gotothirdstep" onclick="goToNextStep()">Next</button>
                        </form>

                                        </div>
                                    </div>
                                </div>


                             <!-- Add additional form sections for other steps &nbsp;<button type="button" class="btn btn-success" onclick="fetchPlansAndGenerateForms()">Fetch Member Form</button> -->
                               <div id="step-3" class="form-section" >
                                <div class="card">
                                    <div class="card-header">Step 3: Member Details </div>
                                    <div class="card-body">
                                        
                                       <form id="step-3-form" onsubmit="return false;">
                                            <input type="hidden" id="form_action_family" name="form_action" value="" />
                                            <input type="hidden" id="form_id" name="form_id" value="" />

                                            <!-- Dynamic member forms will be appended here -->
                                            <div id="step-3-form-container"></div>

                                            <button type="button" class="btn btn-primary" onclick="goToPreviousStep()">Previous</button>
                                            <button type="button" class="btn btn-success" onclick="savefamilyMember()" id="savefamilyMemberBtn">Save</button>
                                            <button type="button" class="btn btn-primary" onclick="goToNextStep()" id="gotofourthstep">Next</button>
                                        </form>               
                                    </div>
                                </div>
                            </div>


                            <!-- Add additional form sections for other steps -->
                               <div id="step-4" class="form-section">
                            <div class="card">
                                <div class="card-header">Step 4: Purchase Summary</div>
                                <div class="card-body">
                                    <!-- Display the selected plans -->
                                    <div id="selected-plans-container"></div>

                                    <hr>

                                    <!-- Total amount section -->
                                    <div class="d-flex justify-content-between mt-3">
                                        <strong>Total:</strong>
                                        <span id="total-amount" class="h4">₹0.00</span>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-secondary" onclick="goToPreviousStep()">Previous</button>
                                        <button type="button" class="btn btn-primary" onclick="savePolicyAmount()">Save Policy Amount & Generate Payment Link </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                          <!-- Add additional form sections for other steps -->
                               <div id="step-5" class="form-section">
                                <div class="card">
                                    <div class="card-header">Step 5: Payments</div>
                                    <div class="card-body">
                                        <form>
                                          
                                            

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php include "../navigation/right-side-navigation.php"; ?>
        </div>
        <?php include "../include/common-script.php"; ?>

           <!-- Modal for Payment Link -->
<div id="paymentLinkModal" class="modal fade" tabindex="-1" aria-labelledby="paymentLinkModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentLinkModalLabel">Payment Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your payment link is:</p>
                <div class="input-group">
                    <input type="text" id="paymentLink" readonly class="form-control" />
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
        <script>
                  
</script>
<!-- // step -4 -->


<script>
// Function to display selected plans dynamically
async function displaySelectedPlans() {
    var PolicyNumber = localStorage.getItem("PolicyNumber");


    if (!PolicyNumber) {
    Alert("Policy Number not found. Please complete the All steps.");
    goToPreviousStep(); // Navigate to the previous step
    return false;
}

    try {
        // Fetch all plans by PolicyNumber
        const response = await $.ajax({
            url: "include/fetch-plans-by-policy.php",
            type: "POST",
            data: { policy_number: PolicyNumber }
        });

        // Parse the response into an array of plans
        const plans = JSON.parse(response); // Assuming the response is a JSON array of plan details
        console.log("Fetched all Plans: ", plans);

        if (plans.length === 0) {
            // If no plans are found, clear the container
            document.getElementById("selected-plans-container").innerHTML = "<p>No plans found.</p>";
            document.getElementById("total-amount").textContent = "₹0.00";
            return;
        }

        let totalAmount = 0;
        let plansHTML = '<ul class="list-group">';

        // Loop through each plan and fetch the corresponding plan details
        for (const plan of plans) {
            try {
                // Fetch the plan details based on PlanID
                const planDetailsResponse = await $.ajax({
                    url: "include/fetch-plan-details.php",
                    type: "POST",
                    data: { plan_id: plan.PlanID }
                });

                // Parse the plan details response
                const planDetails = JSON.parse(planDetailsResponse); // Assuming the response contains plan details

                if (planDetails.length > 0) {
                    const planCost = planDetails[0]?.PlanCost; // Get the PlanCost from the first detail
                    const planName = planDetails[0]?.PlanName;
                    console.log("Plan ID: " + plan.PlanID + " - Plan Cost: " + planCost);

                    if (planCost) {
                        totalAmount += parseFloat(planCost); // Add the plan cost to the total amount
                        const formattedCost = `₹${parseFloat(planCost).toLocaleString('en-IN')}`; // Formatting to INR
                        plansHTML += `
                            <li class="list-group-item d-flex justify-content-between">
                                <span>${planName}</span>
                                <span>${formattedCost}</span>
                            </li>
                        `;
                    }
                } else {
                    alert("No details found for Plan ID " + plan.PlanID);
                }
            } catch (error) {
                alert("Error fetching details for Plan ID " + plan.PlanID + ". Please try again.");
            }
        }

        plansHTML += '</ul>';
        document.getElementById("selected-plans-container").innerHTML = plansHTML;

        // Update the total amount
        document.getElementById("total-amount").textContent = `₹${totalAmount.toFixed(2)}`;

    } catch (error) {
        alert("Error fetching plans. Please try again.");
        console.error("Error:", error);
    }
}

// Function to handle navigation to step 4
function navigateToStep4() {
    // Call the function to display the selected plans
    displaySelectedPlans();

    // Show Step 4 and hide others (example logic, adjust according to your setup)
    document.querySelectorAll(".form-section").forEach(section => {
        section.style.display = "none";
    });
    document.getElementById("step-4").style.display = "block";
}

// Example: Call this function when navigating to Step 4
document.querySelector("#step4-button").addEventListener("click", navigateToStep4);



// Proceed to payment function
async function savePolicyAmount() {
    var PolicyNumber = localStorage.getItem("PolicyNumber");

    
    var plans = [];

    try {
        // AJAX call to fetch plans associated with the PolicyNumber
        const response = await $.ajax({
            url: "include/fetch-plans-by-policy.php",
            type: "POST",
            data: { policy_number: PolicyNumber }
        });

        plans = JSON.parse(response); // Assume the response is a JSON array of plan details
        console.log("Fetched all Plans: ", plans);
        
        if (plans.length > 0) {
            let totalAmount = 0;

            // Loop through each plan and fetch plan details
            for (const plan of plans) {
                try {
                    const planDetailsResponse = await $.ajax({
                        url: "include/fetch-plan-details.php",
                        type: "POST",
                        data: { plan_id: plan.PlanID }
                    });

                    const planDetails = JSON.parse(planDetailsResponse); // Assume the response contains plan details

                    if (planDetails.length > 0) {
                        const planprice = planDetails[0]?.PlanCost; // Get the PlanCost
                        console.log("Plan ID: " + plan.PlanID + " - Plan Cost: " + planprice);

                        if (planprice) {
                            totalAmount += parseFloat(planprice); // Ensure Price is a number
                        }
                    } else {
                        alert("No details found for Plan ID " + plan.PlanID);
                    }
                } catch (error) {
                    alert("Error fetching details for Plan ID " + plan.PlanID + ". Please try again.");
                }
            }

            // Prepare data to send, including totalAmount
            const paymentData = {
                PolicyNumber: PolicyNumber,
                Amount: totalAmount
            };

            // Save the data via fetch
            const paymentResponse = await fetch('include/save_customer_policy_amount.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(paymentData)
            });

             localStorage.removeItem("PolicyNumber");
                localStorage.removeItem("customer_id");

            const paymentDataJson = await paymentResponse.json();
                console.log('paymentdata', paymentDataJson);

                // Check if error is false
                if (paymentDataJson.error === false) {
                    Alert("Payment data saved successfully!");
                    // Redirect to payment gateway or confirmation page
                     generatePaymentLink(paymentDataJson.PolicyNumber);
                    // window.location.href = "payment-confirmation.php";
                } else {
                    alert("Error saving payment data: " + paymentDataJson.message);
                }
                        } else {
            alert("No plans found for the given Policy Number.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Error fetching plans. Please try again.");
    }
}






        </script>
    </div>
</body>
</html>
