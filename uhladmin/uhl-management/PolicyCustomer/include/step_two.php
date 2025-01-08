
<form id="policy_form" onsubmit="return false;">

    <input type="hidden" id="form_action_policy" name="form_action" 
        value="<?php echo isset($policy_form_action) ? $policy_form_action : ''; ?>" />
    <input type="hidden" id="form_id_policy" name="form_id" 
        value="<?php echo $PolicyFormId ?>" />
    <input type="hidden" id="customer_id" value="<?php echo $Customerid; ?>" />
  

    <div class="row">
        <?php
        // Loop through each plan to display it
        foreach ($All_Pans as $plan) {
            // Check if plan's ID is in the selected plans array
            $isSelected = in_array($plan['ID'], $selectedPlans) ? 'checked' : '';
        ?>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm plan-card" id="plan-card-<?php echo $plan['ID']; ?>" onclick="togglePlanSelection(<?php echo $plan['ID']; ?>)">
                <img src="<?php echo htmlspecialchars($plan['PlanImage']); ?>" class="card-img-top" alt="Plan Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($plan['PlanName']); ?></h5>
                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($plan['PlanDuration']) . ' ' . htmlspecialchars($plan['PlanDurationFormat']); ?></p>
                    <p><strong>Family Members Covered:</strong> <?php echo htmlspecialchars($plan['PlanFamilyMember']); ?></p>
                    <p><strong>Cost:</strong> ₹<?php echo number_format(htmlspecialchars($plan['PlanCost']), 2); ?></p>
                    
                    <!-- Checkbox for selection -->
                    <input type="checkbox" class="form-check-input" name="selected_plan[]" 
                        value="<?php echo htmlspecialchars($plan['ID']); ?>" 
                        id="plan-<?php echo $plan['ID']; ?>" 
                        style="display: block;" <?php echo $isSelected ?> >

                    <!-- Green check mark (hidden by default) -->
                    <div class="check-mark" id="check-mark-<?php echo $plan['ID']; ?>" style="display: none;">
                        <i class="fas fa-check-circle text-success"></i>
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
