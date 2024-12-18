     <form id="familyMemberForm">
                       <input type="hidden" id="ad_form_action" name="form_action"/>
                       <input type="hidden" id="ad_form_id" name="form_id" />
                     <!-- Plan Select Element -->
                          <label for="familyMemberSelect" class="form-label fw-bold d-flex align-items-center">
                            Select Plan 
                            <span 
                                id="refreshBadgePlan" 
                                class="badge bg-primary ms-2" 
                                style="cursor: pointer;" 
                                title="Click to refresh Plan"
                            >
                                Refresh
                            </span>
                        </label>
                            <select class="form-control" id="planSelect" name="planSelect" required>
                                <option value="" disabled selected>Select Plan</option>
                               <?php 
            // Include the get-plans.php file to directly generate the options
                           include("../include/get-plans.php");
                             ?>
                            </select>


                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ad_member_name" name="member_name" placeholder="Enter family member's name" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="ad_member_dob" name="member_dob" required>
                    </div>

                    <!-- Gender -->
                    <div class="form-group mb-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="ad_member_gender_male" name="member_gender" value="male" required>
                            <label class="form-check-label" for="member_gender_male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="ad_member_gender_female" name="member_gender" value="female" required>
                            <label class="form-check-label" for="ad_member_gender_female">Female</label>
                        </div>
                    </div>

                    <!-- Relationship -->
                    <div class="form-group mb-3">
                        <label class="form-label">Relationship <span class="text-danger">*</span></label>
                        <select class="form-control" id="ad_member_relationship" name="member_relationship" required>
                            <option value="" disabled selected>Select Relationship</option>
                            <option value="MySelf">MySelf</option>
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
                </form>
            </div>
            <div class="modal-footer">
                
                <button type="submit" class="btn btn-primary" onclick="saveAdditionalFamilyMember()"form="familyMemberForm">Save</button>
            </div>