

function isValidEmail(email) {
    // Regular expression to check if the email is valid
    var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;

    // Test theisValidEmail email against the regular expression
    return emailRegex.test(email);
}

function validaphone(phone) {
    var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    if (!regex.test(phone)) {
        return false;
    } else {
        return true;
    }
}


function validISNumber(basic) {
    const input = event.target;
    let value = input.value;

    value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
    input.value = value;
}

function validateNumericInput(input) {
    input.value = input.value.replace(/[^0-9+-]/g, ''); // Allow digits, '+' and '-'
    // Ensure '+' or '-' only appears at the start of the input
    if (input.value.match(/[+-]/g)?.length > 1 || !/^[-+]?\d*$/.test(input.value)) {
        input.value = input.value.slice(0, -1); // Remove invalid character
    }
}

function generateFamilyMemberForm() {
    var memberCount = document.getElementById('familyMemberCount').value;
    var container = document.getElementById('familyMemberFormsContainer');

    var maxFamilyMembers = document.getElementById('planFamilyMemberInput').value;

     var minFamilyMembers = document.getElementById('planMinFamilyMemberInput').value;
     console.log('ffdfd',minFamilyMembers);
       
        if(memberCount<(minFamilyMembers-1)){
        Alert(`You must enter details for at least ${minFamilyMembers} family member(s).`);
        return false;
    }

    if(memberCount>(maxFamilyMembers)){
        Alert(`You can Add only ${(maxFamilyMembers-1)} Family Member  , Thank You`);
        return;
    }
    
    // Clear the previous forms
    container.innerHTML = '';
    
    // Loop to create form fields for each family member
    for (var i = 1; i <= memberCount; i++) {
        // Start a new row every two cards
        if (i % 2 === 1) {
            container.innerHTML += `<div class="row mb-3">`;
        }
        
        var memberForm = `
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Family Member ${i}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="member_name_${i}" placeholder="Enter family member's name" >
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth <span class="text-red">*</span></label>
                        <input type="date" class="form-control" name="member_dob_${i}" >
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Gender <span class="text-red">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="member_gender_${i}" value="male" >
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="member_gender_${i}" value="female" >
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Relationship <span class="text-red">*</span></label>
                        <select class="form-control" name="member_relationship_${i}" >
                            <option value="" disabled selected>Select Relationship</option>
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
                </div>
            </div>
        </div>
        `;

        // Append the card to the container
        container.innerHTML += memberForm;

        // Close the row after every two cards or if it’s the last card
        if (i % 2 === 0 || i === memberCount) {
            container.innerHTML += `</div>`;
        }
    }
}



var editor;
function UpdateFaqs_modal(faq_id) {

    $("#addFaqsBtn").html("Update");
    $("#FaqsHeading").html("Update Faq Details");

    $.post("ajax/get_faqs_details.php", {
        ID: faq_id
    },
        function (data, status) {
            var response = JSON.parse(data);
           
            


                if (Array.isArray(response.data)) {
                    var faqData = response.data[0];  
                } else {
                    var faqData = response.data;
                }
            if (response.error == false) {
                $("#Question").val(faqData.Question);


                 if (!editor) {
                editor = new RichTextEditor("#Answer");
            }
               
                 editor.setHTMLCode(faqData.Answer);
                    $("#form_action").val("Update");
                    $("#form_id").val(faq_id);
            }
        });
    $("#add_faqs").modal("show");
}

 $(document).ready(function () {
    
    $("#customer_policy_form")[0].reset();

   
   $("#add_faqs").modal("show");
   
    // $("#addCusPolicyBtn").text("Create Policy");
    $("#addCusPolicyBtn").text("Save Policy & Generate Payment Link");
   
    $("#form_id").val('-1');

    
    editor.setHTML('');
});

function AddUpdateCustomerPolicyForm() {
   

    var PocName = $("#poc_name").val();
    if (PocName == "") {
        Alert("Please Enter  POC Name");
        return false;
    }

    var PocNumber = $("#poc_contact_number").val();
    if (PocNumber == "") {
        Alert("Please Enter POC Contact Number.");
        return false;
    }


    if(!validaphone(PocNumber)){
        Alert("Please Enter Valid  Contact Number.");
        return false;
    }

     var gender = $("input[name='gender']:checked").val();
  
       
    
     if (gender === undefined || gender === null) {
        Alert("Please select an option for Gender");
        return false;
    }


    var dob = $("#dob").val();
    if (dob == "") {
        Alert("Please Enter  POC DOB");
        return false;
    }

    var email = $("#email").val();
    if (email == "") {
        Alert("Please Enter POC Email.");
        return false;
    }


    var Address = $("#address").val();
    if (Address == "") {
        Alert("Please Enter  POC Address");
        return false;
    }

    var state = $("#state").val();
    if (state == "") {
        Alert("Please Enter POC state");
        return false;
    }  

    var issue_date=$("#issue_date").val();
    if(issue_date==''){
         Alert("Please Enter  POC issue_date");
        return false;
    }


    var buyingFor = $("input[name='buying_for']:checked").val();

     const planMinFamilyMember = $("#planMinFamilyMemberHidden").val();
    

    // var buyingFor = 'MySelf';
    if (buyingFor==undefined || buyingFor==null) {
        Alert("Please select an option for Buying Plan For");
        return false;
    }

    if(buyingFor=='other'){
        var familyMemberCount= $('#familyMemberCount').val();

        if(familyMemberCount==''){
          Alert("Please provide family member");
        return false;
        }




            for (var i = 1; i <= familyMemberCount; i++) {
            var name = $(`input[name='member_name_${i}']`).val();
            var dob = $(`input[name='member_dob_${i}']`).val();
            // var age = $(`input[name='member_age_${i}']`).val();
            var gender = $(`input[name='member_gender_${i}']:checked`).val();
            var relationship = $(`select[name='member_relationship_${i}']`).val();

            
            if (!name || !dob  || !gender || !relationship) {
                Alert(`Please fill out all fields for Family Member ${i}.`);
                return false;
            }
        }
        }


         
        var pincode = $("#pincode").val();
        if (pincode == "") {
            Alert("Please Enter POC Pincode.");
            return false;
        }
        
         
        let form_action = $("#form_action").val();
        let btntext = "";
        if (form_action == "add") {
            btntext = "Add";
        } else {
            btntext = "Update";
        }



    let myForm = document.getElementById("customer_policy_form");
    var formData = new FormData(myForm);
    formData.forEach(function(value, key){
    
});
     $("#addCusPolicyBtn").html("Please Wait..");
    $.ajax({
        url: "action/add-update-policy-customer.php",
        type: "POST",
        data: formData,
        success: function (data) {
            var response = JSON.parse(data);
            var PolicyID=response.last_insert_id;
            Alert(response.message,'Please Wait for PaymentLink Doc');
            
            if (response.error == false) {
             setTimeout(function(){      
                var paymentLink = 'https://unitedhealthlumina.com//pay-booking-amount?id=' + PolicyID;
                $('#paymentLink').val(paymentLink);

                $('#paymentLink').val(paymentLink);

                  $.ajax({
                        url: "action/send-payment-link-email.php",
                        type: "POST",
                        data: { email: $("#email").val(), paymentLink: paymentLink },
                        success: function(emailResponse) {
                           
                            if (emailResponse.errorp == false) {
                                Alert(emailResponse.message);
                            } else {
                                 Alert(emailResponse.message);
                            }
                        }
                    });

                    
                       // Start checking the payment status every 5 seconds
                       var checkPaymentStatusInterval = setInterval(function() {
                        $.ajax({
                            url: "action/check-payment-status.php", // Add your API or PHP script to check payment status
                            type: "POST",
                            data: { PolicyID: PolicyID },
                            success: function(statusResponse) {
                                var paymentStatus = JSON.parse(statusResponse);
                               

                                if (paymentStatus.error == false) {
                                    clearInterval(checkPaymentStatusInterval); // Stop the interval
                                    Alert("Thank you for your payment! Your payment was successful.");
                                    setTimeout(function() {
                                        location.reload(); // Reload the page after 10 seconds
                                    }, 4000); // 10 seconds delay
                                }
                            }
                        });
                    }, 5000); // Check every 5 seconds
           
           // Show the modal
           $('#paymentLinkModal').modal('show');

           // Copy to clipboard functionality
           $("#copyLinkBtn").click(function() {
               var copyText = document.getElementById("paymentLink");
               copyText.select();
               document.execCommand("copy");
               Alert('Payment link copied to clipboard');
           });

           // Share via Email functionality
           $("#shareLinkEmailBtn").click(function() {
               var subject = "Payment Link";
               var body = "Please make the payment using this link: " + paymentLink;
               window.location.href = "mailto:?subject=" + subject + "&body=" + body;
           });

           // Share on WhatsApp functionality
           $("#shareLinkWhatsappBtn").click(function() {
               var whatsappUrl = "https://wa.me/?text=" + encodeURIComponent("Please make the payment using this link: " + paymentLink);
               window.open(whatsappUrl, "_blank");
           });

                },1000)
               
            }else{
                 $("#addCusPolicyBtn").html('Please Wait..');
                
            }
            
        },
        cache: false,
        contentType: false,
        processData: false,
    });

    // Close modal when the close button is clicked
    $('#paymentLinkModal .btn-close').on('click', function() {
        $('#paymentLinkModal').modal('hide');
    });
    return false;
 
}


function DeletePolicy(policy_id) {
    alertify.confirm(
        
        "Do you really want to delete Policy Customer?",
        function () {
            $.post(
                "action/delete-policy.php",
                {
                    ID: policy_id,
                },
                function (data, status) {
                    var response = JSON.parse(data);
                    Alert(response.message);
                    if (response.error == false) {
                        setInterval(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            );
        },
        function () {
            alertify.error("Deletion Cancelled");
        }
    );
}


function DownloadePolicyDoc(Id) {


   $.ajax({
        url: "include/check-payment-status.php", // Add your API or PHP script to check payment status
        type: "POST",
        data: {Id: Id,},
        success: function(statusResponse) {
            var paymentStatus = JSON.parse(statusResponse);
            if (paymentStatus.error == false) {
                alertify.confirm("United Health Lumina",
        "Do you really want to download the Policy Customer Doc?",
        function () {
            $.post(
                "include/create-policy-doc.php",
                {
                    Id: Id,
                },
                function (data, status) {
                  
                    alertify.success("Document is being prepared for download.");

                    
                    setTimeout(function () {
                        window.open('include/create-policy-doc.php?Id=' + Id, '_blank');
                    }, 1000); 
                }
            ).fail(function (xhr, status, error) {
                
                alertify.error("An error occurred while preparing the document.");
            });
        },
        function () {
            alertify.error("Cancelled");
        }
    );
            }else{
                Alert(paymentStatus.message);
            }
        }
    });
   
}



function toggleMemberNumber(show) {
    var memberNumberDiv = document.getElementById('memberNumberDiv');
    var memberNumberInput = document.getElementById('memberNumber');
    
    if (show) {
        memberNumberDiv.style.display = 'block';
       
    } else {
        memberNumberDiv.style.display = 'none';
        
    }
}



function viewPlanDetails(){
    
}

document.addEventListener('DOMContentLoaded', function() {
    function planSelected(planDropdown) {
        const selectedOption = planDropdown.options[planDropdown.selectedIndex];
        const planCost = selectedOption.getAttribute('data-cost');
        const planDurationFormat = selectedOption.getAttribute('data-duration-format');
        const planDuration = selectedOption.getAttribute('data-duration');
        const planFamilyMember = selectedOption.getAttribute('data-family-member'); // Get family member count

        const planMinFamilyMember = selectedOption.getAttribute('data-min-family-member'); // Get family member count

        const buyingPlanOptions = document.getElementById("buying_for_other_div");



         if (planFamilyMember > 1) {
        buyingPlanOptions.style.display = "block";
    } else {
        buyingPlanOptions.style.display = "none";
    }


        // Check if all values are retrieved correctly
        if (planCost !== null && planDurationFormat !== null && planFamilyMember !== null) {
            // Enable 'See Plan Details' button
            document.getElementById('viewPlanDetailsBtn').disabled = false;

            // Show the plan cost, duration format, and family member count
            document.getElementById('planCostInput').value = `₹${planCost}`;
            document.getElementById('planCostHidden').value = planCost;
            document.getElementById('planDurationInput').value = planDuration; 
            document.getElementById('planDurationHidden').value = planDuration;
            document.getElementById('planDurationFormatInput').value = planDurationFormat; 
            document.getElementById('planDurationFormatHidden').value = planDurationFormat; 
            document.getElementById('planFamilyMemberInput').value = planFamilyMember; // Display family members covered
            document.getElementById('planFamilyMemberHidden').value = planFamilyMember;
            document.getElementById('planMinFamilyMemberInput').value = planMinFamilyMember;
            document.getElementById('planMinFamilyMemberHidden').value = planMinFamilyMember;

            // Show the fields
            document.getElementById('planCostDisplay').style.display = 'block';
            document.getElementById('planFamilyMemberDisplay').style.display = 'block';
        } else {
            console.error('Plan cost, duration format, or family member count not found for selected option.');
        }
    }

    // Make sure the function is available globally
    window.planSelected = planSelected;
});

/// -----new js for new form --------------------------------------------------------


                    let currentStep = 1;
                    // if (localStorage.getItem('currentStep') !== null) 
                    // {
                    //     currentStep = localStorage.getItem('currentStep');
                    //     console.log(currentStep);
                    // } 
                    function goToNextStep() 
                    {
                     // alert(currentStep);
                        // localStorage.setItem('currentStep',parseInt(currentStep) + 1);
                        goToStep(currentStep + 1);
                    }

                    function goToPreviousStep() {
                        // localStorage.setItem('currentStep',parseInt(currentStep) + 1);
                        goToStep(currentStep - 1);
                    }

                    function goToStep(step) {
                        const steps = document.querySelectorAll(".step-box");
                        const sections = document.querySelectorAll(".form-section");

                        if (step > 0 && step <= steps.length) {
                            // Remove the 'active' class from the current step and section
                            steps[currentStep - 1].classList.remove("active");
                            sections[currentStep - 1].classList.remove("active");

                            // Mark the current step as completed if moving forward
                            if (step > currentStep) {
                                steps[currentStep - 1].classList.add("completed");
                                steps[currentStep - 1].classList.remove("inactive");
                            } 
                            // If returning, mark it as inactive
                            else if (step < currentStep) {
                                steps[currentStep - 1].classList.add("inactive");
                                steps[currentStep - 1].classList.remove("completed");
                            }

                                // Add the 'active' class to the new step and section
                                steps[step - 1].classList.add("active");
                                sections[step - 1].classList.add("active");
                               displayUploadDocumentForm();
                                currentStep = step;
                                if (step === 3) {
                                        fetchPlansAndGenerateForms();

                                    }
                                    if (step === 4) {
                                        displaySelectedPlans();

                                    }
                                    if(step === 5)
                                    {
                                        displayUploadDocumentForm();
                                        
                                    }
                            }
                        }

                    // Add click event listener for steps to go directly to a particular step
                    // document.querySelectorAll(".step-box").forEach((stepBox, index) => {
                    //     stepBox.addEventListener("click", () => goToStep(index + 1));
                    // });

                    // Function to upload document form
                    function displayUploadDocumentForm()
                    {
                        $.post("ajax/upload_documents_form.php", {
                            
                        },
                        function(data, status) {
                            
                            document.getElementById("member_document_upload_form").innerHTML = data;
                            
                        });
                    }

                    // function for add Additionalfamilymember form

                    //  function displayAdditionalMemberForm()
                    // {
                    //     $.post("ajax/save-Additionalfamily-members.php", {
                            
                    //     },
                    //     function(data, status) {
                            
                    //         document.getElementById("member_add_form").innerHTML = data;
                            
                    //     });
                    // } 

                 // Function to toggle card selection and display green check mark with opacity
                    function togglePlanSelection(planID) {
                        // Get the selected card and check mark
                        let selectedCard = document.getElementById('plan-card-' + planID);
                        let checkMark = selectedCard.querySelector('.check-mark');
                        let checkbox = selectedCard.querySelector('input[type="checkbox"]');

                        // If the card is not selected, select it
                        if (!selectedCard.classList.contains('selected')) {
                            selectedCard.classList.add('selected'); // Add selected style
                            checkMark.style.display = 'block'; // Show check mark
                            checkbox.checked = true; // Check the hidden checkbox
                        } else {
                            selectedCard.classList.remove('selected'); // Deselect the card
                            checkMark.style.display = 'none'; // Hide check mark
                            checkbox.checked = false; // Uncheck the hidden checkbox
                        }
                    }
                   


                    // Save the selected plans (supporting multiple selections)

                          $('#gotothirdstep').hide();
                            function saveSelectedPlans() {
                                    // Retrieve Customer ID
                                    // var customer_id = localStorage.getItem("customer_id");
                                      // console.log('dsdss',customer_id_1);

                                    var customer_id_1 = $('#customer_id').val();

                                    console.log('hfdd',customer_id_1);

                                    if (!customer_id_1) {
                                        Alert("Customer ID not found. Please complete Step 1 first.");
                                        return false;
                                    }

                                    // Get form action and form ID
                                    let form_action = $("#form_action_policy").val();
                                    let form_id = $("#form_id_policy").val();
                                   

                                   
                                  

                                    // Get selected plans
                                    let selectedPlans = document.querySelectorAll('input[name="selected_plan[]"]:checked');
                                    let selectedPlanIDs = Array.from(selectedPlans).map(plan => plan.value);

                                    if (selectedPlanIDs.length > 0) {
                                      

                                        // Proceed to save the selected plans via AJAX
                                        $.ajax({
                                            url: "action/add-update-customer-plans.php",
                                            type: "POST",
                                            data: {
                                                customer_id: customer_id_1,
                                                plans: selectedPlanIDs,
                                                form_action: form_action,
                                                form_id: form_id
                                            },
                                            success: function (data) {
                                                  var response = JSON.parse(data);
                                                   var PolicyNumber=response.PolicyNumber;
                                                      
                                                    Alert("Plans saved successfully.");
                                                    $("#PolicyNumber").val(PolicyNumber);
                                                    $('#savePolicyBtn').hide();
                                                     $('#gotothirdstep').show();

                                            },
                                            error: function () {
                                                Alert("Error saving plans. Please try again.");
                                            }
                                        });
                                    } else {
                                        Alert("Please select at least one plan.");
                                    }
                                    

                                    $("#savePolicyBtn").html('Please Wait..');
                                }


            ////step-3

     

function fetchPlansAndGenerateForms() {

    
   

     var PolicyNumber=$("#PolicyNumber").val();

    if (!PolicyNumber) {
        Alert("Policy Number not found. Please complete All steps.");
        goToPreviousStep();
        return false;
    }

    // AJAX call to fetch plans associated with the PolicyNumber
    $.ajax({
        url: "include/fetch-plans-by-policy.php",
        type: "POST",
        data: { policy_number: PolicyNumber },
        success: function (response) {
            var plans = JSON.parse(response); // Assume the response is a JSON array of plan details
           
            
            if (plans.length > 0) {
                plans.forEach(function (plan) {
                    fetchPlanDetailsAndGenerateForm(plan); // Pass each plan to generate the form
                });
            } else {
                alert("No plans found for the given Policy Number.");
            }
        },
        error: function () {
            alert("Error fetching plans. Please try again.");
        }
    });
}

function fetchPlanDetailsAndGenerateForm(plan) {
    // Check if a form has already been generated for this plan
    if (document.getElementById('plan-' + plan.PlanID + '-members')) {
        alert("The member form for Plan ID " + plan.PlanID + " has already been generated.");
        return;
    }

        $.ajax({
            url: "include/fetch-plan-details.php",
            type: "POST",
            data: { plan_id: plan.PlanID },
            success: function (response) {
                var planDetails = JSON.parse(response); // Assume the response contains plan details
                
                if (planDetails.length > 0) {
                    var numOfMembers = planDetails[0]?.PlanFamilyMember; // Get the number of family members covered
                   

                    if (numOfMembers && !isNaN(numOfMembers) && numOfMembers > 0) {
                        generateMemberForm(planDetails, numOfMembers); // Pass the plan and number of family members
                    } else {
                        alert("No family members information found for Plan ID " + plan.PlanID);
                    }
                } else {
                    alert("No details found for Plan ID " + plan.PlanID);
                }
            },
            error: function () {
                alert("Error fetching plan details. Please try again.");
            }
        });
}

    function generateMemberForm(planDetails, numOfMembers) {
    var plan = planDetails[0];
    var formContainerId = 'plan-' + plan.ID + '-members';

    // Check if the form already exists
    if (document.getElementById(formContainerId)) {
        alert('Member form for this plan is already generated.');
        return;
    }

   

    if (!numOfMembers || isNaN(numOfMembers)) {
        alert("Invalid number of family members!");
        return;
    }

    var formHtml = `<div id="${formContainerId}" class="member-form">`;

   
        formHtml += `<h1>Enter Member Details for ${plan.PlanName}</h1>`;
    

    for (var i = 1; i <= numOfMembers; i++) {
        formHtml += `
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Family Member ${i}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="member_name_${plan.ID}_${i}" name="member_name_${plan.ID}_${i}" placeholder="Enter family member's name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth <span class="text-red">*</span></label>
                        <input type="date" class="form-control" id="member_dob_${plan.ID}_${i}" name="member_dob_${plan.ID}_${i}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Gender <span class="text-red">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="member_gender_${plan.ID}_${i}_male" name="member_gender_${plan.ID}_${i}" value="male" required>
                            <label class="form-check-label" for="member_gender_${plan.ID}_${i}_male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="member_gender_${plan.ID}_${i}_female" name="member_gender_${plan.ID}_${i}" value="female" required>
                            <label class="form-check-label" for="member_gender_${plan.ID}_${i}_female">Female</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Relationship <span class="text-red">*</span></label>
                        <select class="form-control" id="member_relationship_${plan.ID}_${i}" name="member_relationship_${plan.ID}_${i}" required>
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
                    <div class="form-group mb-3">
                       
                        <input type="hidden" class="form-control" id="plan_Id_${plan.ID}_${i}" name="plan_Id_${plan.ID}_${i}" value="${plan.ID}" readonly>
                    </div>
                    <input type="hidden" id="policy_number_${plan.ID}_${i}" name="policy_number_${plan.ID}_${i}" value="${localStorage.getItem('PolicyNumber')}">
                </div>
            </div>
        </div>`;
    }

    formHtml += `</div>`; // Close form container

    // Append the generated form to the corresponding step
    $('#step-3-form-container').append(formHtml);
    
}





 $('#gotosecondstep').hide();
function SaveCustomer(){

    
   
     var PocName = $("#poc_name").val();
    if (PocName == "") {
        Alert("Please Enter Name");
        return false;
    }

    var PocNumber = $("#poc_contact_number").val();
    if (PocNumber == "") {
        Alert("Please Enter Contact Number.");
        return false;
    }


    if(!validaphone(PocNumber)){
        Alert("Please Enter Valid  Contact Number.");
        return false;
    }

     var gender = $("input[name='gender']:checked").val();
  
       
    
     if (gender === undefined || gender === null) {
        Alert("Please select an option for Gender");
        return false;
    }


    var dob = $("#dob").val();
    if (dob == "") {
        Alert("Please Enter DOB");
        return false;
    }
    
    var email = $("#email").val();
    if (email == "") {
        Alert("Please Enter Email.");
        return false;
    }
    else
    {
        if(!isValidEmail(email))
        {
            Alert("Please Enter Valid Email.");
            return false;
        }
    }

    var Address = $("#address").val();
    if (Address == "") {
        Alert("Please Enter Address");
        return false;
    }

    var state = $("#state").val();
    if (state == "") {
        Alert("Please Enter state");
        return false;
    }  

     
    var pincode = $("#pincode").val();
    if (pincode == "") {
        Alert("Please Enter Pincode.");
        return false;
    }
    
     
    let form_action = $("#form_action").val();
    let btntext = "";
    if (form_action == "add") {
        btntext = "Add";
    } else {
        btntext = "Update";
    }



    let myForm = document.getElementById("customer_form");
    var formData = new FormData(myForm);
    formData.forEach(function(value, key){
    
});
     $("#addCusPolicyBtn").html("Please Wait..");
    $.ajax({
        url: "action/add-update-customer.php",
        type: "POST",
        data: formData,
        success: function (data) {
            var response = JSON.parse(data);
            var ID=response.ID;
            
            Alert(response.message);
            
            if (response.error == false) {
                 $("#form_action").val("Update");
                 $("#form_id").val(ID);
                 $("#customer_id").val(ID);
                 $('#gotosecondstep').show();
                 setTimeout(function(){      
                   // window.location.reload();
                // $("#savecustomerBtn").html('update');
                  $('#savecustomerBtn').hide();
                $('#gotosecondstep').show();
             
                },1000)
               
            }else{
                 

                 $("#savecustomerBtn").html('Please Wait..');
                
            }
            
        },
        cache: false,
        contentType: false,
        processData: false,
    });
    return false;
}



$('#gotofourthstep').hide();
function savefamilyMember() {
    let isValid = true;
    let errorMessage = '';

    // Get all family member forms in the container
    const familyMemberForms = document.querySelectorAll("#step-3-form-container .card-body");

    // Initialize FormData object
    let formData = new FormData();

    // Retrieve the Policy Number from localStorage

    let atLeastOneFilled = false;

    // Loop through each form to validate and collect data
   familyMemberForms.forEach((form, index) => {
    const memberName = form.querySelector('input[name^="member_name_"]');
    const memberDob = form.querySelector('input[name^="member_dob_"]');
    const memberGender = form.querySelector('input[name^="member_gender_"]:checked');
    const memberRelationship = form.querySelector('select[name^="member_relationship_"]');
    const planId = form.querySelector('input[name^="plan_Id_"]');

    // Check if at least one family member's required fields are filled
    if (memberName && memberName.value.trim() && 
        memberDob && memberDob.value.trim() && 
        memberGender && memberGender.value && 
        memberRelationship && memberRelationship.value.trim() && 
        planId && planId.value.trim()
    ) {
        atLeastOneFilled = true; // If all fields of at least one member are filled, set the flag
    }

    // Validate individual fields and add to formData if they are not empty
    if (memberName && memberName.value.trim()) {
        formData.append(`member_name_${index + 1}`, memberName.value);
    } else {
        errorMessage += `Family member ${index + 1} - Name is required.\n`;
    }

    if (planId && planId.value.trim()) {
        formData.append(`plan_Id_${index + 1}`, planId.value.trim());
    } else {
        errorMessage += `Family member ${index + 1} - Plan ID is required.\n`;
    }

    if (memberDob && memberDob.value.trim()) {
        formData.append(`member_dob_${index + 1}`, memberDob.value);
    } else {
        errorMessage += `Family member ${index + 1} - Date of Birth is required.\n`;
    }

    if (memberGender) {
        formData.append(`member_gender_${index + 1}`, memberGender.value);
    } else {
        errorMessage += `Family member ${index + 1} - Gender is required.\n`;
    }

    if (memberRelationship && memberRelationship.value.trim()) {
        formData.append(`member_relationship_${index + 1}`, memberRelationship.value);
    } else {
        errorMessage += `Family member ${index + 1} - Relationship is required.\n`;
    }

    // Append the Policy Number for each member
    var policyNumber=$('#PolicyNumber').val();
    if (policyNumber) {
        formData.append(`policy_number_${index + 1}`, policyNumber);
    } else {
        errorMessage += `Family member ${index + 1} - Policy Number is missing.\n`;
    }
});

// Final check to ensure at least one member's form is filled
if (!atLeastOneFilled) {
    isValid = false;
    errorMessage += `At least one family member's details are required.\n`;
}

if (!isValid) {
    alert(errorMessage); // Show the errors, or handle them as required
}

    // If everything is valid, proceed with AJAX request
    $.ajax({
        url: "include/save-family-members.php", // Ensure you have this script in the correct location
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            try {
                var result = JSON.parse(response);
                console.log('fgffffgf',result);
                Alert(result.message);
                if (!result.error) {
                    // After successful submission
                    $('#savefamilyMemberBtn').hide();
                    $('#gotofourthstep').show();
                    setTimeout(function () {
                        // window.location.reload(); // Reload page or navigate as needed

                    }, 1000);
                }
            } catch (error) {
                console.error("Error parsing response:", error);
                Alert("An error occurred while saving the family member details.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            Alert("Failed to save family member details. Please try again.");
        },
    });

    return false; // Prevent form from submitting the traditional way
}


function generatePaymentLink(policyID) {
    setTimeout(function () {
        // Generate the payment link
        var paymentLink = 'https://unitedhealthlumina.com//pay-booking-amount-new?policyNumber=' + policyID;
        $('#paymentLink').val(paymentLink);

        // Send the payment link via email
        $.ajax({
            url: "action/send-payment-link-email.php",
            type: "POST",
            data: {
                email: $("#email").val(),
                paymentLink: paymentLink
            },
            success: function (emailResponse) {
                if (!emailResponse.errorp) {
                    alert(emailResponse.message);
                } else {
                    alert(emailResponse.message);
                }
            }
        });


        function createConfetti() {
  const confettiContainer = document.getElementById('confetti-container');
  
  // Define confetti colors
  const colors = ['#FF5733', '#33FF57', '#3357FF', '#FFFF33', '#FF33FF'];

  // Create 50 confetti pieces
  for (let i = 0; i < 50; i++) {
    const confettiPiece = document.createElement('div');
    confettiPiece.classList.add('confetti');
    
    // Randomize position, animation timing, and colors
    confettiPiece.style.left = Math.random() * 100 + 'vw';
    confettiPiece.style.animationDuration = Math.random() * 1 + 2 + 's';
    confettiPiece.style.animationDelay = Math.random() * 3 + 's';
    confettiPiece.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
    
    confettiContainer.appendChild(confettiPiece);
    
    // Remove confetti piece after animation ends to prevent clutter
    setTimeout(() => {
      confettiPiece.remove();
    }, 10000);
  }
}

        // Start checking payment status every 5 seconds
        var checkPaymentStatusInterval = setInterval(function () {
            $.ajax({
                url: "action/check-payment-status.php",
                type: "POST",
                data: { PolicyID: policyID },
                success: function (statusResponse) {
                    var paymentStatus = JSON.parse(statusResponse);
                    if (!paymentStatus.error) {
                        clearInterval(checkPaymentStatusInterval); // Stop checking
                        Alert("Thank you for your payment! Your payment was successful.");
                        createConfetti();
                        setTimeout(function () {
                            // location.reload(); // Reload the page
                        }, 4000);
                    }
                }
            });
        }, 5000);

        // Show the modal
        $('#paymentLinkModal').modal('show');

        // Copy to clipboard functionality
        $("#copyLinkBtn").click(function () {
            var copyText = document.getElementById("paymentLink");
            copyText.select();
            document.execCommand("copy");
            alert('Payment link copied to clipboard');
        });

        // Share via Email
        $("#shareLinkEmailBtn").click(function () {
            var subject = "Payment Link";
            var body = "Please make the payment using this link: " + paymentLink;
            window.location.href = "mailto:?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
        });

        // Share on WhatsApp
        $("#shareLinkWhatsappBtn").click(function () {
            var whatsappUrl = "https://wa.me/?text=" + encodeURIComponent("Please make the payment using this link: " + paymentLink);
            window.open(whatsappUrl, "_blank");
        });
    }, 1000);
}



// --------------save additional family member-----------------------

function saveAdditionalFamilyMember() {
       event.preventDefault(); 
     var PolicyNumber=$("#PolicyNumber").val();
     console.log('policynumberrrr',PolicyNumber);
      if (!PolicyNumber) {
        Alert(`Family PolicyNumber  is required`);
        
    }

    let errorMessage = '';
    let isValid = true;

    const form = document.getElementById('familyMemberForm');
   
    const formData = new FormData(form); // Collect form data using FormData
    formData.append('policy_number', PolicyNumber);
    const memberName = form.querySelector('input[name="member_name"]');
    const memberDob = form.querySelector('input[name="member_dob"]');
    const memberGender = form.querySelector('input[name="member_gender"]:checked');
    const memberRelationship = form.querySelector('select[name="member_relationship"]');
    const planId = form.querySelector('select[name="planSelect"]');

    // Validate required fields
    if (!memberName.value.trim()) {
        errorMessage += `Family member name is required.\n`;
        isValid = false;
    }

    if (!memberDob.value.trim()) {
        errorMessage += `Date of Birth is required.\n`;
        isValid = false;
    }

    if (!memberGender) {
        errorMessage += `Gender is required.\n`;
        isValid = false;
    }

    if (!memberRelationship.value.trim()) {
        errorMessage += `Relationship is required.\n`;
        isValid = false;
    }

    if (!planId.value.trim()) {
        errorMessage += `Plan selection is required.\n`;
        isValid = false;
    }

    // If validation fails, show the error message
    if (!isValid) {
        Alert(errorMessage);
        return; // Exit function if validation fails
    }

    // Proceed with AJAX request if validation is successful
    $.ajax({
        url: "include/save-Additionalfamily-members.php", // Ensure this is correct path
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            try {
                const result = JSON.parse(response);
                if (result.error) {
                    Alert(result.message); // Show error message if any
                } else {
                    Alert('Family member details saved successfully!');
                    $('#familyMemberModal').modal('hide'); 
                    form.reset(); 
                }
            } catch (error) {
                console.error("Error parsing response:", error);
                alert("An error occurred while saving the family member details.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("Failed to save family member details. Please try again.");
        }
    });
}



