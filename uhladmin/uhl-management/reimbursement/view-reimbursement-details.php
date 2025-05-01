<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

require_once "../include/autoloader.inc.php";
include "../include/get-db-connection.php";

// Check if ReimbursementID is provided
if (!isset($_GET['ReimbursementID']) || empty($_GET['ReimbursementID'])) {
    header("Location: view-all-reimbursement.php");
    exit;
}

// Decrypt the ReimbursementID
try {
    $encrypt = new Encryption();
    $ReimbursementID = $encrypt->decrypt_message($_GET['ReimbursementID']);
} catch (Exception $e) {
    header("Location: view-all-reimbursement.php");
    exit;
}

// Get user type and check permissions
try {
    $authentication = new Authentication($conn);
    $UserType = $authentication->SessionCheck();
    $loggedInUserID = $_SESSION["dwd_UserID"];
} catch (Exception $e) {
    exit;
}

// Get reimbursement details
try {
    $reimbursement = new Reimbursement($conn);
    $record = $reimbursement->GetReimbursementByID($conn, "customer_reimbursement", $ReimbursementID);

    if (!$record) {
        echo "<script>alert('Reimbursement record not found.'); window.location.href='view-all-reimbursement.php';</script>";
        exit;
    }
} catch (Exception $e) {
    echo "<script>alert('Error retrieving reimbursement details. Please try again.'); window.location.href='view-all-reimbursement.php';</script>";
    exit;
}

if ($UserType != "Admin" && $UserType != "Client Admin") {
    try {
        $policyCustomer = new PolicyCustomer($conn);
        $policyNumbers = $policyCustomer->PolicyDetailsByUserID($loggedInUserID);
        $userPolicyNumbers = array_map(function ($policy) {
            return $policy["PolicyNumber"];
        }, $policyNumbers);

        if (!in_array($record["PolicyNumber"], $userPolicyNumbers)) {
            echo "<script>alert('You are not authorized to view this record.'); window.location.href='view-all-reimbursement.php';</script>";
            exit;
        }
    } catch (Exception $e) {
        echo "<script>alert('Error checking permissions. Please try again.'); window.location.href='view-all-reimbursement.php';</script>";
        exit;
    }
}

try {
    $documents = !empty($record['Documents']) ? json_decode($record['Documents']) : [];
} catch (Exception $e) {
    $documents = [];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reimbursement Details</title>
    <?php include "../include/common-head.php"; ?>
    <style>
        .document-preview {
            max-width: 200px;
            max-height: 200px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        .document-link {
            display: inline-block;
            margin: 5px;
            padding: 8px 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            text-decoration: none;
            color: #495057;
        }

        .document-link:hover {
            background-color: #e9ecef;
        }

        .table-details td {
            padding: 12px;
            vertical-align: middle;
        }

        .table-details td:first-child {
            font-weight: bold;
            width: 200px;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="app sidebar-mini ltr light-mode">
    <div class="page">
        <div class="page-main">
            <?php
            include "../navigation/top-header.php";
            include "../navigation/side-navigation.php";
            ?>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Reimbursement Details</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../dashboard/admin-dashboard">Home</a></li>
                                    <li class="breadcrumb-item"><a href="view-all-reimbursement.php">Reimbursements</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Reimbursement Information</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-details">
                                                <tbody>
                                                    <tr>
                                                        <td>Policy Number</td>
                                                        <td><?php echo htmlspecialchars($record['PolicyNumber']); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hospital Name</td>
                                                        <td><?php echo htmlspecialchars($record['HospitalName']); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Checkup Date</td>
                                                        <td><?php echo htmlspecialchars($record['CheckupDate']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Checkup Cost</td>
                                                        <td>₹<?php echo number_format($record['CheckupCost'], 2); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>
                                                            <span class="btn bg-<?php
                                                            echo $record['Status'] == 'Approved' ? 'success' :
                                                                ($record['Status'] == 'Rejected' ? 'danger' : 'warning');
                                                            ?>">
                                                                <?php echo htmlspecialchars($record['Status']); ?>
                                                            </span>
                                                            <?php if (($UserType == "Admin" || $UserType == "Client Admin") && $record['Status'] != 'Rejected' && $record['Status'] != 'Complete'): ?>
                                                                <div class="mt-2">
                                                                    <button type="button" class="btn btn-success"
                                                                        onclick="updateStatus('Complete')">
                                                                        <i class="fe fe-check me-1"></i> Complete
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="showRejectComment()">
                                                                        <i class="fe fe-x me-1"></i> Reject
                                                                    </button>
                                                                </div>
                                                                <div id="rejectCommentBox" class="mt-2"
                                                                    style="display: none;">
                                                                    <textarea class="form-control" id="rejectComment"
                                                                        rows="3"
                                                                        placeholder="Enter rejection reason..."></textarea>
                                                                    <button type="button" class="btn btn-primary  mt-2"
                                                                        onclick="updateStatus('Rejected')">
                                                                        Submit Rejection
                                                                    </button>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if ($record['Status'] == 'Rejected'): ?>
                                                        <tr>
                                                            <td>Rejection Reason</td>
                                                            <td><?php echo htmlspecialchars($record['Comments'] ?: 'N/A'); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <tr>
                                                        <td>Reason</td>
                                                        <td><?php echo htmlspecialchars($record['Reason'] ?: 'N/A'); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Created Date</td>
                                                        <td><?php echo htmlspecialchars($record['CreatedDate']); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Created Time</td>
                                                        <td><?php echo htmlspecialchars($record['CreatedTime']); ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <?php if (!empty($documents)): ?>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <h4>Documents</h4>
                                                    <div class="document-list">
                                                        <?php foreach ($documents as $document): ?>
                                                            <?php
                                                            $fileExtension = pathinfo($document, PATHINFO_EXTENSION);
                                                            $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
                                                            $filePath = "../reimbursement-media/" . $document;
                                                            ?>
                                                            <?php if ($isImage): ?>
                                                                <div class="document-preview">
                                                                    <a href="<?php echo $filePath; ?>" target="_blank">
                                                                        <img src="<?php echo $filePath; ?>" alt="Document"
                                                                            class="img-fluid"></a>
                                                                </div>
                                                            <?php else: ?>
                                                                <a href="<?php echo $filePath; ?>" class="document-link"
                                                                    target="_blank">
                                                                    <i class="fe fe-file-text me-1"></i>
                                                                    <?php echo $document; ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <a href="view-all-reimbursement.php" class="btn btn-secondary">
                                                    <i class="fe fe-arrow-left me-1"></i> Back to List
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
            </div>
            <!--app-content end-->
        </div>
    </div>

    <?php include "../include/common-script.php"; ?>

    <!-- Add hidden input for reimbursement ID -->
    <input type="hidden" id="reimbursementId" value="<?php echo $_GET['ReimbursementID']; ?>">

    <script src="../project-assets/js/customer-policy.js"></script>
    <script src="../project-assets/js/customer-reimbursement.js"></script>

    <script>
        // Initialize alertify
        alertify.set('notifier', 'position', 'top-right');
        alertify.set('notifier', 'delay', 3);

        function showRejectComment() {
            document.getElementById('rejectCommentBox').style.display = 'block';
        }

        function updateStatus(newStatus) {
            const comment = newStatus === 'Rejected' ? document.getElementById('rejectComment').value : '';

            if (newStatus === 'Rejected' && !comment.trim()) {
                alertify.error("Please provide a rejection reason");
                return;
            }

            alertify.confirm("Update Status",
                "Are you sure you want to " + newStatus.toLowerCase() + " this reimbursement?",
                function () {
                    $.ajax({
                        url: 'action/update-reimbursement-status.php',
                        type: 'POST',
                        data: {
                            ReimbursementID: '<?php echo $_GET['ReimbursementID']; ?>',
                            Status: newStatus,
                            Comment: comment
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                window.location.reload();
                            } else {
                                alertify.error("Error updating status: " + (response.message || "Unknown error"));
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Error details:", {
                                status: status,
                                error: error,
                                response: xhr.responseText
                            });
                            alertify.error("Error updating status");
                        }
                    });
                },
                function () {
                    alertify.error("Status update cancelled");
                }
            );
        }
    </script>
</body>

</html>