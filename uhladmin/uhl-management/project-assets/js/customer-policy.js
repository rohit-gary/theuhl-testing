

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

                    // Retrieve the current step from localStorage if it exists
                    if (localStorage.getItem('currentStep') !== null) {
                        currentStep = parseInt(localStorage.getItem('currentStep'), 10);
                    }

                    // Function to initialize the step form on page load
                    function initializeStepForm() {
                        goToStep(currentStep); // Call goToStep with the currentStep value
                    }

                    // Function to navigate to the next step
                    function goToNextStep() {
                        currentStep++;
                        localStorage.setItem('currentStep', currentStep); // Update localStorage
                        goToStep(currentStep);
                    }

                    // Function to navigate to the previous step
                    function goToPreviousStep() {
                        currentStep--;
                        localStorage.setItem('currentStep', currentStep); // Update localStorage
                        goToStep(currentStep);
                    }

                    // Function to display the specific step form
                    function goToStep(step) {
                        const steps = document.querySelectorAll(".step-box");
                        const sections = document.querySelectorAll(".form-section");

                        if (step > 0 && step <= steps.length) {
                            // Remove 'active' class from the current step and section
                            steps.forEach((el, index) => {
                                el.classList.remove("active", "completed", "inactive");
                                sections[index].classList.remove("active");
                            });

                            // Mark previous steps as completed
                            for (let i = 0; i < step - 1; i++) {
                                steps[i].classList.add("completed");
                            }

                            // Mark the current step as active
                            steps[step - 1].classList.add("active");
                            sections[step - 1].classList.add("active");

                            currentStep = step; // Update the current step variable

                            // Handle specific logic for certain steps
                            if (step === 3) {
                                fetchPlansAndGenerateForms();
                                setTimeout(() => {
                                    PopulateFamilyMemberDetails();
                                }, 1000); // 1000 milliseconds = 1 second
                            }
                            if (step === 4) {
                                displaySelectedPlans();
                            }
                            if (step === 5) {
                                displayUploadDocumentForm();
                                displayUploadedDocument();
                            }
                        }
                    }

                    // Call the initializeStepForm function on page load
                    document.addEventListener('DOMContentLoaded', initializeStepForm);

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
                    function togglePlanSelection(planID)
                     {
                        // Get the selected card and check mark
                        let selectedCard = document.getElementById('plan-card-' + planID);
                        let checkMark = selectedCard.querySelector('.check-mark');
                        let checkbox = selectedCard.querySelector('input[type="checkbox"]');

                        // If the card is not selected, select it
                        if (!selectedCard.classList.contains('selected')) 
                        {
                            selectedCard.classList.add('selected'); // Add selected style
                            checkMark.style.display = 'block'; // Show check mark
                            checkbox.checked = true; // Check the hidden checkbox
                        } else
                         {
                            selectedCard.classList.remove('selected'); // Deselect the card
                            checkMark.style.display = 'none'; // Hide check mark
                            checkbox.checked = false; // Uncheck the hidden checkbox
                         }
                    }


                   


                    // Save the selected plans (supporting multiple selections)

                          $('#gotothirdstep').hide();
                            async function saveSelectedPlans() 
                            {
                                let customer_id_1 = $('#customer_id').val();

                                if (customer_id_1 === "") 
                                {
                                    try {
                                        // Fetch customer ID from the session via AJAX
                                        const response = await $.ajax({
                                            url: 'action/get_session_value.php', // Replace with your server endpoint
                                            method: 'GET',
                                            dataType: 'json',
                                        });

                                        if (response.customer_id) {
                                            // Set the fetched customer ID
                                            customer_id_1 = response.customer_id;
                                            //alert("Customer ID fetched: " + customer_id_1);
                                        } else {
                                            //alert("Customer ID not found in session.");
                                            return false;
                                        }
                                    } catch (error) {
                                        console.error('Error fetching customer ID from session:', error);
                                        Alert('An error occurred while fetching the customer ID.');
                                        return false;
                                    }
                                }

                                console.log('Customer ID:', customer_id_1);
                                //alert("Current Customer ID: " + customer_id_1);

                                if (!customer_id_1) {
                                    Alert("Customer ID not found. Please complete Step 1 first.");
                                    return false;
                                }

                                // Get form action and form ID
                                let form_action = $("#form_action_policy").val();
                                let form_id = $("#form_id_policy").val();

                                // alert(form_action);
                                // alert(form_id);


                                // Get selected plans
                                let selectedPlans = document.querySelectorAll('input[name="selected_plan[]"]:checked');
                                let selectedPlanIDs = Array.from(selectedPlans).map(plan => plan.value);

                                if (selectedPlanIDs.length > 0) {
                                    $("#savePolicyBtn").html('Please Wait..');

                                    try {
                                        // Save the selected plans via AJAX
                                        const response = await $.ajax({
                                            url: "action/add-update-customer-plans.php",
                                            type: "POST",
                                            data: {
                                                customer_id: customer_id_1,
                                                plans: selectedPlanIDs,
                                                form_action: form_action,
                                                form_id: form_id,
                                            },
                                        });

                                        const parsedResponse = JSON.parse(response);
                                        const policyNumber = parsedResponse.PolicyNumber;

                                        Alert("Plans saved successfully.");
                                        $("#PolicyNumber").val(policyNumber);
                                        $('#savePolicyBtn').hide();
                                        $('#gotothirdstep').show();
                                    } catch (error) {
                                        console.error('Error saving plans:', error);
                                        alert("Error saving plans. Please try again.");
                                    }
                                } else {
                                    Alert("Please select at least one plan.");
                                }
                            }


            ////step-3

     

async function fetchPlansAndGenerateForms() 
{
    var PolicyNumber=$("#PolicyNumber").val();
    
    if (PolicyNumber === "") 
    {
        try {
            // Fetch customer ID from the session via AJAX
            const response = await $.ajax({
                url: 'action/get_session_value.php', // Replace with your server endpoint
                method: 'GET',
                dataType: 'json',
            });

            if (response.PolicyNumber) 
            {
                PolicyNumber = response.PolicyNumber;
            } 
            else 
            {
                return false;
            }
        } catch (error) {
            console.error('Error fetching customer ID from session:', error);
            Alert('An error occurred while fetching the customer ID.');
            return false;
        }
    }

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
        Alert("The member form for Plan ID " + plan.PlanID + " has already been generated.");
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
                        Alert("No family members information found for Plan ID " + plan.PlanID);
                    }
                } else {
                    Alert("No details found for Plan ID " + plan.PlanID);
                }
            },
            error: function () {
                Alert("Error fetching plan details. Please try again.");
            }
        });
}

    function generateMemberForm(planDetails, numOfMembers) {
    var plan = planDetails[0];
    var formContainerId = 'plan-' + plan.ID + '-members';

    // Check if the form already exists
    if (document.getElementById(formContainerId)) {
        Alert('Member form for this plan is already generated.');
        return;
    }

   

    if (!numOfMembers || isNaN(numOfMembers)) {
        Alert("Invalid number of family members!");
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
                        <input type="text" class="form-control" id="member_name_${plan.ID}_${i}" name="member_name_${plan.ID}_${i}" placeholder="Enter family member's name" value="" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="member_dob_${plan.ID}_${i}" name="member_dob_${plan.ID}_${i}" required>
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
                        <select class="form-control" id="member_relationship_${plan.ID}_${i}" name="member_relationship_${plan.ID}_${i}" onchange="myFunction(this)">
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
                         <input type="text" class="form-control mt-2" id="other_relationship_${plan.ID}_${i}" name="other_relationship_${plan.ID}_${i}" placeholder="Specify relationship" style="display:none;">
                    </div>
                    <div class="form-group mb-3">
                       
                        <input type="hidden" class="form-control" id="plan_Id_${plan.ID}_${i}" name="plan_Id_${plan.ID}_${i}" value="${plan.ID}" readonly>
                    </div>
                    <input type="hidden" id="PolicyMemberID_${plan.ID}_${i}" name="PolicyMemberID_${plan.ID}_${i}" value="-1" />
                    <input type="hidden" id="policy_number_${plan.ID}_${i}" name="policy_number_${plan.ID}_${i}" value="${localStorage.getItem('PolicyNumber')}">
                </div>
            </div>
        </div>`;
    }

    formHtml += `</div>`; // Close form container

    // Append the generated form to the corresponding step
    $('#step-3-form-container').append(formHtml);

    // Now initialize datepicker for all member DOB fields
    $("input[id^='member_dob']").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
    
}

function myFunction(selectElement) {
    // Find the closest parent div containing the select dropdown and the input field for 'Other'
    const formGroup = selectElement.closest('.form-group');
    
    // Find the input field for 'Other' within the same parent container
    const otherInput = formGroup.querySelector('input[type="text"]');
    
    // Check if "Other" is selected
    if (selectElement.value === 'other') {
        // Show the 'Other' input field
        otherInput.style.display = 'block';
    } else {
        // Hide the 'Other' input field
        otherInput.style.display = 'none';
    }
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

    // Check if the date is in valid format dd-mm-yyyy
            var datePattern = /^(\d{2})-(\d{2})-(\d{4})$/;
            var match = dob.match(datePattern);

            if (match) {
                var day = parseInt(match[1], 10);
                var month = parseInt(match[2], 10);
                var year = parseInt(match[3], 10);

                // Check if the year is between 1900 and the current year
                var currentYear = new Date().getFullYear();
                if (year < 1900 || year > currentYear) {
                    Alert("Year should be Valid.");
                    return false;
                }

                // Check if the date is valid
                var date = new Date(year, month - 1, day);
                if (date.getDate() !== day || date.getMonth() !== month - 1 || date.getFullYear() !== year) {
                    Alert("Invalid date. Please enter a valid date.");
                    return false;
                }
            } else {
                Alert("Please enter the date in dd-mm-yyyy format.");
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
$(document).ready(function() {
    // Initialize datepicker for all member DOB fields
    $("input[id^='member_dob']").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
});
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

    const otherRelationship = form.querySelector('input[name^="other_relationship_"]'); // Get the "Other" relationship field
    const PolicyMemberID = form.querySelector('input[name^="PolicyMemberID_"]');

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

    // Validate individual fields and add to formData if they are not empty
    if (PolicyMemberID && PolicyMemberID.value.trim()) {
        formData.append(`PolicyMemberID_${index + 1}`, PolicyMemberID.value);
    }

    if (planId && planId.value.trim()) {
        formData.append(`plan_Id_${index + 1}`, planId.value.trim());
    } else {
        errorMessage += `Family member ${index + 1} - Plan ID is required.\n`;
    }

     if (memberDob && memberDob.value.trim()) {
            // Date validation
            let dob = new Date(memberDob.value);
            let currentYear = new Date().getFullYear();

            if (dob.getFullYear() > currentYear) {
                errorMessage += `Family member ${index + 1} - Date of Birth cannot be in the future.\n`;
                isValid = false;
            } else if (dob.getFullYear() < 1900) {
                errorMessage += `Family member ${index + 1} - Date of Birth cannot be before 1900.\n`;
                isValid = false;
            } else {
                formData.append(`member_dob_${index + 1}`, memberDob.value);
            }
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

            // If "other" relationship is selected, add the other relationship value
            if (memberRelationship.value === "other" && otherRelationship && otherRelationship.value.trim()) {
                formData.append(`other_relationship_${index + 1}`, otherRelationship.value);
            }
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
    Alert(errorMessage); // Show the errors, or handle them as required
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
                if (result.error===false) {
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
                    Alert(emailResponse.message);
                } else {
                    Alert(emailResponse.message);
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
            Alert('Payment link copied to clipboard');
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
                    setTimeout(function (){
                        location.reload();
                    },2000);
                     
                }
            } catch (error) {
                console.error("Error parsing response:", error);
                alert("An error occurred while saving the family member details.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            Alert("Failed to save family member details. Please try again.");
        }
    });
}

function AddNewMemberModal()
{
    fetchPlans();
    $("#familyMemberModal").modal("show");

}

 // Generate confetti
const confettiContainer = document.querySelector('.confetti');
for (let i = 0; i < 50; i++) {
  const piece = document.createElement('div');
  piece.classList.add('confetti-piece');
  piece.style.setProperty('--color', `hsl(${Math.random() * 360}, 100%, 50%)`);
  piece.style.left = Math.random() * 100 + 'vw';
  piece.style.animationDelay = Math.random() * 2 + 's';
  confettiContainer.appendChild(piece);
}


function feezesendmail(PolicyNumber) {
   
    $.ajax({
        url: "action/send-policy-doc-email.php",
        method: "GET",
        data: { PolicyNumber: PolicyNumber },
        success: function(data) {
            var response=JSON.parse(data);
            Alert(response.message);
            if(response.error==false){     
                 $('#policyDocumentss_form').hide();
                 $('#feezesendmail').hide();
                 $('#last_step_thanks').fadeIn();
                 $('#AddNewMemberModalbtn').hide();
                  setTimeout(function() {
                       $.ajax({
                          url:'../controllers/clear-session.php',
                          method:"GET",
                          success:function(data){
                            if(data=='success'){
                              window.location.href="../PolicyCustomer/view-all-policy-customer-new"
                            }
                          }
                       })
                    }, 3000);
            }
        },
        error: function(xhr, status, error) {
            Alert("Error occurred:", error);
        }
    });
}


function sendNeftPolicyDoc(PolicyNumber) {
    alert("Clicked last button: " + PolicyNumber);
    $.ajax({
        url: "../controllers/send-policy-doc-email.php",
        method: "GET",
        data: { PolicyNumber: PolicyNumber },
        success: function(data) {
            var response=JSON.parse(data);
            Alert(response.message);
            if(response.error==false){     
                  setTimeout(function() {
                      location.reload();
                    }, 3000);
            }
        },
        error: function(xhr, status, error) {
            Alert("Error occurred:", error);
        }
    });
}




// --------------Export all Policy Customer data----------------------
function ExportPolicyCustomer(){
   
   window.location.href="action/export-policy-customer-data.php"

} 

function PopulateFamilyMemberDetails()
{
    
    $.post("ajax/get-member-details.php",
    {
    },
    function (data, status) 
    {
        var response = JSON.parse(data);
        if(response.member_exists === true)
        {
            
            populateForms(response)
        }
        else
        {
            // Alert("Please Wait");
        }
    })
}

function populateForms(response) {
    if (!response.member_exists) return;

    // Group members by PlanID
    const groupedMembers = response.family_members.reduce((acc, member) => {
        if (!acc[member.PlanID]) {
            acc[member.PlanID] = [];
        }
        acc[member.PlanID].push(member);
        return acc;
    }, {});

    //console.log(groupedMembers);

    // Iterate over each PlanID and populate corresponding forms
    for (const [planID, members] of Object.entries(groupedMembers)) {
        let index = 1; // Reset index for each PlanID
        members.forEach((member) => {
            // Populate Name
            var nameField1 = "member_name_"+planID+"_"+index;
            console.log(nameField1);
            console.log(member.Name);
            
            if(document.getElementById(nameField1))
            {
               
                $("#"+nameField1).val(member.Name);
               // document.getElementById(nameField1).value = member.Name;
            }
            else
            {
                //alert("Element doesn'exist");
            }
            
            var dobField = "member_dob_"+planID+"_"+index;
            if(document.getElementById(dobField))
            {
                
                $("#"+dobField).val(member.DateOfBirth);
               // document.getElementById(nameField1).value = member.Name;
            }
            else
            {
                //alert("Element doesn'exist");
            }
            var PolicyMemberID = "PolicyMemberID_"+planID+"_"+index;
            if(document.getElementById(PolicyMemberID))
            {
                
                $("#"+PolicyMemberID).val(member.ID);
               // document.getElementById(nameField1).value = member.Name;
            }
            else
            {
                //alert("Element doesn'exist");
            }


            // Populate Gender
            const genderFieldMale = document.getElementById(`member_gender_${planID}_${index}_male`);
            const genderFieldFemale = document.getElementById(`member_gender_${planID}_${index}_female`);
            if (member.Gender === "male" && genderFieldMale) genderFieldMale.checked = true;
            if (member.Gender === "female" && genderFieldFemale) genderFieldFemale.checked = true;

            // Populate Relationship
            const relationshipField = document.getElementById(`member_relationship_${planID}_${index}`);
            if (relationshipField) relationshipField.value = member.Relationship;

            index++; // Increment index for the next member in the same PlanID
        });
    }
}

// --------open plans details model------

function openPlanDetailsModel(plan) {
    // Populate the modal fields with plan data
    document.getElementById('modalPlanImage').src = plan.PlanImage;
    document.getElementById('modalPlanName').textContent = plan.PlanName;
    document.getElementById('modalPlanDuration').textContent = `${plan.PlanDuration} ${plan.PlanDurationFormat}`;
    document.getElementById('modalPlanFamilyMember').textContent = plan.PlanFamilyMember;
    document.getElementById('modalPlanCost').textContent = parseFloat(plan.PlanCost).toLocaleString();
    // document.getElementById('modalPlanImportantPoints').textContent = plan.PlanImportantPoint;
    const cleanedCoverageComments = cleanRichText(plan.PlanHighlights);
    const coverageCommentsList = cleanedCoverageComments
    .split(',')
    .map(comment => `<li style="list-style-type: disc">${comment.trim()}</li>`)
    .join('');
    document.getElementById('modalCoverageComments').innerHTML = coverageCommentsList;
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('planDetailsModal'));
    modal.show();
}

// Function to clean up unwanted styles and quotation marks
function cleanRichText(content)
 {

    content = content.replace(/style="[^"]*"/g, ''); 
    content = content.replace(/"/g, ''); 
    content = content.replace(/\s+/g, ' ').trim(); 
    return content;
}


function viewDocument(doc) {
    // Determine the base URL dynamically based on the hostname
    const baseUrl = window.location.hostname === "localhost"
        ? "http://localhost/Projects/theuhl-testing/uhladmin/uhl-management/PolicyCustomer/documents/"
        : "https://unitedhealthlumina.com/uhladmin/uhl-management/PolicyCustomer/documents/";

    // Combine the base URL with the document name
    const fullUrl = baseUrl + doc;

    // Open the document in a new tab
    window.open(fullUrl, '_blank');
}


function deleteDocument(doc) {
    // Confirm before deletion
    if (confirm('Are you sure you want to delete this document?')) {
        // Perform an AJAX request to delete the document from the session
        $.ajax({
            url: 'action/delete_document.php', // A PHP script to handle the document deletion
            method: 'POST',
            data: { document: doc },
            success: function(response) {
                Alert('Document deleted successfully!');
                // location.reload();  // Reload the page to update the document list
            },
            error: function(error) {
                Alert('Error deleting document.');
            }
        });
    }
}
