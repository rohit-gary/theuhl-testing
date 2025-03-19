<form id="customer_test_form" onsubmit="return false;">
    <input type="hidden" id="form_test_action" name="form_test_action" value="Add"  />

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="poc_name" id="test_poc_name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Phone Number<span class="text-red">*</span></label>
                    <input type="text" class="form-control" placeholder="Phone Number" name="test_poc_contact_number"
                        id="test_poc_contact_number" oninput="validateNumericInput(this)">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Email <span class="text-red">*</span></label>
                    <input type="email" class="form-control" placeholder="Email" autocomplete="username" name="email"
                        id="test_email">
                </div>
            </div>

           

            
        </div>
    </div>


    <button type="button" class="btn btn-success" onclick="SaveTestCustomer()" id="savecustomerBtn">Save</button>
    <button type="button" class="btn btn-primary" id="gotosecondstep" onclick="goToNextStep()">Next</button>
</form>