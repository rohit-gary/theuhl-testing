<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
@session_start();
require_once "../include/autoloader.inc.php";
$conf = new Conf();
// print_r($_SESSION);
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- TITLE -->
    <title>View All Policy </title>
    <?php
    include "../include/common-head.php";
    require_once "../include/autoloader.inc.php";
    include "../include/get-db-connection.php";
    $core = new Core();
    $encrypt = new Encryption();
    $BookingID = $_GET["bookingid"];
    $BookingID = $encrypt->decrypt_message($BookingID);
    $filter = "WHERE C.ID = $BookingID";
    $sql = "SELECT 
          MAX(C.ID) AS ID, 
          C.OrderID, 
          MAX(C.PaymentID) AS PaymentID, 
          MAX(C.TotalAmount) AS TotalAmount, 
          MAX(C.PaymentMode) AS PaymentMode, 
          MAX(C.Status) AS Status, 
          MAX(C.CreatedDate) AS CreatedDate, 
          MAX(C.CreatedTime) AS CreatedTime,
          GROUP_CONCAT(CI.product_name SEPARATOR ', ') AS ProductNames,
          GROUP_CONCAT(CI.product_price SEPARATOR ', ') AS ProductPrices,
          GROUP_CONCAT(CI.quantity SEPARATOR ', ') AS Quantities,
          GROUP_CONCAT(CI.total_price SEPARATOR ', ') AS TotalPrices,
          MAX(DI.FirstName) AS FirstName, 
          MAX(DI.LastName) AS LastName, 
          MAX(DI.Phone) AS Phone, 
          MAX(DI.Email) AS Email, 
          MAX(DI.Address) AS Address, 
          MAX(DI.City) AS City, 
          MAX(DI.State) AS State, 
          MAX(DI.Postcode) AS Postcode
        FROM checkout C
        LEFT JOIN cart_items CI ON C.CartID = CI.cart_id
        LEFT JOIN test_customer_delivery_info DI ON C.UserID = DI.UserID
        $filter
        GROUP BY C.OrderID";

    $booked_response = $core->_getRecords($conn, $sql);

    $sql_2 = "SELECT * FROM order_report WHERE OrderID = '" . $booked_response[0]['OrderID'] . "'";
    $reportFile = $core->_getRecords($conn, $sql_2);

    // var_dump($reportFile);
    


    ?>

    <style>
        .order-details-container {
            padding: 25px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        .order-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .order-id {
            font-size: 24px;
            color: #2c3e50;
            font-weight: 600;
        }

        .order-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .info-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .products-table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
        }

        .products-table td {
            padding: 12px;
            border-top: 1px solid #dee2e6;
        }

        .total-amount {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            text-align: right;
            margin-top: 20px;
        }

        .card {
            border: 1px solid rgba(0, 0, 0, .125);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-footer {
            border-top: 1px solid rgba(0, 0, 0, .125);
        }
    </style>
</head>

<body class="app sidebar-mini ltr light-mode">
    <div class="page">
        <div class="page-main">
            <?php include "../navigation/top-header.php"; ?>
            <?php include "../navigation/side-navigation.php"; ?>

            <div class="main-content app-content mt-0 my-5">
                <div class="side-app">
                    <div class="order-details-container">
                        <div class="order-header d-flex justify-content-between align-items-center">
                            <div>
                                <div class="order-id">Order #<?php echo $booked_response[0]['OrderID']; ?></div>
                                <div class="text-muted">
                                    <?php echo date('F d, Y', strtotime($booked_response[0]['CreatedDate'])); ?> at
                                    <?php echo date('h:i A', strtotime($booked_response[0]['CreatedTime'])); ?>
                                </div>
                            </div>
                            <span class="order-status status-<?php echo strtolower($booked_response[0]['Status']); ?>">
                                <?php echo $booked_response[0]['Status']; ?>
                            </span>

                            <button class="btn btn-primary upload-report rounded-pill" onclick="uploadReport()"><i
                                    class="fa fa-upload"></i>
                                Upload
                                Report
                            </button>

                        </div>

                        <div class="info-grid">
                            <div class="info-section">
                                <div class="info-title">Customer Information</div>
                                <div>
                                    <?php echo $booked_response[0]['FirstName'] . ' ' . $booked_response[0]['LastName']; ?>
                                </div>
                                <div><?php echo $booked_response[0]['Email']; ?></div>
                                <div><?php echo $booked_response[0]['Phone']; ?></div>
                            </div>

                            <div class="info-section">
                                <div class="info-title">Delivery Address</div>
                                <div><?php echo $booked_response[0]['Address']; ?></div>
                                <div><?php echo $booked_response[0]['City'] . ', ' . $booked_response[0]['State']; ?>
                                </div>
                                <div><?php echo $booked_response[0]['Postcode']; ?></div>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="info-title">Order Details</div>
                            <table class="products-table">
                                <thead>
                                    <tr>
                                        <th>Test Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $productNames = explode(', ', $booked_response[0]['ProductNames']);
                                    $productPrices = explode(', ', $booked_response[0]['ProductPrices']);
                                    $quantities = explode(', ', $booked_response[0]['Quantities']);
                                    $totalPrices = explode(', ', $booked_response[0]['TotalPrices']);

                                    for ($i = 0; $i < count($productNames); $i++) {
                                        echo "<tr>";
                                        echo "<td>{$productNames[$i]}</td>";
                                        echo "<td>₹{$productPrices[$i]}</td>";
                                        echo "<td>{$quantities[$i]}</td>";
                                        echo "<td>₹{$totalPrices[$i]}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="total-amount">
                                Total Amount: ₹<?php echo $booked_response[0]['TotalAmount']; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Add new Reports section -->
                    <div class="info-section mt-4">
                        <div class="info-title d-flex justify-content-between align-items-center">
                            <span>Uploaded Reports</span>
                            <span class="badge bg-primary rounded-pill"><?php echo count($reportFile); ?> Files</span>
                        </div>

                        <?php if (empty($reportFile)): ?>
                            <div class="text-center py-4 text-muted">
                                <i class="fa fa-file-medical fa-3x mb-3"></i>
                                <p>No reports have been uploaded yet.</p>
                            </div>
                        <?php else: ?>
                            <div class="row g-3">
                                <?php foreach ($reportFile as $report): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="fa fa-file-medical text-primary me-2"></i>
                                                    <h6 class="mb-0">Report #<?php echo $report['ID']; ?></h6>
                                                    <a href="javascript:void(0)"
                                                        onclick="deleteReport('<?php echo $report['ID']; ?>') " class="ms-auto"
                                                        style="cursor: pointer;">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </div>
                                                <div class="small text-muted">
                                                    <p class="mb-1">
                                                        <i class="fa fa-calendar-alt me-1"></i>
                                                        <?php echo date('F d, Y', strtotime($report['CreatedDate'])); ?>
                                                    </p>
                                                    <p class="mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        <?php echo date('h:i A', strtotime($report['CreatedTime'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-light">
                                                <a href="./bookedreport/<?php echo $report['FileName']; ?>"
                                                    class="btn btn-sm btn-outline-primary w-100" target="_blank">
                                                    <i class="fa fa-download me-1"></i> Download Report
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../navigation/right-side-navigation.php"; ?>
    </div>
    <?php include "../include/common-script.php"; ?>
    </div>
</body>

</html>


<!-- ---------model for upload repots------------------------- -->

<div class="modal fade" id="uploadReportModal" tabindex="1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title" id="UserModalHeading"></h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadReportForm" onsubmit="return false;" enctype="multipart/form-data">

                    <input type="hidden" id="form_action" name="form_action" value="" />
                    <input type="hidden" id="form_id" name="form_id" value="-1" />
                    <input type="hidden" id="order_ID" name="order_ID"
                        value="<?php echo $booked_response[0]['OrderID']; ?>" />
                    <input type="hidden" id="booking_ID" name="booking_ID"
                        value="<?php echo $booked_response[0]['ID']; ?>" />

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="col-form-label">Report<span
                                    class="text-danger">*<span></label>
                            <input type="file" class="form-control" name="report" id="report"
                                placeholder="Enter Report">
                        </div>
                    </div>


                    <div class="mt-5 text-center">
                        <button class="btn btn-success text-white" id="addUpdateBtn"
                            onclick="AddUpdateReport()"></button>

                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<script>

    function uploadReport() {
        $("#uploadReportModal").modal("show");
        $("#uploadReportForm")[0].reset();
        $("#form_action").val("Add");
        $("#addUpdateBtn").html("Upload Report");
        $("#UserModalHeading").html("Upload Report");
    }

    function AddUpdateReport() {
        var formData = new FormData($("#uploadReportForm")[0]);
        $.ajax({
            url: "action/upload-report.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                Alert(data.message);
                if (data.error == false) {
                    setTimeout(function () {

                        location.reload();

                    }, 3000)

                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function deleteReport(id) {
        console.log("AJAX called for ID:", id);
        if (confirm("Are you sure you want to delete this report?")) {
            $.ajax({
                url: "action/delete-uploaded-report.php",
                method: "POST",
                data: { id: id },
                success: function (response) {
                    console.log("Server Response:", response);
                    var data = JSON.parse(response);
                    Alert(data.message);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            });
        }
    }


</script>