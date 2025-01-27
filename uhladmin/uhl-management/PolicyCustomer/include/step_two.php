<form id="policy_form" onsubmit="return false;">

    <input type="hidden" id="form_action_policy" name="form_action"
        value="<?php echo isset($policy_form_action) ? $policy_form_action : ''; ?>" />
    <input type="hidden" id="form_id_policy" name="form_id" value="<?php echo $PolicyFormId ?>" />
    <input type="hidden" id="customer_id" value="<?php echo $Customerid; ?>" />


    <div class="row">
        <?php
        // Loop through each plan to display it
        foreach ($All_Pans as $plan) {
            // Check if plan's ID is in the selected plans array
            $isSelected = in_array($plan['ID'], $selectedPlans) ? 'checked' : '';

            ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm plan-card" id="plan-card-<?php echo $plan['ID']; ?>"
                    onclick="togglePlanSelection(<?php echo $plan['ID']; ?>)">
                    <!-- <img src="<?php echo htmlspecialchars($plan['PlanImage']); ?>" class="card-img-top" alt="Plan Image"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($plan['PlanName']); ?></h5>
                        <p class="d-none"><strong>Duration:</strong>
                            <?php echo htmlspecialchars($plan['PlanDuration']) . ' ' . htmlspecialchars($plan['PlanDurationFormat']); ?>
                        </p>
                        <p class=""><strong>Family Members Covered:</strong>
                            <?php echo htmlspecialchars($plan['PlanFamilyMember']); ?></p>
                        <p class=""><strong>Cost:</strong>
                            ₹<?php echo number_format(htmlspecialchars($plan['PlanCost']), 2); ?></p>
                        <button class="btn btn-warning"
                            onclick="event.stopPropagation(); openPlanDetailsModel(<?php echo htmlspecialchars(json_encode($plan), ENT_QUOTES, 'UTF-8'); ?>)">
                            <i class="ti-info-alt"></i>
                        </button>
                        <!-- Checkbox for selection -->
                        <input type="checkbox" class="form-check-input" name="selected_plan[]"
                            value="<?php echo htmlspecialchars($plan['ID']); ?>" id="plan-<?php echo $plan['ID']; ?>"
                            style="display: none;" <?php echo $isSelected ?>>

                        <!-- Green check mark (hidden by default) -->
                        <div class="check-mark" id="check-mark-<?php echo $plan['ID']; ?>"
                            style="display: <?php echo $isSelected ? 'block' : 'none'; ?>;">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="plan-card" id="plan-card-<?php echo $plan['ID']; ?>"
                            class="<?php echo $isSelected ? 'selected' : ''; ?>">
                            <!-- Rest of the card content -->
                            <input type="checkbox" style="display:none;" <?php echo $isSelected ? 'checked' : ''; ?>>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <button type="button" class="btn btn-primary" onclick="goToPreviousStep()">Previous</button>
    <button type="button" class="btn btn-success" onclick="saveSelectedPlans()" id="savePolicyBtn">Save</button>
    <button type="button" class="btn btn-primary" id="gotothirdstep" onclick="goToNextStep()">Next</button>

</form>



<!-- -----------------------plans details model here-------------------------- -->

<div class="modal fade" id="planDetailsModal" tabindex="-1" aria-labelledby="planDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planDetailsModalLabel">Plan Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="modalPlanImage" src="" alt="Plan Image" class="img-fluid rounded"
                        style="width: 250px; height: auto;">

                </div>
                <h5 class="text-primary fs-4" id="modalPlanName"></h5>
                <hr>
                <p><strong>Duration:</strong> <span id="modalPlanDuration"></span></p>
                <p><strong>Family Members Covered:</strong> <span id="modalPlanFamilyMember"></span></p>
                <p><strong>Cost:</strong> ₹<span id="modalPlanCost"></span></p>
                <p><strong>Plan Benefits:</strong></p>
                <ul id="modalCoverageComments" class="ms-3"></ul>
            </div>
        </div>
    </div>
</div>