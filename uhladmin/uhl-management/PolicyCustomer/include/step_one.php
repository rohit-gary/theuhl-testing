<?php var_dump($_SESSION);?>
<form id="customer_form" onsubmit="return false;">
    <input type="hidden" id="form_action" name="form_action" value="<?php echo isset($Action) ? $Action : ''; ?>" />

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="poc_name" id="poc_name" value="<?php echo isset($customerForm['poc_name']) ? $customerForm['poc_name'] : ''; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Contact Number <span class="text-red">*</span></label>
                    <input type="text" class="form-control" placeholder="Contact Number" name="poc_contact_number" id="poc_contact_number" oninput="validateNumericInput(this)" value="<?php echo isset($customerForm['poc_contact_number']) ? $customerForm['poc_contact_number'] : ''; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Gender <span class="text-red">*</span></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" <?php echo ($selectedGender === 'male') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="genderMale">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" <?php echo ($selectedGender === 'female') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="genderFemale">Female</label>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date of Birth <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="dob" id="dob" value="<?php echo isset($customerForm['dob']) ? $customerForm['dob'] : ''; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Email <span class="text-red">*</span></label>
                    <input type="email" class="form-control" placeholder="Email" autocomplete="username" name="email" id="email" value="<?php echo isset($customerForm['email']) ? $customerForm['email'] : ''; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label class="form-label">State <span class="text-red">*</span></label>
                    <select class="form-control form-select" name="state" id="state" required>
                        <option value="">Select State</option>
                        <?php 
                        $selectedState = isset($customerForm['state']) ? $customerForm['state'] : ''; 
                        foreach ($All_State as $state) {
                            $stateID = htmlspecialchars($state['ID']);
                            $stateName = htmlspecialchars($state['StateName']);
                            $isSelected = ($stateID === $selectedState) ? 'selected' : ''; 
                            echo '<option value="' . $stateID . '" ' . $isSelected . '>' . $stateName . '</option>';
                        } 
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label class="form-label">Pin Code <span class="text-red">*</span></label>
                    <input type="number" class="form-control" placeholder="ZIP Code" name="pincode" id="pincode" value="<?php echo isset($customerForm['pincode']) ? $customerForm['pincode'] : ''; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Present Address <span class="text-red">*</span></label>
            <input type="text" class="form-control" placeholder="Home Address" name="address" id="address" value="<?php echo isset($customerForm['address']) ? $customerForm['address'] : ''; ?>">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Permanent Address <span class="text-red">*</span></label>
            <input type="text" class="form-control" placeholder="Home Address" name="p_address" id="p_address" value="<?php echo isset($customerForm['address']) ? $customerForm['address'] : ''; ?>">
        </div>
    </div>

    <button type="button" class="btn btn-success" onclick="SaveCustomer()" id="savecustomerBtn">Save</button>
    <button type="button" class="btn btn-primary" id="gotosecondstep" onclick="goToNextStep()">Next</button>
</form>