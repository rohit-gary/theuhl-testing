function isValidEmail(email) {
    // Regular expression to check if the email is valid
    var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;

    // Test the email against the regular expression
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
     
     $(document).ready(function() {
        // Button click event
        $("#buyPlanBtn").on("click", function() {
            var planId = $(this).data('plan-id'); // Get the Plan ID from data attribute

            // Set the plan ID in the hidden input of the form
            $("#planId").val(planId);

            // Show the modal
            $("#buyPlanModal").modal('show');
        });

        // Handle the form submission (optional)
        $("#submitBuyPlan").on("click", function() {
            // You can add your form validation and submission logic here
            var formData = $("#buyPlanForm").serialize(); // Serialize form data
            
            // Example of sending data via AJAX (if needed)
            $.ajax({
                url: "submit-plan.php",  // Your form submission URL
                type: "POST",
                data: formData,
                success: function(response) {
                    // Handle success response
                    alert("Plan purchased successfully!");
                    $("#buyPlanModal").modal('hide'); // Hide modal after success
                },
                error: function(error) {
                    // Handle error
                    alert("Error submitting the form.");
                }
            });
        });
    });

     function generateFamilyMemberForm() {
        var memberCount = document.getElementById('familyMemberCount').value;
        var container = document.getElementById('familyMemberFormsContainer');
        if (memberCount < (minFamilyMembers-1)) {
            // alert(`You can't add more than ${maxFamilyMembers} family members.`);

            Swal.fire({
                icon: 'warning',
                title: 'Alert',
                text: `You must enter details for at least ${minFamilyMembers} family member(s).`,
            });
            return; // Stop further execution
        }
        if (memberCount > (maxFamilyMembers-1)) {
            // alert(`You can't add more than ${maxFamilyMembers} family members.`);

            Swal.fire({
                icon: 'warning',
                title: 'Alert',
                text: `You can't add more than ${maxFamilyMembers} family members.`,
            });
            return; // Stop further execution
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
                    <input type="date" class="form-control" name="member_dob_${i}" id="member_dob_${i}" onchange="calculateAge(${i})" >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Age <span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="member_age_${i}" id="member_age_${i}" placeholder="Enter family member's age" min="0" readonly >
                </div>
                        <div class="form-group mb-3">
        <label class="form-label">Gender <span class="text-red">*</span></label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="member_gender_${i}" value="male" id="member_gender_male_${i}">
            <label class="form-check-label" for="member_gender_male_${i}">Male</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="member_gender_${i}" value="female" id="member_gender_female_${i}">
            <label class="form-check-label" for="member_gender_female_${i}">Female</label>
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

    function calculateAge(i) {
            var dobInput = document.getElementById(`member_dob_${i}`).value;
            var ageInput = document.getElementById(`member_age_${i}`);

            if (dobInput) {
                var dob = new Date(dobInput);
                var diff = Date.now() - dob.getTime();
                var ageDate = new Date(diff);
                var calculatedAge = Math.abs(ageDate.getUTCFullYear() - 1970);
                
                ageInput.value = calculatedAge;
            }
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



    function AddUpdateCustomerPolicyForm() {
        console.log('policy customer add update js');

        var PocName = $("#poc_name").val();
    if (PocName == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter POC Name',
        });
        return false;
    }

    var PocNumber = $("#poc_contact_number").val();
    if (PocNumber == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter POC Contact Number.',
        });
        return false;
    }


    if(!validaphone(PocNumber)){
        alert("Please Enter Valid  Contact Number.");
        return false;
    }

    var gender = $("input[name='gender']:checked").val();
    if (gender === undefined || gender === null) {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please select an option for Gender',
        });
        return false;
    }

    var dob = $("#dob").val();
    if (dob == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter POC DOB',
        });
        return false;
    }

    var email = $("#email").val();
    if (email == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter POC Email.',
        });
        return false;
    }

    var Address = $("#address").val();
    if (Address == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter POC Address',
        });
        return false;
    }

    var state = $("#state").val();
    if (state == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter State',
        });
        return false;
    }


    var issue_date = $("#issue_date").val();
    if (issue_date == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter POC Issue Date',
        });
        return false;
    }

    var buyingFor = $("input[name='buying_for']:checked").val();
    if (buyingFor == undefined || buyingFor == null) {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please select an option for Buying Plan For',
        });
        return false;
    }

    if (buyingFor == 'other') {
        var familyMemberCount = $('#familyMemberCount').val();
        if (familyMemberCount == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Information',
                text: 'Please provide family member count',
            });
            return false;
        }

        for (var i = 1; i <= familyMemberCount; i++) {
            var name = $(`input[name='member_name_${i}']`).val();
            var dob = $(`input[name='member_dob_${i}']`).val();
            var age = $(`input[name='member_age_${i}']`).val();
            var gender = $(`input[name='member_gender_${i}']:checked`).val();
            var relationship = $(`select[name='member_relationship_${i}']`).val();

            if (!name || !dob || !age || !gender || !relationship) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Information',
                    text: `Please fill out all fields for Family Member ${i}.`,
                });
                return false;
            }
        }
    }

    var pincode = $("#pincode").val();
    if (pincode == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Information',
            text: 'Please Enter POC Pincode.',
        });
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
        console.log(key + ": " + value);
    });
        $("#addCusPolicyBtn").html("Please Wait..");
        $.ajax({
            url: "action/buy-plan.php",
            type: "POST",
            data: formData,
            success: function (data) {
                var response = JSON.parse(data);
                var PolicyID=response.last_insert_id;
                if(response.error==true){
                    Swal.fire({
                        title: 'Warning!',
                        text: response.message,
                        icon: 'Warning',  
                        confirmButtonText: 'OK'
                    });
                }
               
                if (response.error == false) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message + 'Please Wait for the Payment',
                        icon: 'success',  
                        confirmButtonText: 'OK'
                    });
                    setTimeout(function(){
                        window.location.href = 'https://unitedhealthlumina.com/uhl/pay-booking-amount?id=' + PolicyID;

                    },5000);
                   
                   
                }
                
            },
            cache: false,
            contentType: false,
            processData: false,
        });
        return false;

    }
        
        function payplan(){
            
        let myForm = document.getElementById("customer_policy_form");
        var formData = new FormData(myForm);
         $.ajax({
            url: "action/pay-booking-amount.php",
            type: "POST",
            data: formData,
            success: function (data) {
                var response = JSON.parse(data);
                Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',  
                        confirmButtonText: 'OK'
                    });
                if (response.error == false) {
                    setTimeout(function(){
                        location.reload();
                    },5000);
                   

                }
                
            },
            cache: false,
            contentType: false,
            processData: false,
        });

    return false;


        }
  