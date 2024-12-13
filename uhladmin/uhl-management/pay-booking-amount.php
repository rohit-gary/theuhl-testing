<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#bf8c07">
    <meta name="description" content="">
    <meta name="title" content="Pay Booking Amount || Good Life Facilities">
    <title>Pay Booking Amount || Good Life Facilities</title>
    <?php 
    require_once('../include/autoloader.inc.php');
    $dbh = new Dbh();
        $core = new Core();
        $conn = $dbh->_connectodb();
        $IMSSetting = new IMSSetting($conn);
        $Programs = new Programs($conn);
        $Student = new Student($conn);
        $BookingID='';
    if(isset($_GET['BookingID']))
    {
        $BookingID = $_GET['BookingID'];
    }


    else
    {
    ?>
    <script type="text/javascript">
    alert("Unauthorized Access!");
    window.location.href = "http://localhost/projects/eqube/mentorship-web/";
    </script>
    <?php
    }
    $program_booking_details=$Programs->getBookProgramData($BookingID);
 

    $student_details =$Student->GetStudentDetailsbyID($program_booking_details['StudentID']);
    $program_details=$Programs->GetProgramsDetailsbyID($program_booking_details['ProgramID']);
    $UserName = $student_details['Name'];
    $MobileNumber =$student_details['PhoneNumber'];
    $Email =$student_details['Email'];
    $Service_cost = (int)$program_details['ProgramCost'];
    $Service_name =$program_details['Title'];
    $PaymentStatus ='PaymentStatus';
    // $Service_cost = 01;
    if(strstr($Service_cost, '/', true)){
        $total_amount = strtok($Service_cost, "/");
        
    }else{
        $total_amount = $Service_cost;
    }
   
    
    include("includes/links.php"); ?>

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

    .btn-light:focus {
        color: #212529;
        background-color: #e2e6ea;
        border-color: #dae0e5;
        box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, .5);
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

    .card-text {

        font-size: 13px;
        margin-left: 6px;
    }

    .certificate-text {

        font-size: 12px;
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
        /* height: 51px; */
        font-size: 15px;
        border-radius: 8px;
        padding: 9px 4px;
    }


    .payment-card-body {

        flex: 1 1 auto;
        padding: 24px 1rem !important;

    }
    </style>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <?php
 include('includes/header.php')
?>
    <section style="background: aliceblue;">

        <div class="container">



            <div class="row g-3">

                <div class="col-md-6">

                    <span>Costumer Details :</span>
                    <div class="card mt-2">

                        <div class="accordion" id="accordionExample">

                            <div class="card" style="background: #fff;">
                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">

                                    <span style='width: 35%;'>Name :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $UserName?></span>

                                </div>
                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">

                                    <span style='width: 35%;'>Mobile Number :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $MobileNumber?></span>

                                </div>
                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">

                                    <span style='width: 35%;'>Email :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $Email?></span>

                                </div>
                                <!-- <div class="d-flex p-3 text-dark align-items-center justify-content-between">

                                    <span style='width: 35%;'>Address :</span>
                                    <span class='text-right' style='width: 65%;'><?php echo $Customer_address?></span>

                                </div> -->

                                <div class="d-flex p-3 text-dark align-items-center justify-content-between">

                                    <span style='width: 35%;'>Program Name :</span>
                                      <span class='text-right' style='width: 65%;'><?php echo $Service_name; ?></span>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>

                <div class="col-md-6">
                    <span>Summary</span>

                    <div class="card mt-2">

                        <div class="d-flex justify-content-between p-3">

                            <div class="d-flex flex-column">

                                <span>Fix Charges </span>
                                <a href="#" class="billing text-danger">( Not Refundable )</a>

                            </div>

                            <div class="mt-1">
                                <sup class="super-price"><?php echo $total_amount * 0.30?></sup>
                                <!-- <span class="super-month">/Month</span> -->
                            </div>

                        </div>

                        <hr class="mt-0 line">

                        <p class="pl-3 pr-3"><a class="text-primary" href="https://unitedhealthlumina.com/uhl/terms-conditions">Term & Condition</a> and <a
                                class="text-primary" href="https://unitedhealthlumina.com/uhl/privacy-policy">Privacy Policy</a></p>

                        <!-- <div class="p-3">

                            <div class="d-flex justify-content-between mb-2">

                                <span>Refferal Bonouses</span>
                                <span>-$2.00</span>

                            </div>

                            <div class="d-flex justify-content-between">

                                <span>Vat <i class="fa fa-clock-o"></i></span>
                                <span>-20%</span>

                            </div>


                        </div> -->


                        <!-- <hr class="mt-0 line"> -->


                        <!-- <div class="p-3 d-flex justify-content-between">

                            <div class="d-flex flex-column">

                                <span>Today you pay(US Dollars)</span>
                                <small>After 30 days $9.59</small>

                            </div>
                            <span>$0</span>



                        </div> -->
                        <?php if($PaymentStatus != "Paid"){?>
                        <form class="pr-3 pl-3 pb-2 pt-3" id="pay_amount" method="POST"
                            action=" ">

                            <input type="hidden" name="name" id='card_name' value="<?php echo $UserName?>">
                            <input type="hidden" name="ID" value="<?php echo $BookingID?>" />
                            <input type="hidden" name="phone" id="phone" value="<?php echo $MobileNumber?>">
                            <input type="hidden" name="amount" id="amount" value="<?php echo $total_amount?>">

                            <div class="text-center">


                                <!-- <input style="font-size: 18px; font-weight:700;" type="submit"
                                    class="btn btn-primary btn-block free-button w-100 mt-2" id="form_submit"
                                    Value="Pay Now Rs. <?php echo $total_amount?>"> -->
                            </div>
                        </form>
                        <div class="pb-3 pr-3 pl-3 pt-0">
                            <button id="pay-button" class="btn text-white btn-block free-button w-100 mt-2"
                                style='background:#072654;'>Pay with Razorpay</button>
                        </div>
                        <?php 
                           } 
                         if($PaymentStatus != "Pay Later" && $PaymentStatus != "Paid"){?>

                        <form class="pb-3 pr-3 pl-3 pt-0" id="pay_later_form" onclick='return false;'>

                            <input type="hidden" name="Booking_ID" value="<?php echo $BookingID?>" />

                            <div class="text-center">

                               <!--  <a style="font-size: 18px; background:#000; font-weight:700;"
                                    class="btn text-white free-button w-100 mt-2" id="pay_later_form_submit"
                                    onclick="PayLaterForm()">Pay Later</a> -->
                            </div>
                        </form>

                        <?php } ?>



                        
                        <span class="text-muted text-center certificate-text pb-3"><i class="fa fa-lock"></i> Your
                            transaction is secured with ssl certificate</span>




                    </div>
                </div>

            </div>


        </div>

        <!-- <div class="container">
            <div class="row pt-5 pb-5 justify-content-center">
                <div class="scholarship-form col-11 col-md-6 col-lg-8">
                    <div id="scholarship_form">
                        <div class="logo m-auto" style="width:200px">

                        </div>
                        <div class="card">
                            <div class="card-body p-5">
                                <h2 class="mb-3">
                                    Hello Manish,
                                </h2>
                                <p class="fs-sm mb-4">
                                    Kindly Pay your Trip Amount. Trip Details are as -
                                </p>
                                <div class="border-top border-gray-200 mt-4 py-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-muted mb-2">Booking ID </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <strong>
                                            </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-muted mb-2">Trip Start Date </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <strong>
                                                9
                                            </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-muted mb-2">Trip Start Time </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <strong>
                                                9
                                            </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-muted mb-2">Trip End Date </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <strong>
                                                9
                                            </strong>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-muted mb-2">Trip End Time </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <strong>
                                                0
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top border-gray-200 mt-4 py-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-muted mb-2">Customer Name </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <div class="text-muted mb-2">Payment To</div>
                                            <strong>
                                                Omcar Drivers
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top border-gray-200 mt-4 py-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-muted mb-2">Amount </div>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <div class="text-muted mb-2">Trip Amount</div>
                                            <strong>
                                                100
                                            </strong>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <form id="pay_amount" method="POST" action="./pay-booking-amount-action.php">

                            <input type="hidden" name="name" value="Manish Sharma">
                            <input type="hidden" name="ID" value="11" />
                            <input type="hidden" name="phone" value="8433098391">
                            <input type="hidden" name="amount" value="100">

                            <div class="mt-5 text-center">


                                <input style="font-size: 18px; font-weight:700;" type="submit"
                                    class="btn btn-primary btn-block w-100 mt-2" id="form_submit"
                                    Value="Pay Now Rs. 100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <?php
        include("includes/footer.php");
        include("includes/scripts.php");
    ?>

    <script>
    function PayLaterForm() {

        $("#pay_later_form_submit").html("Please Wait...");

        $.ajax({
            url: "action/pay-later-action.php",
            type: "POST",
            data: $("#pay_later_form").serialize(),
            success: function(data) {
                var response = JSON.parse(data);
                TechXAlert(response.message);
                if (response.error == false)
                    setInterval(function() {
                        window.location.reload();
                    }, 2000);
                $("#pay_later_form_submit").html("Pay Later");
                return false;
            }
        });
        return false;
    }
    </script>


    <script>
    document.getElementById('pay-button').onclick = function(e) {
        // Example data you might want to send to the PHP backend
        let amount = document.getElementById('amount').value;
        // let amount = 2000;
        let card_name = document.getElementById('card_name').value;
        alert(card_name);
        let phone = document.getElementById('phone').value;
        //  let amount = document.getElementById('phone').value;

        let paymentData = {
            amount: amount, // Amount in INR
            currency: 'INR',
            receipt: '123456', // Example receipt ID
            description: 'Test Payment'
        };

        // Send data to PHP script
        fetch('create_order.php', {
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

                var options = {
                    "key": "rzp_test_ZHHIr27UIU5Lbo", // Razorpay API Key ID
                    "amount": paymentData.amount * 100, // Amount in paise
                    "currency": paymentData.currency,
                    "name": "Acme Corp",
                    "description": paymentData.description,
                    "order_id": data.orderId, // Pass the order ID obtained from backend
                    "handler": function(response) {
                        fetch('verify_payment.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    alert('Payment verified successfully!');
                                } else {
                                    alert('Payment verification failed: ' + data.message);
                                }
                            });
                    },
                    "prefill": {
                        "name": name,
                        "email": "john.doe@example.com",
                        "contact": phone
                    },
                    "theme": {
                        "color": "#F37254"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
                e.preventDefault();
            })
            .catch(error => {
                console.error('Error creating order:', error);
            });
    }
    </script>

</body>

</html>