<?php 

require_once('uhladmin/uhl-management/include/autoloader.inc.php');
include("uhladmin/uhl-management/include/db-connection.php");

@session_start();
$conf = new Conf();
$dbh = new Dbh();

$masterconn = $dbh->_connectodb();
$plans = new Plans($conn);
$AllPlan = $plans->GetAllPlan();
$latestPlans = array_slice($AllPlan, 0, 3); 
?>

<head>
    <title>View All Plans</title>
</head>

<div class="container">
    <div class="row ">
        <?php if (!empty($latestPlans)) { ?>
            <?php foreach ($latestPlans as $Plan) { ?>
                <div class="col-lg-4">
                    <div class="pricing-box mt-4">
                        <div class="pricing-badge">
                            <span class="badge">New Launch</span>
                        </div>
                        <?php 
                      
                        if ($Plan['PlanFamilyMember'] > 1) {
                            
                            echo '<i class="mdi mdi-account-multiple h1 text-primary"></i>';
                        } else {
                            
                            echo '<i class="mdi mdi-account h1 text-primary"></i>';
                        }
                        ?>
                        <h4 class="f-20"><?php echo htmlspecialchars($Plan['PlanName']); ?></h4>

                        <div class="mt-4 pt-2">
                                        <p class="mb-2 f-18"><b>Highlighted Features</b></p>

                                        <?php 
                                        // Check if PlanHighlights is set and not empty
                                        if (!empty($Plan['PlanHighlights'])) {
                                            // Assuming PlanHighlights contains the highlights in quotes
                                            $highlightsString = strip_tags($Plan['PlanHighlights']); // Strip HTML tags if any

                                            // Use regex to extract quoted strings
                                            preg_match_all('/"(.*?)"/', $highlightsString, $matches);

                                            // Check if any matches were found
                                            if (!empty($matches[1])) {
                                                foreach ($matches[1] as $highlight) {
                                                    // Trim whitespace around the highlight
                                                    $highlight = trim($highlight);
                                                    if (!empty($highlight)) { // Ensure the highlight is not empty
                                                        echo '<p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2 me-3"></i>' . htmlspecialchars($highlight) . '</p>';
                                                    }
                                                }
                                            } else {
                                                // If no valid highlights were found, show a message
                                                echo '<p class="mb-2">No highlighted features available.</p>';
                                            }
                                        } else {
                                            // If PlanHighlights is not set or empty, show a message
                                            echo '<p class="mb-2">No highlighted features available.</p>';
                                        }
                                        ?>
                                    </div>

                        <div class="pricing-plan mt-4 pt-2">
                                   <?php
                                    $planCost = $Plan['PlanCost'];
                                    $originalCost = round($planCost * 1.28); // Calculating 28% extra of the plan cost
                                    ?>
                                    <h4 class="text-muted">
                                        <s>₹ <?php echo $originalCost; ?> </s>
                                        <span class="plan pl-3 text-dark">₹ <?php echo $planCost; ?> </span>
                                        <p class="d-inline text-success mb-0 small" style="margin-left: -0.5rem !important;">(28% Off)</p>
                                    </h4>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-calendar me-2" style="font-size: 18px;"></i> <?php echo htmlspecialchars($Plan['PlanDuration']); ?>&nbsp;<?php echo htmlspecialchars($Plan['PlanDurationFormat']); ?>
                            </p>
                            <p class="text-muted mb-0">
                                <?php 
                                if ($Plan['PlanFamilyMember'] == 1) {
                                    // Single member icon
                                    echo '<i class="mdi mdi-account me-2" style="font-size: 18px;"></i> Single member';
                                } else {
                                    // Multiple members icon
                                    echo '<i class="mdi mdi-account-multiple me-2" style="font-size: 18px;"></i> Up to ' . htmlspecialchars($Plan['PlanFamilyMember']) . ' members';
                                }
                                ?>
                            </p>
                        </div>

                       <div class="mt-4 pt-3">
                            <?php
                            
                            $encryptedPlanID = base64_encode($Plan['ID']);
                            ?>
                            <a href="view-plan-details.php?id=<?php echo htmlspecialchars($encryptedPlanID); ?>" class="btn site-button appointment-btn btnhover13 btn-rounded">View Plan Details</a>
                        </div>

                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
