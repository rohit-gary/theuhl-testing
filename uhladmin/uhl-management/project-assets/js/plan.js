$(document).ready(function () {
    var i = 1;
    $('#all_Plans').dataTable({
        'responsive': true,
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/view-all-Plans-post.php'
        },
        'columnDefs': [{
            "targets": [0],
            "className": "text-center"
        }],
        "order": [
            [1, 'asc']
        ],
        'columns': [{
            "data": "id",
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'PlanImage'
        },
        {
            data: 'PlanName'
        },
        {
            data: 'PlanDetails'
        },
        {
            data: 'PlanCoordinator'
        },
        {
            data: 'Action'
        }
        ]


    });
});

function isValidEmail(email) {
    // Regular expression to check if the email is valid
    var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;

    // Test the email against the regular expression
    return emailRegex.test(email);
}

function validaphone(phone) {
    var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    if (!regex.test(phone)) {
        return false;
    } else {
        return true;
    }
}


function validISNumber(basic) {
    const input = event.target;
    let value = input.value;

    value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
    input.value = value;
}


function AddPlans() {
    $("#Plans_form")[0].reset();
    $("#add_Plans").modal("show");
    $("#addPlansBtn").html("Add");
    $("#PlansHeading").html("Add Plan");
    $("#form_id").val('-1');
    $("#PlanImage_span").html('');
     PlanDescription.setHTML('');
     PlanHighlights.setHTML('');
}

var PlanDescription;
var PlanHighlights;
function UpdatePlan_modal(Plans_id) {

    $("#addPlansBtn").html("Update");
    $("#PlansHeading").html("Update Plan Details");

    $.post("ajax/get_Plan_details.php", {
        ID: Plans_id
    },
        function (data, status) {
            var response = JSON.parse(data);
           
             if (Array.isArray(response.data)) {
                    var planData = response.data[0];  
                } else {
                    var planData = response.data;
                }
                 console.log(planData.PlanDurationFormat); 
            if (response.error == false) {
                $("#PlanImage_hidden").val(planData.PlanImage);
                $("#PlanImage_span").html(planData.PlanImage);
                $("#PlanImage_span").css("display","block");

                $("#Name").val(planData.PlanName);
                $("#Duration").val(planData.PlanDuration);
                $("#DurationFormat").val(planData.PlanDurationFormat);
                $("#family_member").val(planData.PlanFamilyMember); 
                $("#min_family_member").val(planData.PlanMinimumFamilyMember);

                 $("#coverage_comments").val(planData.CoverageComments);
                 $("#PlanCost").val(planData.PlanCost);

                  $("#plan_point").val(planData.PlanImportantPoint);
                 
                 $("#minimum_age").val(planData.MinimumAge);
                 $("#maximum_age").val(planData.MaximumAge);
                 $("#valid_area").val(planData.ValidArea);
                 $("#payments").val(planData.Payments);

                 $("#isDisplay").val(planData.IsDisplay);


 
                    if (!PlanHighlights) {
                PlanHighlights = new RichTextEditor("#plan_highlights");
            }
                  PlanHighlights.setHTMLCode(planData.PlanHighlights);
                  // $("#plan_highlights").val(planData.PlanHighlights);

                     if (!PlanDescription) {
                PlanDescription = new RichTextEditor("#plan_Description");
            }
                  PlanDescription.setHTMLCode(planData.PlanDescription);
                   // $("#plan_Description").val(planData.PlanDescription);

                $("#form_action").val("Update");
                $("#form_id").val(Plans_id);
            }
        });
    $("#add_Plans").modal("show");
}


function AddUpdatePlansForm() {

    var Name = $("#Name").val();
    if (Name == "") {
        Alert("Please Enter Plans Name.");
        return false;
    }


    var Duration = $("#Duration").val();
    if (Duration == "") {
        Alert("Please Enter Plans Duration.");
        return false;
    }

    var family_member=$("#family_member").val();
    if(family_member==''){
        Alert("Please Enter Family Member.");
        return false;
    }   

     var min_family_member=$("#min_family_member").val();
    if(min_family_member==''){
        Alert("Please Enter Minimum Family Member.");
        return false;
    } 

    var coverage_comments=$("#coverage_comments").val();
    if(coverage_comments==''){
        Alert("Please Enter Coverage Comments.");
        return false;
    }

    var PlanCost = $("#PlanCost").val();
    if (PlanCost == "") {
        Alert("Please Enter Plans Cost.");
        return false;
    }


    var plan_point = $("#plan_point").val();
    if (plan_point == "") {
        Alert("Please Enter Plans Point.");
        return false;
    }



     var minimum_age = $("#minimum_age").val();
    if (minimum_age == "") {
        Alert("Please Enter Minimum Age.");
        return false;
    }


    var maximum_age = $("#maximum_age").val();
    if (maximum_age == "") {
        Alert("Please Enter Maximum Age.");
        return false;
    }



     var valid_area = $("#valid_area").val();
    if (valid_area == "") {
        Alert("Please Enter Valid Area.");
        return false;
    }


    var payments = $("#payments").val();
    if (payments == "") {
        Alert("Please Enter Payments.");
        return false;
    }


    var plan_highlights = $("#plan_highlights").val();
    if (plan_highlights == "") {
        Alert("Please Enter Plans Short Description.");
        return false;
    }

    var plan_Description = $("#plan_Description").val();
    if (plan_Description == "") {
        Alert("Please Enter Plans Long Description.");
        return false;
    }


     

    let form_action = $("#form_action").val();
    let btntext = "";
    if (form_action == "add") {
        btntext = "Add";
    } else {
        btntext = "Update";
    }



    let myForm = document.getElementById("Plans_form");
    var formData = new FormData(myForm);

    $("#addPlansBtn").html("Please Wait..");
    $.ajax({
        url: "action/add-update-Plans.php",
        type: "POST",
        data: formData,
        success: function (data) {
            var response = JSON.parse(data);
            Alert(response.message);
            if (response.error == false) {
                $("#addPlansBtn").html("Add");
                $('#Plans_form')[0].reset();
                $("#add_Plans").modal("hide");
            }else{
                $("#addPlansBtn").html(btntext);
            }
            $('#all_Plans').DataTable().ajax.reload();
        },
        cache: false,
        contentType: false,
        processData: false,
    });
    return false;

}


function DeletePlan(Plans_id) {
   alertify.confirm(
        "Do you really want to delete Plans?",
        function () {
            $.post(
                "action/delete-Plan.php",
                {
                    ID: Plans_id,
                },
                function (data, status) {
                    var response = JSON.parse(data);
                    Alert(response.message);
                    if (response.error == false) {
                        setInterval(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            );
        },
        function () {
            alertify.error("Deletion Cancelled");
        }
    );
}

function UpdatePlanCoordinator_modal(Plans_id) {
 $('.select2').select2();
    $.post("ajax/get_Plan_details.php", {
        ID: Plans_id
    },
        function (data, status) {
            var response = JSON.parse(data);
               console.log("Parsed response:", response); // Log parsed response
           console.log(response.data);
            if (response.error == false) {
                // $("#PlanCoordinator").val(response.data.PlanCoordinator);
                  console.log("PlanCoordinator:", response.data.PlanCoordinator); // Log PlanCoordinator value
                $('#PlanCoordinator').select2().val(response.data.PlanCoordinator).trigger('change');

                if(response.data.PlanCoordinator != -1){
                    $("#addPlanCoordinatorBtn").html("Update Coordinator");
                }
                $("#coordinator_form_id").val(Plans_id);

              
            }
        });
    $("#add_Plan_coordinator").modal("show");
}


function AddUpdatePlanCoordinatorForm() {

    var PlanCoordinator = $("#PlanCoordinator").val();
    if (PlanCoordinator == -1) {
        Alert("Please Select Plan Coordinator.");
        return false;
    }


    let coordinator_form = document.getElementById("coordinator_Plans_form");
    var coordinator_formData = new FormData(coordinator_form);

    $("#addPlansBtn").html("Please Wait..");
    $.ajax({
        url: "action/add-update-Plan-coordinator.php",
        type: "POST",
        data: coordinator_formData,
        success: function (data) {
            var response = JSON.parse(data);
            Alert(response.message);
            if (response.error == false) {
                $("#add_Plan_coordinator").modal("hide");
                $('#all_Plans').DataTable().ajax.reload();
            }
        },
        cache: false,
        contentType: false,
        processData: false,
    });
    return false;

}

