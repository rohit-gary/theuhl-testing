<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Verification | United Health Lumina</title>
    <?php include("includes/meta.php") ?>
    <?php include("includes/links1.php") ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./project-assets/css/verification.css">
</head>
<body>
    <div class="container">
        <div class="verification-container mt-5">
            <div class="logo-container text-center mb-4">
                <img src="https://unitedhealthlumina.com/project-assets/images/uhlnewlogo.png" alt="United Health Lumina Logo">
            </div>
            <h3 class="text-center mb-4">Customer Verification</h3>

            <!-- Bootstrap alert box placeholder -->
            <div id="formAlert"></div>

            <form method="post" class="dzForm" onsubmit="return false" id="customer_verification_form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input name="Name" id="name" type="text" class="form-control" placeholder="Enter your full name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <input name="MobileNumber" id="mobileNumber" type="text" class="form-control" placeholder="Enter your mobile number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="numberOfMember">Number of Members Covered</label>
                            <input name="NumberOfMember" id="numberOfMember" type="text" class="form-control" placeholder="e.g. 2, 4">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Complete Residential Address</label>
                            <textarea name="Address" id="address" class="form-control" rows="4" placeholder="Landmark, City, Pincode"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="site-button btn btn-primary w-100 mt-3" onclick="SubmitCustomerVerification()">Submit Verification</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include("includes/script1.php") ?>
    <script>
        function showAlert(message, type = 'danger') {
            const alertHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            $('#formAlert').html(alertHTML);
        }

        function SubmitCustomerVerification() {
            const name = $('#name').val().trim();
            const mobile = $('#mobileNumber').val().trim();
            const members = $('#numberOfMember').val().trim();
            const address = $('#address').val().trim();

            if (name === '') {
                showAlert('Please enter your full name.');
                return;
            }

            if (mobile === '') {
                showAlert('Please enter your mobile number.');
                return;
            }

            if (!/^\d{10}$/.test(mobile)) {
                showAlert('Mobile number must be exactly 10 digits.');
                return;
            }

            if (members === '') {
                showAlert('Please enter the number of members covered.');
                return;
            }

            if (!/^\d+$/.test(members)) {
                showAlert('Number of members must be a numeric value.');
                return;
            }

            if (address === '') {
                showAlert('Please enter your complete residential address.');
                return;
            }

           var formData = $('#customer_verification_form').serialize();
           $.ajax({
            url:'action/submit_customer_verification.php',
            method:'POST',
            data:formData,
            success:function(response){
                var response= JSON.parse(response);
                alert(response.message);
                $('#customer_verification_form')[0].reset();
                if(response.error==false){
                    setTimeout(function(){
                     
                     window.location.href='https://unitedhealthlumina.com/'   
                   
                    },1500)
                }
            }
           })
        }
    </script>
</body>
</html>
