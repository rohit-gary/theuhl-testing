<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

@session_start();
require_once "../include/autoloader.inc.php";
// print_r($_SESSION);
// die();
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

    $customerForm = isset($_SESSION['customer_form']) ? $_SESSION['customer_form'] : [];
    $policyForm = isset($_SESSION['policy_form']) ? $_SESSION['policy_form'] : [];
    $Customerid = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';
    $Action = isset($_SESSION['action']) ? $_SESSION['action'] : '';
    $PolicyFormId=isset($_SESSION['policy_form_Id']) ? $_SESSION['policy_form_Id'] : '';
    $PolicyNumber=isset($_SESSION['PolicyNumber']) ? $_SESSION['PolicyNumber'] : '';
    $policy_form_action=isset($_SESSION['policy_form_action']) ? $_SESSION['policy_form_action'] : '';
    $FamilyMemberDetails= isset($_SESSION['family_member']) ? $_SESSION['family_member'] : '';     
    // print_r($FamilyMemberDetails);
    // print_r($Customerid);
 
     $selectedGender = isset($customerForm['gender']) ? $customerForm['gender'] : ''; 

     
     $selectedPlans = isset($policyForm['plans']) ? $policyForm['plans'] : [];
     // print_r($policyForm);
     // die();
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../theme-assets/plugins/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="../theme-assets/plugins/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='../theme-assets/plugins/richtexteditor/plugins/all_plugins.js'></script>
    <link rel="stylesheet" type="text/css" href="../project-assets/css/add-new-policy.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">

     <style>



    </style>
</head>

<body class="app sidebar-mini ltr light-mode">

    <div id="confetti-container"></div>
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

                                        <div class="step-box">
                                            <span class="step-number">5</span>
                                            <p class="step-title">Document Upload</p>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- Form Sections -->
                            <div id="step-1" class="form-section active">
                                <div class="card">
                                    <div class="card-header">Step 1: Basic Details</div>
                                    <div class="card-body">
                                       <?php include("include/step_one.php") ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Add additional form sections for other steps -->
                              <div id="step-2" class="form-section">
                            <div class="card">
                                <div class="card-header">Step 2: Choose Policy</div>
                                <div class="card-body">
                                           <?php include("include/step_two.php") ?>

                                        </div>
                                    </div>
                                </div>


                             <!-- Add additional form sections for other steps &nbsp;<button type="button" class="btn btn-success" onclick="fetchPlansAndGenerateForms()">Fetch Member Form</button> -->
                               <div id="step-3" class="form-section" >
                                <div class="card">
                                    <div class="card-header">Step 3: Member Details </div>
                                    <div class="card-body">
                                         <?php include("include/step_three.php") ?>     
                                    </div>
                                </div>
                            </div>


                            <!-- Add additional form sections for other steps -->
                               <div id="step-4" class="form-section">
                            <div class="card">
                                <div class="card-header">Step 4: Purchase Summary</div>
                                <div class="card-body">
                                    <?php include("include/step_four.php") ?> 
                                </div>
                            </div>
                        </div>


                          <!-- Add additional form sections for other steps -->
                                <div id="step-5" class="form-section">
                            <div class="card shadow">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Step 5: Upload Documents</h5>
                                </div>

                                    <div class="card-body">
                                          <?php include("include/step_five.php") ?>          
                                    </div>

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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
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

<!-- ----------------------------------------------------- -->






<!-- -----------------------------model for add more family member------------------------------ -->

<div class="modal fade" id="familyMemberModal" tabindex="-1" aria-labelledby="familyMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="familyMemberModalLabel">Add Family Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form id="familyMemberForm">
                       <input type="hidden" id="ad_form_action" name="form_action"/>
                       <input type="hidden" id="ad_form_id" name="form_id" />
                     <!-- Plan Select Element -->
                          <label for="familyMemberSelect" class="form-label fw-bold d-flex align-items-center">
                            Select Plan 
                            <span 
                                id="refreshBadgePlan" 
                                class="badge bg-primary ms-2" 
                                style="cursor: pointer;" 
                                title="Click to refresh Plan"
                            >
                                Refresh
                            </span>
                        </label>
                            <select class="form-control" id="planSelect" name="planSelect" required>
                                <option value="" disabled selected>Select Plan</option>
                                <!-- Options will be populated dynamically here -->
                                <!-- <?php include("../include/get-plans-new.php"); ?> -->
                            </select>


                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ad_member_name" name="member_name" placeholder="Enter family member's name" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="ad_member_dob" name="member_dob" required>
                    </div>

                    <!-- Gender -->
                    <div class="form-group mb-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="ad_member_gender_male" name="member_gender" value="male" required>
                            <label class="form-check-label" for="member_gender_male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="ad_member_gender_female" name="member_gender" value="female" required>
                            <label class="form-check-label" for="ad_member_gender_female">Female</label>
                        </div>
                    </div>

                    <!-- Relationship -->
                    <div class="form-group mb-3">
                        <label class="form-label">Relationship <span class="text-danger">*</span></label>
                        <select class="form-control" id="ad_member_relationship" name="member_relationship" required>
                            <option value="" disabled selected>Select Relationship</option>
                            <option value="MySelf">MySelf</option>
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                            <option value="spouse">Spouse</option>
                            <option value="son">Son</option>
                            <option value="daughter">Daughter</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
                <button type="submit" class="btn btn-primary" onclick="saveAdditionalFamilyMember()"form="familyMemberForm">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------------------------------- -->







<script>
let customer_id_1 =<?php echo  $Customerid ?>     
</script>
<script src="../project-assets/other-assets/date-picker/bootstrap-datepicker.js"></script>
<script src="../project-assets/js/customer-policy.js"></script>


<script>

// Function to display selected plans dynamically
async function displaySelectedPlans() {
    var PolicyNumber=$("#PolicyNumber").val();
    

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
                    Alert("No details found for Plan ID " + plan.PlanID);
                }
            } catch (error) {
                Alert("Error fetching details for Plan ID " + plan.PlanID + ". Please try again.");
            }
        }

        plansHTML += '</ul>';
        document.getElementById("selected-plans-container").innerHTML = plansHTML;

        // Update the total amount
        document.getElementById("total-amount").textContent = `₹${totalAmount.toFixed(2)}`;

    } catch (error) {
        Alert("Error fetching plans. Please try again.");
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
$('#gotofifthstep').hide();
async function savePolicyAmount() {
    
      var PolicyNumber=$("#PolicyNumber").val();
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
                        Alert("No details found for Plan ID " + plan.PlanID);
                    }
                } catch (error) {
                    Alert("Error fetching details for Plan ID " + plan.PlanID + ". Please try again.");
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

            

            const paymentDataJson = await paymentResponse.json();
                // console.log('paymentdata', paymentDataJson);

                // Check if error is false
                if (paymentDataJson.error === false) {
                    Alert("Payment data saved successfully!");
                    $('#gotofifthstep').show();
                    // Redirect to payment gateway or confirmation page
                     generatePaymentLink(paymentDataJson.PolicyNumber);
                    // window.location.href = "payment-confirmation.php";
                } else {
                    Alert("Error saving payment data: " + paymentDataJson.message);
                }
                        } else {
            Alert("No plans found for the given Policy Number.");
        }
    } catch (error) {
        console.error("Error:", error);
        Alert("Error fetching plans. Please try again.");
    }
}
</script>
  

 <script type="text/javascript">
     
 // uplode files

// document.addEventListener('DOMContentLoaded', function() {
//     const uploadArea = document.getElementById('upload-area');
//     const fileInput = document.getElementById('fileInput');
//     const browseFilesBtn = document.getElementById('browseFilesBtn');
//     const fileList = document.getElementById('fileList');
//     const uploadBtn = document.getElementById('uploadBtn');
  
//     let selectedFiles = [];


     

//     // Handle click to open file browser
//     browseFilesBtn.addEventListener('click', () => fileInput.click());

//     // Handle file input change
//     fileInput.addEventListener('change', function(e) {
//         handleFiles(e.target.files);
//     });

//     // Drag and Drop Events
//     uploadArea.addEventListener('dragover', (e) => {
//         e.preventDefault();
//         uploadArea.classList.add('dragover');
//     });

//     uploadArea.addEventListener('dragleave', () => {
//         uploadArea.classList.remove('dragover');
//     });

//     uploadArea.addEventListener('drop', (e) => {
//         e.preventDefault();
//         uploadArea.classList.remove('dragover');
//         handleFiles(e.dataTransfer.files);
//     });

//     // Handle files and display preview
//     function handleFiles(files) {
//         Array.from(files).forEach(file => {
//             if (!fileAlreadyAdded(file.name)) {
//                 selectedFiles.push(file);
//                 displayFile(file);
//             }
//         });
//     }

//     // Check if file is already added
//     function fileAlreadyAdded(fileName) {
//         return selectedFiles.some(file => file.name === fileName);
//     }

//     // Display file preview
//     function displayFile(file) {
//         const listItem = document.createElement('li');
//         listItem.classList.add('list-group-item');
//         listItem.innerHTML = `
//             <span class="file-name">${file.name}</span>
//             <button class="btn btn-sm remove-file-btn" data-name="${file.name}">
//                 <i class="fa fa-times"></i> Remove
//             </button>
//         `;
//         fileList.appendChild(listItem);

//         // Remove file event
//         listItem.querySelector('.remove-file-btn').addEventListener('click', (e) => {
//             const fileName = e.target.closest('button').dataset.name;
//             removeFile(fileName);
//             fileList.removeChild(listItem);
//         });
//     }

//     // Remove file from array
//     function removeFile(fileName) {
//         selectedFiles = selectedFiles.filter(file => file.name !== fileName);
//     }

    // Handle file upload
    document.getElementById('uploadBtn').addEventListener('click', () => {
    var documentType = document.getElementById('documentType').value;
    var familyMemberSelect = document.getElementById('familyMemberSelect').value;

    if (!familyMemberSelect) {
        Alert('Please select a family member before uploading files.');
        return;
    }

    var PolicyNumber = $("#PolicyNumber").val();
    // console.log('PolicyNumber Found:', PolicyNumber);

    // Prepare FormData with all form fields and selected files
    let myForm = document.getElementById("upload-documents-form");
    var formData = new FormData(myForm);

    // Logging FormData for debugging
    for (let [key, value] of formData.entries()) {
        console.log(`${key}:`, value);
    }

    // Perform AJAX request
    $.ajax({
        url: "action/upload-documents-new.php",
        type: "POST",
        data: formData,
        success: function (data) {
            Alert('Files uploaded successfully');
            $('#fileList').empty();  // Clear file list
        },
        error: function (jqXHR, textStatus, errorThrown) {
            Alert('Error uploading files');
            console.error('Error:', textStatus, errorThrown);
        },
        cache: false,
        contentType: false,
        processData: false,
    });
});

 

    </script>



    <script type="text/javascript">
        

        document.addEventListener('DOMContentLoaded', function () {
    // Initial call to populate family members when the page loads
    fetchFamilyMembers();
    
    // Event listener for clicking the "Refresh" badge
    document.getElementById('refreshBadge').addEventListener('click', function () {
        // Optionally, you can show a loading state
        this.textContent = 'Loading...';
        this.classList.add('bg-warning');

        // Call the fetch function to reload family members
        fetchFamilyMembers().then(() => {
            this.textContent = 'Refresh';
            this.classList.remove('bg-warning');
            this.classList.add('bg-primary');
        });
    });
});

async function fetchFamilyMembers() {
    try {
        const response = await fetch('include/get-family-members.php');
        const data = await response.json();

        if (data.length > 0) {
            populateFamilyMemberSelect(data);
        } else {
            console.log('No family members found.');
        }
    } catch (err) {
        console.error('Error fetching family members:', err);
    }
}

function populateFamilyMemberSelect(data) {
    const selectElement = document.getElementById('familyMemberSelect');
    selectElement.innerHTML = '<option value="">Select a family member</option>'; // Reset the options
    
    data.forEach(member => {
        const option = document.createElement('option');
        option.value = member.ID; // Use PolicyCustomerID for the option value
        option.textContent = member.Name; // Display the Name in the option
        selectElement.appendChild(option);
    });
}

    </script>
</body>
</html>




<script>
  
    document.addEventListener('DOMContentLoaded', function () {
   
        
    
    document.getElementById('refreshBadgePlan').addEventListener('click', function () {
       
        this.textContent = 'Loading...';
        this.classList.add('bg-warning');

       
        fetchPlans().then(() => {
            this.textContent = 'Refresh';
            this.classList.remove('bg-warning');
            this.classList.add('bg-primary');
        });
    });
});


async function fetchPlans() {
    try {
        const response = await fetch('include/get-plans.php'); 
        const data = await response.json();       
        if (Array.isArray(data)) {
            console.log('Data is an array:', data);
            populatePlanSelect(data);
        } else {
            console.error('Data is not an array:', data);
        }
    } catch (err) {
        console.error('Error fetching plans:', err);
    }
}

// Populate the select input with options based on the fetched plans
function populatePlanSelect(plans) {
    const planSelect = document.getElementById('planSelect'); 
    planSelect.innerHTML = '<option value="" disabled selected>Select Plan</option>';
         plans.forEach(plan => {
        const option = document.createElement('option');        
        option.value = plan.ID;  
        option.textContent = plan.PlanName;  
        planSelect.appendChild(option);
        console.log('options', option);
    });
}


</script>


<script type="text/javascript">

let documentCounter = 1;

function addFileInput(formIndex) {
    const container = document.getElementById(`documents_container_${formIndex}`);
    
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2');

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.classList.add('form-control');
    fileInput.name = 'policy_documentss[]';
    fileInput.id = `documents_${formIndex}_${documentCounter}`;

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-outline-danger');
    removeButton.textContent = '-';
    removeButton.onclick = function () {
        container.removeChild(inputGroup);
    };

    inputGroup.appendChild(fileInput);
    inputGroup.appendChild(removeButton);
    container.appendChild(inputGroup);

    documentCounter++;
}

function addFileInputMember(formIndex) {
    const container = document.getElementById(`documents_container_member_${formIndex}`);
    
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2');

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.classList.add('form-control');
    fileInput.name = 'policy_documentss[]';
    fileInput.id = `documents_member_${formIndex}_${documentCounter}`;

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-outline-danger');
    removeButton.textContent = '-';
    removeButton.onclick = function () {
        container.removeChild(inputGroup);
    };

    inputGroup.appendChild(fileInput);
    inputGroup.appendChild(removeButton);
    container.appendChild(inputGroup);

    documentCounter++;
}

function getDocumentsArray(index) {
    const filesArray = [];
    // Select all file inputs within the specific form using the index
    const fileInputs = document.querySelectorAll(`#policyDocumentss_form_${index} input[name='policy_documentss[]']`);
    
    // Loop through each file input and check if any file is selected
    fileInputs.forEach(input => {
        if (input.files.length > 0) {
            // Store the file object (considering that multiple files might be selected)
            for (let file of input.files) {
                filesArray.push(file);
            }
        }
    });
    return filesArray;
}


    $("#UplodeDocumentssBtn").html("upload");

function AddUploade(index) {
    // Check if at least one document is uploaded, validate each file size and type
    const fileInputs = document.querySelectorAll(`#policyDocumentss_form_${index} input[name='policy_documentss[]']`);
    let fileSelected = false;
    const maxFileSize = 10 * 1024 * 1024; // 10 MB in bytes
    const allowedTypes = [
        'application/pdf', // PDF files
        'application/msword', // DOC files
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOCX files
        'image/jpeg', // JPG files
        'image/png' // PNG files
    ];

    // Iterate over the file inputs
    for (let input of fileInputs) {
        if (input.files.length > 0) {
            fileSelected = true;
            for (let file of input.files) {
                // Check file size
                if (file.size > maxFileSize) {
                    Alert("Each document must be less than 10 MB. Please check your files and try again.");
                    return false;
                }
                // Check file type
                if (!allowedTypes.includes(file.type)) {
                    Alert("Only PDF or DOC files are allowed. Please upload valid documents.");
                    return false;
                }
            }
        }
    }

    if (!fileSelected) {
        Alert("Please upload at least one document.");
        return false;
    }

    // Update button text to indicate loading
    $("#UplodeDocumentssBtn_" + index).html("Please Wait..");

    // Create a new FormData object to handle file uploads
    let formData = new FormData(document.getElementById("policyDocumentss_form_" + index));

    // Make AJAX request with FormData
    $.ajax({
        url: "action/upload-documents.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from converting data
        contentType: false,  // Set content type to false to let browser set it automatically
        success: function(data) {
            var response = JSON.parse(data);
            Alert(response.message);
            if (response.error == false) {
                setTimeout(function() {
                    // Additional actions after successful upload, if needed
                    location.reload();
                }, 1500);
                $("#UplodeDocumentssBtn_" + index).html("UplodeAgain");
                $('#policyDocumentss_form_' + index)[0].reset(); // Reset the form after success
            } else {
                $("#UplodeDocumentssBtn_" + index).html("UplodeAgain");
            }
        },
        error: function(xhr, status, error) {
            Alert("An error occurred while submitting the form. Please try again.");
            $("#UplodeDocumentssBtn_" + index).html("Uplode");
        }
    });
    return false;
}


</script>


<!-- ----datepicker--------- -->
<script type="text/javascript">
    $(document).ready(function() {
    
    $('#dob').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: new Date(new Date().getFullYear() - 75, new Date().getMonth(), new Date().getDate()),
        endDate: new Date() // Prevents selection of future dates
    });
});

</script>


