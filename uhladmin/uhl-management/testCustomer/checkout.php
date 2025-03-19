<?php @session_start();
include('include/logic.php');
$CartID = '';
if (isset($_SESSION['cart_id']) || !empty(isset($_SESSION['cart_id']))) {
    $CartID = $_SESSION['cart_id'];
}else if(isset($_GET['cart_id'])|| !empty(isset($_GET['cart_id']))){
    $CartID=$_GET['cart_id'];
}
$AllTest = $test_obj->GetAllProductByCartID($CartID);
$finalTotal = 0;
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
        echo "<script> window.location.href = 'http://localhost/Projects/theuhl-testing/our-test/create-account.php';</script>";
    }

?>

<head>
    <?php include("../../../includes/meta.php") ?>
    <?php include("../../../includes/links1.php") ?>
    <title>Our Most Popular Test</title>
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../project-assets/css/all_test.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style type="text/css">

    </style>
</head>

<?php 

if(!(isset($_GET['source']) && $_GET['source'] === 'mobile'))
{
    include('../../../includes/header1.php');
}


 ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dlab-bnr-inr overlay-black-middle bg-pt"
        style="background-image:url(../project-assets/images/banner/back-screen.png);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">Checkout</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="index.html">Test</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- contact area -->
    <div class="section-full content-inner">
        <!-- Product -->
        <div class="container">
            <form class="shop-form" id="pay_amount" method="POST" action="" onsubmit="return false">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-md-6 m-b30">
                        <h4>Billing & Shipping Address</h4>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="First Name"
                                    id="first_name_checkout" name="first_name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name" id="last_name_checkout"
                                    name="last_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Address" id="address_checkout"
                                name="address">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc."
                                    id="apartment_checkout" name="apartment">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Town / City" id="city_checkout"
                                    name="city">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="State / County" id="state_checkout"
                                    name="state">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control dz-number" placeholder="Postcode / Zip"
                                    id="postcode_checkout" name="postcode">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" placeholder="Email" id="email_checkout"
                                    name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control dz-number" placeholder="Phone"
                                    id="phone_checkout" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-md-6 m-b30">
                        <h4 class="font-weight-600">Notes</h4>
                        <div class="form-group">
                            <textarea class="form-control"
                                placeholder="Notes about your order, e.g. special notes for delivery"
                                id="notes_checkout" name="notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="dlab-divider bg-gray-dark text-gray-dark icon-center"><i
                        class="fas fa-circle bg-white text-gray-dark"></i></div>
                <div class="row">
                    <div class="col-lg-6 m-b15">
                        <h4>Your Order</h4>
                        <table class="table-bordered check-tbl">
                            <thead>
                                <tr>
                                    <th>PRODUCT NAME</th>
                                    <th>QUANTITY</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllTest as $Test) {
                                    $finalTotal += (float) $Test['total_price'];
                                    ?>

                                    <tr>
                                        <td><?php echo $Test['product_name'] ?></td>
                                        <td><?php echo htmlspecialchars($Test['quantity']); ?></td>
                                        <td>₹<?php echo number_format((float) $Test['total_price'], 2); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 m-b15">
                        <h4>Order Total</h4>
                        <table class="table-bordered check-tbl">
                            <tbody>
                                <tr>
                                    <td>Order Subtotal</td>
                                    <td class="product-price">₹<?php echo number_format((float) $finalTotal, 2); ?></td>
                                </tr>
                                <tr class="d-none">
                                    <td>Shipping</td>
                                    <td>Free Shipping</td>
                                </tr>
                                <tr class=" ">
                                    <td>Coupon</td>
                                    <td class="product-price">0.00</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="product-price-total">
                                        ₹<?php echo number_format((float) $finalTotal, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <h5>Payment Method</h5>
                        <div class="form-group">
                            <div id="payment_gateway" class="d-flex flex-column">
                                <div class="form-check d-flex align-items-center d-none">
                                    <input type="radio" class="form-check-input me-2" id="razorpay"
                                        name="payment_gateway" value="razorpay" checked>
                                    <label class="form-check-label me-3" for="razorpay">Razorpay</label>
                                    <img src="project-assets/images/razorpay.png" style="height:50px">
                                </div>
                                <div class="form-check d-flex align-items-center mt-2">
                                    <input type="radio" class="form-check-input me-2" id="idfc" name="payment_gateway"
                                        value="idfc">
                                    <label class="form-check-label me-3" for="idfc">UPI</label>
                                    <img src="../project-assets/images/upi-logo.png" style="height:50px">
                                </div>
                                <div class="form-check d-flex align-items-center mt-2 d-none">
                                    <input type="radio" class="form-check-input me-2" id="payu" name="payment_gateway"
                                        value="payu">
                                    <label class="form-check-label me-3" for="payu">PayU</label>
                                    <img src="../project-assets/images/new-payu-logo.svg" style="height:50px">
                                </div>

                                <div class="form-check d-flex align-items-center mt-2">
                                    <input type="radio" class="form-check-input me-2" id="cod" name="payment_gateway"
                                        value="cod">
                                    <label class="form-check-label me-3" for="cod">COD(Cash On Delivery)</label>
                                    
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="amount" id="amount" value="<?php echo $finalTotal; ?>">
                        <input type="hidden" name="cart_id" id="cart_id" value="<?php echo $CartID; ?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

            </form>
            <div class="pb-3 pr-3 pl-3 pt-0">
                <button id="pay-button" class="site-button button-lg btn-block">Place Order
                    Now</button>
            </div>

        </div>
    </div>
</div>
<!-- Product END -->
</div>

</div>
<!-- Content END-->

</div>
<?php 

if(!(isset($_GET['source']) && $_GET['source'] === 'mobile'))
{
   include("../../../includes/footer1.php");
}




 ?>


<?php include("../../../includes/script1.php") ?>
</body>
<script type="text/javascript" src="../project-assets/js/all_test_new.js" defer></script>

<script>
    document.getElementById('pay-button').onclick = function (e) {
        // let selectedGateway = document.getElementById('payment_gateway').value;
        let selectedGateway = document.querySelector('input[name="payment_gateway"]:checked').value;
        console.log(selectedGateway);
        // let amount = document.getElementById('amount').value;
        let amount = '1';
        let card_name = document.getElementById('first_name_checkout').value;
        let phone = document.getElementById('phone_checkout').value;
        let cart_id = document.getElementById('cart_id').value;

        let first_name = document.getElementById('first_name_checkout').value;
        let last_name = document.getElementById('last_name_checkout').value;
        let address = document.getElementById('address_checkout').value;
        let apartment = document.getElementById('apartment_checkout').value;
        let city = document.getElementById('city_checkout').value;
        let state = document.getElementById('state_checkout').value;
        let postcode = document.getElementById('postcode_checkout').value;
        let email = document.getElementById('email_checkout').value;
        let notes = document.getElementById('notes_checkout').value;
        let user_id = document.getElementById('user_id').value;

        if (first_name == '' || last_name == '' || address == '' || apartment == '' || city == '' || state == '' || postcode == '' || email == '' || notes == '') {
            alert('Please fill all the fields');
            return;
        }

        var formData = new FormData();
        formData = $('#pay_amount').serialize();
        // Prevent default action only once
        e.preventDefault();
        $.ajax({
            url: 'action/add-test-customer-delivery-info.php',
            method: 'POST',
            data: formData,
            success: function (response) {
                var response = JSON.parse(response);
                if (response.error == false) {
                    alert('Customer delivery info added successfully Please wait for payment verification');
                    setTimeout(function () {

                        if (selectedGateway === 'idfc') {
                            let timestamp = Date.now();
                            let receiptID = cart_id;

                            let paymentData = {
                                amount: amount,
                                currency: 'INR',
                                receipt: receiptID,
                                description: 'Payment for Test'
                            };

                            // Send data to PHP script to create Razorpay order
                            fetch('./create-test-order.php', {
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
                                        "key": "rzp_live_CIaXiqWSJYoxsg", // Test key for Razorpay, rzp_test_VHcUYxXlN9UYgv   rzp_live_ByoIjLl32Tm8w1 replace with your live key
                                        "amount": paymentData.amount * 100,  // Amount is in paise (i.e., 100 paise = 1 INR)
                                        "currency": paymentData.currency,
                                        "name": "UHL Health",
                                        "description": paymentData.description,
                                        "order_id": data.orderId,  // Use the order ID returned by create_order.php
                                        "handler": function (response) {
                                            // Send payment details to verify_payment.php
                                            fetch('verify_test_payment_idfc.php', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({
                                                    razorpay_payment_id: response.razorpay_payment_id,
                                                    razorpay_order_id: response.razorpay_order_id,
                                                    razorpay_signature: response.razorpay_signature,
                                                    cart_id: cart_id,
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
                                                            window.location.href = "./our-test/all-test"; // Redirect after successful payment
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
                                            "email": email,
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
                        } else if (selectedGateway === 'payu') {
                            frmsubmit()
                        }else if (selectedGateway === 'cod') {
                            codoption()
                        }



                    }, 5000)


                } else {
                    alert(response.message);
                }
            }

        });



    };

</script>

<script type="text/javascript">

    function frmsubmit() {
        document.getElementById("payment_form").submit();
        return true;
    }

    function codoption(){
        
       $.ajax({
        url: './action/update_payment_mode.php',
        method: 'GET',
        success: function (data) {
            try {
               
                var response = JSON.parse(data);  
                if(response.error==false){
                    alert('Thanks for chossing Us Your Order Will Placed Soon!!');
                  window.location='https://unitedhealthlumina.com//our-test/all-test';
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
       
    }
</script>