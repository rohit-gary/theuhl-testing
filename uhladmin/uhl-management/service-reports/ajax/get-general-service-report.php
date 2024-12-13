<?php
@session_start();
require_once('../../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['dwd_OrgID'] must be set
include("../../include/get-db-connection.php");
$CMUsers = new CMUsers($conn);
$all_users = $CMUsers->getAllActiveUsers();
// print_r($all_users);
// die();
?>

<div class="panel panel-primary">
    <div class="tab-menu-heading">
        <div class="tabs-menu">
            <!-- Tabs -->
            <ul class="nav panel-tabs panel-success">
                <li class='w-50'><a href="#customer_details" class="active" data-bs-toggle="tab"><span><i
                                class="fe fe-user me-1"></i></span> Report Details</a>
                </li>
                <li class='w-50'><a href="#client_details" data-bs-toggle="tab"><span><i
                                class="fe fe-calendar me-1"></i></span>
                        Client Details</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="panel-body tabs-menu-body" style='background: #f3f3f3;'>
        <div class="tab-content">
            <div class="tab-pane active" id="customer_details">

                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label for="recipient-name" class="col-form-label">Reported By<span
                                class="text-danger">*<span></label>
                        <input type="text" class="form-control" name="ReportedBy" id="ser_reported_by"
                            Placeholder="Enter Reported By">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="recipient-name" class="col-form-label">RPM Enterprises Helpdesk Complaint No.<span
                                class="text-danger">*<span></label>
                        <input type="text" class="form-control" name="HelpdeskComplaintNumber" id="ser_jll_helpdesk_no"
                            Placeholder="Enter RPM Helpdesk Complaint No.">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label for="recipient-name" class="col-form-label">Registered Date <span
                                class="text-danger">*<span></label>
                        <input type="text" class="form-control" name="RegisteredDate" id="ser_registered_date"
                            Placeholder="Enter Completed Date ">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label for="recipient-name" class="col-form-label">Attended Date<span
                                class="text-danger">*<span></label>
                        <input type="text" class="form-control" name="AttendedDate" id="ser_attended_date"
                            Placeholder="Enter Attended Date">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label for="recipient-name" class="col-form-label">Completed Date <span
                                class="text-danger">*<span></label>
                        <input type="text" class="form-control" name="CompletedDate" id="ser_completed_date"
                            Placeholder="Enter Completed Date ">
                    </div>


                    <div class="form-group col-md-12 col-12">
                        <h5 style='font-weight:600;'>Natural Of Call<span class="text-danger">*<span></h5>
                    </div>

                    <div class="form-group col-md-4 col-12">
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="NatureOfCall"
                                value="Comprehensive AMC">
                            <span class="custom-control-label">Comprehensive AMC</span>
                        </label>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="NatureOfCall"
                                value="Non-Comprehensive AMC">
                            <span class="custom-control-label">Non-Comprehensive AMC</span>
                        </label>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="NatureOfCall" value="Warranty">
                            <span class="custom-control-label">Warranty</span>
                        </label>
                    </div>

                    <div class="form-group col-md-4 col-12">
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="NatureOfCall" value="Chargeable">
                            <span class="custom-control-label">Chargeable</span>
                        </label>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="NatureOfCall" value="Emergency">
                            <span class="custom-control-label">Emergency</span>
                        </label>
                    </div>

                    <div class="form-group col-md-4 col-12">
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="NatureOfCall" value="Complaint">
                            <span class="custom-control-label">Complaint</span>
                        </label>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Problem Reported by Client: <span class="text-danger">*<span></label>
                        <textarea class="form-control" placeholder="Please Enter Problem Reported" rows="2"
                            name="ProblemReportedByClient" id="ser_problem_reported"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Observation: <span class="text-danger">*<span></label>
                        <textarea class="form-control" placeholder="Please Enter Observation" rows="2"
                            name="JLLObservation" id="ser_jll_observation"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Action Taken: <span class="text-danger">*<span></label>
                        <textarea class="form-control" placeholder="Please Enter Action Taken" rows="2"
                            name="ActionTaken" id="ser_action_taken"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Remarks: </label>
                        <textarea class="form-control" placeholder="Please Enter Remarks" rows="2" name="Remarks"
                            id="ser_remarks"></textarea>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label for="recipient-name" class="col-form-label">RPM Enterprises Technician (Job Done By) <span
                                class="text-danger">*<span></label>

                            <select class="form-control select2-show-search form-select" id="ser_jll_mes_technician"
                                            name="Technician" style="width:100%;" data-placeholder="Select MES Technician">
                                <option label="Choose one"></option>
                                <?php 
                                    foreach ($all_users as $User_value) 
                                    {
                                    ?>
                                <option value="<?php echo $User_value['UserName']; ?>">
                                    <?php echo $User_value['Name']; ?></option>
                                <?php
                                    }
                                    ?>
                            </select>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h3 class="modal-title">Add Service Image
                                <a class='badge bg-success' onclick="AddServiceImage()"><i
                                        class="fe fe-plus text-light"></i></a>
                            </h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-8 col-12">
                            <label for="recipient-name" class="col-form-label">Service Image </label>
                            <input type="file" class="form-control sub_startdate" name="ServiceImages[]" id='ser_service_img'/>
                        </div>
                    </div>
                    <div id="service_image_box"></div>

                    <div id="service-image-container" style="display:none;">

                    </div>

                    <input type="hidden" id="new_service_counter" value=1 />



                    <div class="mt-5 text-center">
                        <button class="btn btn-success text-white" id="addUpdateServiceBtn"
                            onclick="AddUpdateServiceReport()">Save</button>
                        <!-- <a href="#"  class="btn btn-success">Submit</a> -->
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="client_details">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="recipient-name" class="col-form-label">Onsite Client Representative Name
                                (Verified
                                By) <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="ClientRepresentative" id="ser_onsite_client"
                                Placeholder="Enter Onsite Client Representative Name (Verified By)">
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label for="recipient-name" class="col-form-label">Client Representative Contact <span
                                    class="text-danger">*<span></label>
                            <input type="text" class="form-control" name="ClientRepresentativeContact"
                                id="ser_onsite_client_contact" Placeholder="Enter Client Representative Contact">
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label for="recipient-name" class="col-form-label">Client Representative Emails </label>
                            <input type="text" class="form-control" name="ClientRepresentativeEmails"
                                id="ser_onsite_client_email" Placeholder="Enter Client Representative Emails">
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label for="recipient-name" class="col-form-label">Client Representative Designation</label>
                            <input type="text" class="form-control" name="ClientRepresentativeDesignation"
                                id="ser_onsite_client_designation"
                                Placeholder="Enter Client Representative Designation">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3 class="modal-title">Add Signature</h3>
                        </div>
                    </div>

                    <div class="row align-items-end">
                        <div class="mb-3 col-md-8 col-12">
                            <label for="recipient-name" class="col-form-label">Signature</label>
                            <input type="file" class="form-control sub_startdate" name="SignatureImage"
                                Placeholder="Enter Start Date" />
                        </div>
                        <div class="col-md-4" id='signature_img_div' style="display:none;">
                            <img src="" width="200px" id="client_signature_img"  alt="Signature">
                        </div>
                    </div>
                    <div id="signature_box"></div>

                    <input type="hidden" id="new_signature_counter" value=1 />
                    <input type="hidden" id='service_report_form_id' name='ReportID'>

                    <div class="text-center mt-3">
                      <button class="btn btn-danger text-white" id="addUpdateCompleteBtn"
                        onclick="AddUpdateClientDetails()">Complete</button>
                    </div>
            </div>



        </div>
    </div>
</div>
</div>