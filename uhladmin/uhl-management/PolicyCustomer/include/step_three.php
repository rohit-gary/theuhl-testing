<?php var_dump($_SESSION); ?>
<form id="step-3-form" onsubmit="return false;">
    <input type="hidden" id="form_action_family" name="form_action" value="" />
    <input type="hidden" id="form_id" name="form_id" value="" />

    <input type="hidden" id="PolicyNumber" value="<?php echo $PolicyNumber ?>">
    <!-- Dynamic member forms will be appended here -->
    <div id="step-3-form-container"></div>
    
    <button type="button" class="btn btn-primary" onclick="goToPreviousStep()">Previous</button>
    <button type="button" class="btn btn-success" onclick="savefamilyMember()" id="savefamilyMemberBtn">Save</button>
    <button type="button" class="btn btn-primary" onclick="goToNextStep()" id="gotofourthstep">Next</button>
</form>
