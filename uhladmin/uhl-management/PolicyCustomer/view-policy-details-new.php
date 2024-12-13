<?php

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

    $encrypt = new Encryption();
    $PolicyID = $_GET["PolicyID"];
    $PolicyID = $encrypt->decrypt_message($PolicyID);

    $PolicyDetails_obj = new PolicyCustomer($conn);
    $Plan_obj = new Plans($conn);
    $state_obj = new State($conn);

    $PolicyDetails = $PolicyDetails_obj->getPolicyCustomerDetailsByPolicyNumber(
        $PolicyID
    );

    $PolicyMemberDetails = $PolicyDetails_obj->getPolicyCustomerMemberDetailsByPolicyNumber(
        $PolicyID
    );

    $PolicyDocumentsDetails = $PolicyDetails_obj->getPolicyDocumentsDetailsByPolicyNumber(
        $PolicyID
    );

    // print_r($PolicyDetails);
    // die();

    if (!empty($PolicyDetails)) {
        $policy = $PolicyDetails;
    }


    // $PlanDetailss = $Plan_obj->GetPlanDetailsbyID($policy["PlanID"]);
    // $PlanDetails = $PlanDetailss[0];

    // print_r($PlanDetails);
    // die();
    $trans_obj=new Transaction($conn);

    $transDetails=$trans_obj->GetAllTransactionByPolicyNumber($PolicyID);

    $StateDetailss = $state_obj->GetStateNameByID($PolicyDetails['State']);
    $StateDetails = $StateDetailss[0];

    $maxFamilyMembers = 01;


     $planDurationMonths = '12';//$CustomerPlanDetails['PlanDuration']
       $createdDate = $PolicyDetails['CreatedDate'];
      $dateObj = DateTime::createFromFormat('Y-m-d', $createdDate);

    // Format the date to 'dd-mmm-yyyy' (e.g., 02 March 2024)
      $formattedDate = $dateObj->format('d F Y');
    $expiryDateObj = clone $dateObj;  // Clone the original DateTime object to preserve it
    $expiryDateObj->add(new DateInterval('P' . $planDurationMonths . 'M'));  // Add PlanDurationMonths
     $expiryFormattedDate = $expiryDateObj->format('d F Y');

    ?>
<link rel="stylesheet" href="../theme-assets/plugins/richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="../theme-assets/plugins/richtexteditor/rte.js"></script>
<script type="text/javascript" src='../theme-assets/plugins/richtexteditor/plugins/all_plugins.js'></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



   <style>
        /* Custom Styles */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .btn-primary, .btn-secondary {
            width: 48%;
        }
        .modal-content {
            border-radius: 10px;
        }
        .modal-header {
            background-color: #f0f2f5;
        }
    </style>
</head>

<body class="app sidebar-mini ltr light-mode">
<div class="page">
    <div class="page-main">
        <?php include "../navigation/top-header.php"; ?>
        <?php include "../navigation/side-navigation.php"; ?>

        <div class="main-content app-content mt-0">
            <div class="side-app">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Upload Document</p>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal" style="border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; padding: 0;display: none;">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            
                                        
                                                                             <div class="col-md-6 mt-4">
                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addMemberModal" onclick="AddFamily()" style="display: none;">Add Family Member</button> </div>
                                </div>
                                </div>
                           <div class="col-lg-12">
    <!-- Policy Details Card -->
    <div class="card mt-5 shadow-sm" style="border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
        <div class="card-header text-white d-flex justify-content-between align-items-center" 
             style="background: linear-gradient(135deg, #007bff, #0056b3);">
            <h4 class="mb-0">Policy Details</h4>
            <span class="badge bg-success">Active</span>
        </div>
        <div class="card-body px-4 py-4" style="background-color: rgba(255, 255, 255, 0.8);">

            <!-- Policy Details Table -->
            <table class="table table-borderless align-middle">
                <tbody>
                    <tr>
                        <th style="width: 30%; text-align: left; color: #6c757d;">Policy Name:</th>
                        <td><?php echo htmlspecialchars(
                            $PolicyDetails["PlanNames"]
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">Policy Number:</th>
                        <td><?php echo htmlspecialchars(
                            $PolicyDetails["PolicyNumber"]
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">Name:</th>
                        <td><?php echo htmlspecialchars(
                            $PolicyDetails["UserName"]
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">Contact Number:</th>
                        <td><?php echo htmlspecialchars(
                            $PolicyDetails["MobileNumber"]
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">Email:</th>
                        <td><?php echo htmlspecialchars(
                            $PolicyDetails["Email"]
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">Address:</th>
                        <td><?php echo htmlspecialchars(
                            $PolicyDetails["Address"]
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">State:</th>
                        <td><?php echo htmlspecialchars(
                            $StateDetails["StateName"]
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">Policy Start Date:</th>
                        <td><?php echo htmlspecialchars(
                           $formattedDate
                        ); ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: left; color: #6c757d;">Policy End Date:</th>
                        <td><?php echo htmlspecialchars(
                            $expiryFormattedDate
                        ); ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>




 <!-- show the transection details of the policy -->

                                
 <?php

$transaction = !empty($transDetails) && isset($transDetails[0]) ? $transDetails[0] : null;
?>

<!-- Transaction Details Card -->
<div class="col-md-6">
    <?php if ($transaction): ?>
        <div class="card mt-5 shadow-sm" style="border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
            <div class="card-header text-white d-flex justify-content-between align-items-center" 
                 style="background: linear-gradient(135deg, #28a745, #218838);">
                <h4 class="mb-0">Transaction Details</h4>
                <span class="badge <?php echo $transaction['status'] === 'Success' ? 'bg-success' : 'bg-danger'; ?>">
                    <?php echo htmlspecialchars($transaction['status']); ?>
                </span>
            </div>
            <div class="card-body px-4 py-4" style="background-color: rgba(255, 255, 255, 0.8);">
                <!-- Transaction Details Table -->
                <table class="table table-borderless align-middle">
                    <tbody>
                        <tr>
                            <th style="text-align: left; color: #6c757d;">Payment ID:</th>
                            <td><?php echo htmlspecialchars($transaction['razorpay_payment_id']); ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: left; color: #6c757d;">Order ID:</th>
                            <td><?php echo htmlspecialchars($transaction['razorpay_order_id']); ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: left; color: #6c757d;">Amount:</th>
                            <td>₹<?php echo htmlspecialchars(number_format($transaction['amount'], 2)); ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: left; color: #6c757d;">Status:</th>
                            <td><?php echo htmlspecialchars($transaction['status']); ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: left; color: #6c757d;">Date:</th>
                            <td><?php echo htmlspecialchars(date("d-m-Y H:i:s", strtotime($transaction['created_at']))); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="card mt-5 shadow-sm text-center" style="border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #dc3545, #c82333);">
            <h4 class="mb-0">Payment Status</h4>
        </div>
        <div class="card-body px-4 py-4" style="background-color: rgba(255, 255, 255, 0.8);">
            <h6 class="text-muted">Payment Pending</h6>
            <p class="text-muted" style="font-size: 0.9rem;">No transaction details are available at the moment.</p>
           <?php if ($_SESSION['dwd_UserType'] !== 'Policy Customer'): ?>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPaymentModal">Edit Payment</button>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>




            <!-- Edit Payment Modal -->
<div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment Details</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
            </div>
            <form id="payments_form" onsubmit="return false;" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                         <input type="hidden" class="form-control" id="policy_id" name="policy_id" value="<?php echo $PolicyID?>"required readonly>
                        <label for="razorpay_payment_id">Transaction ID</label>
                        <input type="text" class="form-control" id="razorpay_payment_id" name="razorpay_payment_id" required>
                    </div>
                    <div class="form-group">
                        <label for="razorpay_order_id">Order ID (If Not Give Transaction ID )</label>
                        <input type="text" class="form-control" id="razorpay_order_id" name="razorpay_order_id" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Success">Success</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>

                    <div class="form-group">
        <label for="payment_mode">Payment Mode</label>
        <select class="form-control" id="payment_mode" name="payment_mode" onchange="toggleBankDetails()">
            <option value="Online">Online</option>
            <option value="NEFT">NEFT</option>
            <option value="Razorpay">Razorpay</option>
            <option value="Bank">Bank</option>
        </select>
    </div>

    <!-- Bank details will be displayed based on the payment mode -->
    <div id="bank_details" style="display: none;">
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number">
        </div>
        <div class="form-group">
            <label for="ifsc_code">IFSC Code</label>
            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code">
        </div>
    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="UpdatePaymentsBtn" onclick="UpdatePayments()">Update Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
                        <div class="mt-5">

                            <?php if (!empty($PolicyMemberDetails)): ?>
                            <h3 class="card-title">Family Members</h3>
                             <?php endif; ?>
                            <div class="row">
                                <?php foreach (
                                    $PolicyMemberDetails
                                    as $member
                                ): ?>
                                    <div class="col-md-4">
                                        <!-- Family Member Card -->
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5 class="card-title"><?php echo htmlspecialchars(
                                                    $member["Name"]
                                                ); ?></h5>
                                                <span class="badge bg-info"><?php echo htmlspecialchars(
                                                    $member["Relationship"]
                                                ); ?></span>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Policy Number:</strong> <?php echo htmlspecialchars(
                                                    $member["PolicyNumber"]
                                                ); ?></p>
                                                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars(
                                                    $member["DateOfBirth"]
                                                ); ?></p>
                                                <p><strong>Age:</strong> <?php echo htmlspecialchars(
                                                    $member["Age"]
                                                ); ?></p>
                                                <p><strong>Gender:</strong> <?php echo htmlspecialchars(
                                                    $member["Gender"]
                                                ); ?></p>
                                                <p><strong>Documents:</strong>
                                                    <?php
                                                    $documents = isset(
                                                        $member["Document"]
                                                    )
                                                        ? json_decode(
                                                            $member["Document"]
                                                        )
                                                        : null;
                                                    if (
                                                        is_array($documents) &&
                                                        !empty($documents)
                                                    ) {
                                                        foreach (
                                                            $documents
                                                            as $doc
                                                        ) {
                                                            echo '<a href="./documents/' .
                                                                htmlspecialchars(
                                                                    $doc
                                                                ) .
                                                                '" target="_blank">' .
                                                                htmlspecialchars(
                                                                    $doc
                                                                ) .
                                                                "</a><br>";
                                                        }
                                                    } else {
                                                        echo "No documents available.";
                                                    }
                                                    ?>
                                              </p>
                                               <!-- Upload Button -->
                                               <p>(Please Upload Adhar card of this family Member) <span style="color:red">*</span></p>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal<?php echo $member[
                                                    "ID"
                                                ]; ?>">
                                                    Upload Document
                                                </button>




                                                <!-- ------------model----- -->

                                                <div class="modal fade" id="uploadModal<?php echo $member[
                                                    "ID"
                                                ]; ?>" tabindex="-1" aria-labelledby="uploadModalLabel<?php echo $member[
                                                    "ID"
                                                ]; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="uploadModalLabel<?php echo $member[
                                                            "ID"
                                                        ]; ?>">Upload Document</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" enctype="multipart/form-data"  id="member_documents_<?php echo $member[
                                                        "ID"
                                                    ]; ?>" onsubmit="return false;">
                                                        <input type="hidden" id="form_action" name="form_action" value="" />
                                                        <input type="hidden" id="form_id" name="form_id" value="" />
                                                        <div class="modal-body">
                                                            <input type="hidden" name="policy_member_id" value="<?php echo htmlspecialchars(
                                                                $member["ID"]
                                                            ); ?>">
                                                            <div id="documents_container_member">
                                                                <div class="input-group mb-2">
                                                                    <input type="file" class="form-control" id="documents_0" name="member_documents[]">
                                                                    <button type="button" class="btn btn-outline-primary" onclick="addFileInputMember()">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success text-white" id="UplodeMemberDocuments" onclick="UplodeMemberDocumentsBtn(event)">Upload Document</button>
                                                        </div>
                                                    </form>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                                <?php endforeach; ?>
                            </div>
                       

                    



                                               <div class="col-lg-12">
                                                <!-- Policy Documents Details -->
                                                <div class="mt-5">
                                                    <h3 class="card-title">Policy Documents</h3>
                                                    <?php if (
                                                        empty(
                                                            $PolicyDocumentsDetails
                                                        )
                                                    ): ?>
                                                            <div class="alert alert-info mt-4">
                                                                <div class="d-flex align-items-center">
                                                                    <!-- Icon -->
                                                                    <i class="fas fa-upload fa-2x me-3"></i>
                                                                    <!-- Title and Description -->
                                                                    <div>
                                                                        <h4 class="card-title mb-1">Please Upload Your Necessary Documents for KYC Purpose</h4>
                                                                        <p class="mb-0">Ensure that all required documents are uploaded for a smooth KYC process. This will help us verify your details quickly.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                    <div class="row">
                                                        <?php foreach (
                                                            $PolicyDocumentsDetails
                                                            as $document
                                                        ): ?>
                                                            <div class="col-md-4">
                                                                <!-- Policy Document Card -->
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <?php
                                                                        // Decode the JSON-encoded documents array and display each document with an icon
                                                                        $documents = json_decode(
                                                                            $document[
                                                                                "Documents"
                                                                            ]
                                                                        );
                                                                        foreach (
                                                                            $documents
                                                                            as $doc
                                                                        ) {
                                                                            // Extract file extension to display appropriate icon
                                                                            $file_extension = pathinfo(
                                                                                $doc,
                                                                                PATHINFO_EXTENSION
                                                                            );
                                                                            $icon_class =
                                                                                "fa-file"; // Default icon for file

                                                                            // Set specific icons based on file type (e.g., PDF, DOCX, etc.)
                                                                            if (
                                                                                strtolower(
                                                                                    $file_extension
                                                                                ) ==
                                                                                "pdf"
                                                                            ) {
                                                                                $icon_class =
                                                                                    "fa-file-pdf";
                                                                            } elseif (
                                                                                strtolower(
                                                                                    $file_extension
                                                                                ) ==
                                                                                    "docx" ||
                                                                                strtolower(
                                                                                    $file_extension
                                                                                ) ==
                                                                                    "doc"
                                                                            ) {
                                                                                $icon_class =
                                                                                    "fa-file-word";
                                                                            } elseif (
                                                                                strtolower(
                                                                                    $file_extension
                                                                                ) ==
                                                                                    "jpg" ||
                                                                                strtolower(
                                                                                    $file_extension
                                                                                ) ==
                                                                                    "jpeg" ||
                                                                                strtolower(
                                                                                    $file_extension
                                                                                ) ==
                                                                                    "png"
                                                                            ) {
                                                                                $icon_class =
                                                                                    "fa-file-image";
                                                                            }

                                                                            // Display document name with icon
                                                                            echo '<div class="d-flex align-items-center mb-2">';
                                                                            echo '<i class="fas ' .
                                                                                $icon_class .
                                                                                ' mr-2"></i>';
                                                                            echo '<a href="./documents/' .
                                                                                htmlspecialchars(
                                                                                    $doc
                                                                                ) .
                                                                                '" target="_blank">' .
                                                                                htmlspecialchars(
                                                                                    $doc
                                                                                ) .
                                                                                "</a>";
                                                                            echo "</div>";
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>






                                      <!-- Upload Document Modal -->
                                <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadDocumentLabel">Upload Document</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="policyDocuments_form" onsubmit="return false;" enctype="multipart/form-data">
                                                <input type="hidden" id="form_action" name="form_action" value="" />
                                                <input type="hidden" id="form_id" name="form_id" value="" />

                                                <div class="row">  
                                                    <div class="mb-3 col-6">
                                                        <input type="hidden" class="form-control" id="policy_ID" name="policy_ID" value="<?php echo $PolicyID; ?>">
                                                    </div>

                                                    <div class="mb-3 col-6">
                                                        <input type="hidden" class="form-control" id="policy_number" name="policy_number" value="<?php echo htmlspecialchars(
                                                            $policy[
                                                                "PolicyNumber"
                                                            ]
                                                        ); ?>">
                                                    </div>

                                                    <div class="mb-3 col-12">
                                                        
                                                        <div id="documents_container">
                                                            <div class="input-group mb-2">
                                                                <input type="file" class="form-control" id="documents_0" name="policy_documents[]">
                                                                <button type="button" class="btn btn-outline-primary" onclick="addFileInput()">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-5 text-center">
                                                    <button class="btn btn-success text-white" id="UplodeDocumentsBtn" onclick="AddUploade()">Upload Document</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <!-- Add Family Member Modal -->
                                <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addMemberLabel">
                                                Add Family Members (You can add up to <?php echo htmlspecialchars(
                                                    $maxFamilyMembers
                                                ); ?> members)
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Step 1: Ask for the number of family members -->
                                            <div class="mb-3">
                                                <label for="numFamilyMembers" class="form-label">Enter the number of family members you want to add:</label>
                                                <input type="number" class="form-control" id="numFamilyMembers" placeholder="Enter a number" min="1" max="<?php echo htmlspecialchars(
                                                    $maxFamilyMembers
                                                ); ?>">
                                            </div>
                                            <button type="button" class="btn btn-primary" onclick="generateFamilyMemberForms()">Add Member</button>

                                            <!-- Step 2: Family member forms go here -->
                                            <form id="familyMemberForm" action=" " method="POST" style="display: none;"onsubmit="return false;" enctype="multipart/form-data">
                                                <div id="familyMemberFormsContainer"></div>
                                                <div class="modal-footer">
                                                    <input type="hidden" id="form_action" name="form_action" value="" />
                                                    <input type="hidden" id="form_id" name="form_id" value="" />
                                                     <input type="hidden" class="form-control" id="policy_ID" name="policy_ID" value="<?php echo $PolicyID; ?>">
                                                     <input type="hidden" class="form-control" id="policy_number" name="policy_number" value="<?php echo htmlspecialchars(
                                                         $policy["PolicyNumber"]
                                                     ); ?>">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    
                                                    <button class="btn btn-success text-white" id="saveMemberDetailsBtn" onclick="savefamilyMember()">Save Family</button>
                                                
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>


            <?php include "../navigation/right-side-navigation.php"; ?>
        </div>
        <?php include "../include/common-script.php"; ?>
        <script src="../project-assets/js/customer-policy.js"></script>
       


        <script>

    const maxFamilyMembers = <?php echo json_encode($maxFamilyMembers); ?>;

    // Function to generate the family member forms
    function generateFamilyMemberForms() {
        const numFamilyMembers = document.getElementById('numFamilyMembers').value;
        const familyMemberFormsContainer = document.getElementById('familyMemberFormsContainer');
        const familyMemberForm = document.getElementById('familyMemberForm');
        
        // Clear previous forms
        familyMemberFormsContainer.innerHTML = '';

        // Validate the entered number
        if (numFamilyMembers > maxFamilyMembers-1) {
            alert(`You can only add up to ${maxFamilyMembers} family members.`);
            return;
        } else if (numFamilyMembers < 1) {
            alert('Please enter a valid number of family members.');
            return;
        }

        // Show the form container
        familyMemberForm.style.display = 'block';

        // Generate forms based on the entered number
        for (let i = 1; i <= numFamilyMembers; i++) {
    familyMemberFormsContainer.innerHTML += `
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Family Member ${i}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="member_name_${i}" placeholder="Enter family member's name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="member_dob_${i}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="member_gender_${i}" value="male" required>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="member_gender_${i}" value="female" required>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Relationship <span class="text-danger">*</span></label>
                        <select class="form-control" name="member_relationship_${i}" required>
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
                    <div class="form-group mb-3">
                        <label class="form-label">Upload Document <span class="text-danger">*</span></label>
                        <small class="form-text text-muted">Please upload at least one valid document for this member.</small>
                        <input type="file" class="form-control" name="member_document_${i}" required accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>
            </div>
        </div>`;
}

    }
</script>



<script type="text/javascript">
   let documentCounter = 1;

function addFileInput() {
    const container = document.getElementById('documents_container');
    
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2');

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.classList.add('form-control');
    fileInput.name = 'policy_documents[]';
    fileInput.id = `documents_${documentCounter}`;

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


function addFileInputMember() {
    const container = document.getElementById('documents_container_member');
    
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2');

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.classList.add('form-control');
    fileInput.name = 'policy_documents[]';
    fileInput.id = `documents_${documentCounter}`;

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

// To retrieve files when submitting, gather all files from `policy_documents[]` inputs
function getDocumentsArray() {
    const filesArray = [];
    const fileInputs = document.querySelectorAll("input[name='policy_documents[]']");
    fileInputs.forEach(input => {
        if (input.files.length > 0) {
            filesArray.push(input.files[0]);  // Store each file object
        }
    });
    return filesArray;
}

    $("#UplodeDocumentsBtn").html("Add");

function AddUploade() {
    // Check if at least one document is uploaded, validate each file size and type
    const fileInputs = document.querySelectorAll("input[name='policy_documents[]']");
    let fileSelected = false;
    const maxFileSize = 10 * 1024 * 1024; // 10 MB in bytes
    const allowedTypes = [
    'application/pdf', // PDF files
    'application/msword', // DOC files
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOCX files
    'image/jpeg', // JPG files
    'image/png' // PNG files
];


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
        Alert("Please upload at least one  Document.");
        return false;
    }

    // Update button text to indicate loading
    $("#UplodeDocumentsBtn").html("Please Wait..");

    // Create a new FormData object to handle file uploads
    let formData = new FormData(document.getElementById("policyDocuments_form"));

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
                    location.reload();
                }, 1500);
                $("#UplodeDocumentsBtn").html("Add");
                $('#policyDocuments_form')[0].reset();
            } else {
                $("#UplodeDocumentsBtn").html("Add");
            }
        },
        error: function(xhr, status, error) {
            Alert("An error occurred while submitting the form. Please try again.");
            $("#UplodeDocumentsBtn").html("Add");
        }
    });
    return false;
}




 $("#saveMemberDetailsBtn").html("Save Family");

// Save family member function with validation for files and inputs
function savefamilyMember() {
    const numFamilyMembers = document.getElementById('numFamilyMembers').value;
    let valid = true;

    for (let i = 1; i <= numFamilyMembers; i++) {
        const name = document.querySelector(`input[name='member_name_${i}']`).value;
        const dob = document.querySelector(`input[name='member_dob_${i}']`).value;
        const gender = document.querySelector(`input[name='member_gender_${i}']:checked`);
        const relationship = document.querySelector(`select[name='member_relationship_${i}']`).value;
        const documentFile = document.querySelector(`input[name='member_document_${i}']`);

        if (!name || !dob || !gender || !relationship || !documentFile.files.length) {
            alert(`Please fill all required fields for Family Member ${i}`);
            valid = false;
            break;
        }

        // Validate file type and size
        const file = documentFile.files[0];
        const maxFileSize = 10 * 1024 * 1024; // 10 MB
        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];

        if (file.size > maxFileSize) {
            alert("Each document must be less than 10 MB.");
            valid = false;
            break;
        }

        if (!allowedTypes.includes(file.type)) {
            alert("Only PDF, DOC, DOCX, JPG, or PNG files are allowed.");
            valid = false;
            break;
        }
    }

    if (!valid) {
        return false;
    }

    // Proceed to save family members
    const formData = new FormData(document.getElementById('familyMemberForm'));

    // Make AJAX request with FormData
    $.ajax({
        url: "action/save-family-members.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            const response = JSON.parse(data);
            alert(response.message);
            if (!response.error) {
                $('#addMemberModal').modal('hide');
            }
        },
        error: function(xhr, status, error) {
            alert("An error occurred while submitting the form. Please try again.");
        }
    });

    return false;
}
</script>


<script type="text/javascript">
  function UplodeMemberDocumentsBtn(event) {
    event.preventDefault();  // Prevent the default form submission

    console.log('Document Clicked');

    const documentFiles = document.querySelectorAll('input[name="member_documents[]"]');
    let valid = true;

    // Check if at least one document has been selected
    let fileSelected = false;
    documentFiles.forEach((documentFile) => {
        if (documentFile.files.length) {
            fileSelected = true;
        }
    });

    if (!fileSelected) {
        alert('Please upload at least one document.');
        valid = false;
    }

    // Validate file type and size for each file
    documentFiles.forEach((documentFile) => {
        if (documentFile.files.length > 0) {
            const file = documentFile.files[0];
            const maxFileSize = 10 * 1024 * 1024; // 10 MB
            const allowedTypes = [
                'application/pdf', 
                'application/msword', 
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
                'image/jpeg', 
                'image/png'
            ];

            if (file.size > maxFileSize) {
                alert("Each document must be less than 10 MB.");
                valid = false;
            }

            if (!allowedTypes.includes(file.type)) {
                alert("Only PDF, DOC, DOCX, JPG, or PNG files are allowed.");
                valid = false;
            }
        }
    });

    // If valid, submit the form using AJAX
    if (valid) {
        // const formData = new FormData(document.getElementById('member_documents'));
        const button = event.target;
    const modal = button.closest('.modal');
    const form = modal.querySelector('form');
    const formData = new FormData(form);
        $.ajax({
            url: "action/uplode-members-document.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                const response = JSON.parse(data);  // Assuming the response is JSON
                Alert(response.message);

                if (response.error==false) {
                    $('#uploadModal').modal('hide');
                    setTimeout(function(){

                    location.reload();
                    },1000)
                                    }
            },
            error: function(xhr, status, error) {
                alert("An error occurred while submitting the form. Please try again.");
            }
        });
    }

    return false;
}


</script>



<script>
    // JavaScript function to toggle bank details based on payment mode
    function toggleBankDetails() {
        var paymentMode = document.getElementById("payment_mode").value;
        var bankDetailsDiv = document.getElementById("bank_details");

        if (paymentMode === "NEFT" || paymentMode === "Bank") {
            bankDetailsDiv.style.display = "block"; // Show bank details
        } else {
            bankDetailsDiv.style.display = "none"; // Hide bank details
        }
    }

    // Call the function initially to set the right state (for default payment mode)
    toggleBankDetails();
</script>

<script>
    
    function UpdatePayments() {
    // Validate the form fields for payment details
    const transactionId = document.getElementById("razorpay_payment_id").value.trim();
    const orderId = document.getElementById("razorpay_order_id").value.trim();
    const amount = document.getElementById("amount").value.trim();
    const name = document.getElementById("name").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const status = document.getElementById("status").value.trim();
    const paymentMode = document.getElementById("payment_mode").value.trim();

    // Check if all required fields are filled
    if (transactionId === "" || orderId === "" || amount === "" || name === "" || phone === "") {
        Alert("Please fill out all required fields.");
        return false;
    }

    // Validate Amount
    if (isNaN(amount) || amount <= 0) {
        Alert("Please enter a valid amount.");
        return false;
    }

    // If the payment mode is NEFT or Bank, validate the bank details
    if (paymentMode === "NEFT" || paymentMode === "Bank") {
        const accountNumber = document.getElementById("account_number").value.trim();
        const ifscCode = document.getElementById("ifsc_code").value.trim();

        if (accountNumber === "" || ifscCode === "") {
            Alert("Please enter the account number and IFSC code for NEFT/Bank payments.");
            return false;
        }
    }

    
    $("#UpdatePaymentsBtn").html("Please Wait..");
    let formData = new FormData(document.querySelector("form"));
    // Make AJAX request to process the payment update
    $.ajax({
        url: "action/process-payment-update.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from converting data
        contentType: false,  // Set content type to false to let the browser set it automatically
        success: function(data) {
            var response = JSON.parse(data);
            Alert(response.message);
            if (response.error == false) { 
                setTimeout(function() {
                    location.reload();
                }, 1500);
                $("#UpdatePaymentsBtn").html("Update Payment");
                $('form')[0].reset();  // Reset the form
            } else {
                $("#UpdatePaymentsBtn").html("Update Payment");
            }
        },
        error: function(xhr, status, error) {
            Alert("An error occurred while submitting the form. Please try again.");
            $("#UpdatePaymentsBtn").html("Update Payment");
        }
    });

    return false;
}


</script>
</body>
</html>


