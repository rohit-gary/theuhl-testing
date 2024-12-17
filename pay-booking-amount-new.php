<?php 

ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

   require_once('uhladmin/uhl-management/include/autoloader.inc.php');
   include("uhladmin/uhl-management/include/db-connection.php");

$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$policy = new PolicyCustomer($conn);
$plans = new Plans($conn);

$policyCustomerID = '';
$policyDetails = [];

if (isset($_GET['policyNumber'])) {
    $policyCustomerNumber = base64_decode($_GET['policyNumber']);
    $policyDetails = $policy->getPolicyCustomerDetailsByPolicyNumber($policyCustomerNumber);
    // print_r($policyDetails);
    // die();
    
    if (empty($policyDetails)) {
        echo "<script>alert('No policy details found!'); window.location.href='all-plans.php';</script>";
        exit;
    }
} else {
    ?>
    <script type="text/javascript">
    alert("Unauthorized Access!");
    window.location.href = "https://www.unitedhealthlumina.com/uhl/all-plans.php";
    </script>
    <?php
    exit;
}

$policy = $policyDetails;
// $plansdetails = $plans->GetPlanDetailsbyID($policy['PlanID']);
$UserName = $policy['UserName'];
$MobileNumber = $policy['MobileNumber'];
$Email = $policy['Email'];
$Service_name = $policy['PlanNames']; 
$Service_cost = $policy['TotalAmount'];



$policyNumber=$policy['PolicyNumber']; 
$PaymentStatus = "Not Paid"; 

// print_r($policyNumber);
// print_r($Service_cost);
// die();

if (strstr($Service_cost, '/', true)) {
    $total_amount = strtok($Service_cost, "/");
} else {
    $total_amount = $Service_cost;
}

include("includes/links.php");
include("includes/meta.php");
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    .card {
        border: none;
    }
    .card-header {
        padding: .5rem 1rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .03);
        border-bottom: none;
    }
    .form-control {
        height: 50px;
        border: 2px solid #eee;
        border-radius: 6px;
        font-size: 14px;
    }
    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #039be5;
        outline: 0;
        box-shadow: none;
    }
    .btn-light:focus {
        color: #212529;
        background-color: #e2e6ea;
        border-color: #dae0e5;
        box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, .5);
    }
    .input {
        position: relative;
    }
    .input i {
        position: absolute;
        top: 16px;
        left: 11px;
        color: #989898;
    }
    .input input {
        text-indent: 25px;
    }
    .billing {
        font-size: 11px;
    }
    .super-price {
        top: 0px;
        font-size: 22px;
    }
    .super-month {
        font-size: 11px;
    }
    .line {
        color: #bfbdbd;
    }
    .free-button {
        background: #1565c0;
        font-size: 15px;
        border-radius: 8px;
        padding: 9px 4px;
    }
</style>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<body>
    <?php include('includes/header.php'); ?>
    <section style="background: aliceblue; padding: 30px 0;">
        <div class="container">
            <div class="row g-4">
                <!-- Customer Details -->
                <div class="col-lg-6">
                    <span>Customer Details :</span>
                    <div class="card mt-2">
                        <div class="accordion" id="accordionExample">
                            <div class="card" style="background: #fff;">
                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">
                                    <span style='width: 35%;'>Name :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $UserName; ?></span>
                                </div>
                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">
                                    <span style='width: 35%;'>Mobile Number :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $MobileNumber; ?></span>
                                </div>
                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">
                                    <span style='width: 35%;'>Email :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $Email; ?></span>
                                </div>
                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">
                                    <span style='width: 35%;'>Plan Name :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $Service_name; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Summary -->
                <div class="col-lg-6">
                    <span>Summary</span>
                    <div class="card mt-2">
                        <div class="d-flex justify-content-between p-3">
                            <div class="d-flex flex-column">
                                <span>Total Amount</span>
                                <a href="#" class="billing text-danger">(Plan amount)</a>
                            </div>
                            <div class="mt-1">
                                <sup class="super-price"><?php echo $total_amount ?>.00</sup>
                            </div>
                        </div>
                        
                        <hr class="mt-0 line">
                        <p class="pl-3 pr-3">
                            <a class="text-primary" href="https://unitedhealthlumina.com/uhl/terms-conditions">Terms & Conditions</a> and 
                            <a class="text-primary" href="https://unitedhealthlumina.com/uhl/privacy-policy">Privacy Policy</a>
                        </p>

                        <!-- Payment Gateway Selection -->
                        <form class="pr-3 pl-3 pb-2 pt-3" id="pay_amount" method="POST" action="">
                            <input type="hidden" name="name" id="card_name" value="<?php echo $UserName; ?>">
                            <input type="hidden" name="ID" value="<?php echo $policyCustomerID; ?>">
                            <input type="hidden" name="phone" id="phone" value="<?php echo $MobileNumber; ?>">
                            <input type="hidden" name="amount" id="amount" value="<?php echo $total_amount; ?>">

                            <div class="form-group">
                                <label for="payment_gateway">Select Payment Gateway:</label>
                                <select id="payment_gateway" class="form-control" name="payment_gateway">
                                    <option value="razorpay">Razorpay</option>
                                    <!-- <option value="ccavenue">CCAvenue</option> -->
                                </select>
                            </div>

                            <div class="text-center">
                                <!-- Dynamic Payment Button -->
                            </div>
                        </form>

                        <!-- Pay button for Razorpay or CCAvenue -->
                        <div class="pb-3 pr-3 pl-3 pt-0">
                            <button id="pay-button" class="btn text-white btn-block free-button w-100 mt-2" style="background:#072654;">Proceed to Payment</button>
                        </div>
                        
                        <span class="text-muted text-center certificate-text pb-3"><i class="fa fa-lock"></i> Your transaction is secured with SSL certificate</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("includes/footer.php"); ?>
    <?php include("includes/script.php"); ?>

    <script>
   document.getElementById('pay-button').onclick = function (e) {
    let selectedGateway = document.getElementById('payment_gateway').value;
    let amount = document.getElementById('amount').value;
    let card_name = document.getElementById('card_name').value;
    let phone = document.getElementById('phone').value;
    let policyCustomerID = '<?php echo $policyCustomerID; ?>';
    let policyNumber='<?php echo $policyNumber; ?>';

    // Prevent default action only once
    e.preventDefault();

    if (selectedGateway === 'razorpay') {
        let timestamp = Date.now();
        let receiptID = `${policyCustomerID}_${timestamp}`;

        let paymentData = {
            amount: amount,
            currency: 'INR',
            receipt: receiptID,
            description: 'Payment for Plan'
        };

        // Send data to PHP script to create Razorpay order
        fetch('create_order_new.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(paymentData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert('Error: ' + data.error);
                return;
            }

            // Prepare Razorpay payment options
            var options = {
                "key": "rzp_test_VHcUYxXlN9UYgv", // Test key for Razorpay, rzp_test_VHcUYxXlN9UYgv   rzp_live_ByoIjLl32Tm8w1 replace with your live key
                "amount": paymentData.amount * 100,  // Amount is in paise (i.e., 100 paise = 1 INR)
                "currency": paymentData.currency,
                "name": "UHL Health",
                "description": paymentData.description,
                "order_id": data.orderId,  // Use the order ID returned by create_order.php
                "handler": function (response) {
                    // Send payment details to verify_payment.php
                    fetch('verify_payment_new.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature,
                            policyNumber:policyNumber,
                            amount: amount,
                            name: card_name,
                            phone: phone
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                title: "Payment Successful!",
                                text: "Payment verified successfully. Please check your email!",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.href = "all-plans.php"; // Redirect after successful payment
                            });
                        } else {
                            Swal.fire({
                                title: "Verification Failed!",
                                text: "Payment verification failed: " + data.message,
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });
                },
                "prefill": {
                    "name": card_name,
                    "email": phone, // You might want to use a proper email field instead of phone
                    "contact": phone
                },
                "theme": {
                    "color": "#F37254"
                }
            };

            // Open Razorpay payment window
            var rzp1 = new Razorpay(options);
            rzp1.open();
        })
        .catch(error => {
            console.error('Error creating order:', error);
        });

    } else if (selectedGateway === 'ccavenue') {
       
        let ccavenue_url = './payments-CCAvenue/ccavRequestHandler.php'; // CCAvenue payment URL
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = ccavenue_url;
        form.target = '_blank';

        // Prepare hidden fields for CCAvenue
        let hiddenFields = [
            { name: 'merchant_id', value: '3976065' },
            { name: 'order_id', value: policyCustomerID },
            { name: 'amount', value: amount },
            { name: 'currency', value: 'INR' },
            { name: 'name', value: card_name },
            { name: 'email', value: phone }
        ];

        hiddenFields.forEach(field => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = field.name;
            input.value = field.value;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
};

    </script>
</body>
</html>
