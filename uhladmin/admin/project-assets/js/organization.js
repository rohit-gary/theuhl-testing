    $(document).ready(function() {
        var i = 1;
        $('#organization_table').dataTable({
            'responsive': true,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajax/view_all_organization_post.php'
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
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'OrganizationName'
                },
                {
                    data: 'Address'
                },
                {
                    data: 'POC_Email_Phone'
                },
                {
                    data: 'Modules'
                },
                {
                    data: 'GST'
                },
                
                {
                    data: 'OnBoardingDate'
                },
                {
                    data: 'Action'
                }
            ]
        });
    });

function AddOrganization(){
  $("#organization_form")[0].reset();
  $("#add_organization").modal("show");
  $("#addOrganizationBtn").html("Add");
  $("#OrganizationHeading").html("Add Organization");
  $("#tb_org_password").show();
  $("#tb_org_confirm_password").show();
  $("#form_id").val('-1');
}

function UpdateOrganization_modal(organization_id){
    $("#addOrganizationBtn").html("Update");
    $("#OrganizationHeading").html("Update Organization");
    $("#tb_org_password").hide();
    $("#tb_org_confirm_password").hide();

    $.post("action/get_organization_details.php", {
            ID: organization_id
        },
        function(data, status) {
            var response = JSON.parse(data);
            if(response.error == false)
            {
                var organizationname = response.data.OrganizationName;
                var address = response.data.Address;
                var poc = response.data.POC;
                var email = response.data.Email;
                var phonenumber = response.data.PhoneNumber;
                var gstno = response.data.GSTNo;
                var SubDomain = response.data.SubDomain;
                $("#organizationname").val(organizationname);
                $("#address").val(address);
                $("#poc").val(poc);
                $("#email").val(email);
                $("#phonenumber").val(phonenumber);
                $("#gstno").val(gstno);
                $("#subdomain").val(SubDomain);
                $("#form_action").val("Update");
                $("#form_id").val(organization_id);

            }
        });
    $("#add_organization").modal("show");
}

function AddUpdateOrganizationForm()
{
  var organizationname = $("#organizationname").val();
  if(organizationname == ""){
      Alert("Please Enter Organizationname Name");
      return false;
  }

  var address = $("#address").val();
  if(address == ""){
      Alert("Please Enter Address");
      return false;
  }

  var poc = $("#poc").val();
  if(poc == ""){
      Alert("Please Enter POC");
      return false;
  }

  var email = $("#email").val();
  if(email == ""){
      Alert("Please Enter Email");
      return false;
  }

  var phonenumber = $("#phonenumber").val();
  if(phonenumber == ""){
      Alert("Please Enter Phone Number");
      return false;
  }

  var form_action = $("#form_action").val();
  if(form_action != "Update")
  {
    var password = $("#password").val();
    if(password == ""){
        Alert("Please Enter Password");
        return false;
    }

    var confirmpassword = $("#confirmpassword").val();
    if(confirmpassword == ""){
        Alert("Please Enter Confirm Password");
        return false;
    }
  }

  /*var gstno = $("#gstno").val();
  if(gstno == ""){
      Alert("Please Enter GST No");
      return false;
  }*/

 /* var logo = $("#logo").val();

  if(logo == ""){
      Alert("Please Upload Logo");
      return false;
  }*/

  let myForm = document.getElementById("organization_form");
  var formData = new FormData(myForm);

  $("#addOrganizationBtn").html("Please Wait..");
  $.ajax({
      url: "action/organization-form-action.php",
      type: "POST",
      data: formData,
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              $("#addOrganizationBtn").html("Add");
              $('#organization_form')[0].reset();
              $("#add_organization").modal("hide");
              $('#organization_table').DataTable().ajax.reload();
          }
      },
    cache: false,
    contentType: false,
    processData: false,
  });
  return false;
}


function DeleteOrganization(organization_id) {
  alertify.confirm(
    "DWD",
    "Do you really want to delete Organization?",
    function () {
      $.post(
        "action/delete_organization.php",
        {
          ID: organization_id,
        },
        function (data, status) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
            $('#organization_table').DataTable().ajax.reload();
          }
        }
      );
    },
    function () {
      alertify.error("Deletion Cancelled");
    }
  );
}


function ExportOrganizationData() {
    $.ajax({
        url: "action/export-organization.php",
        type: "POST",
        
        success: function (data) {

          var xlsFilePath = './report.xls';

          var anchor = document.createElement("a");
          anchor.href = xlsFilePath;
          anchor.download = 'all-organization-data.xls';
          anchor.click();
        },
    });
    return false;
}

function ShowOrgModules(OrgID)
{
    $.post("ajax/view-org-modules",
    {
      OrgID: OrgID,
    },
    function (data, status) {
        document.getElementById("org_modules_modal_body_div").innerHTML = data;
        $(".sub_startdate").datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            autoclose: true,
        });
        $(".sub_enddate").datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            autoclose: true,
        });
        $("#organization_modules_modal").modal("show");
    }
  );
}

function AddModule()
{
    var new_module_counter = $("#new_module_counter").val();
    next_counter = parseInt(new_module_counter)+1;
    $.post("ajax/module-html.php",
    {
        counter:new_module_counter
    },
    function (data, status) {
        $("#add_module_html_div").append(data);
        $(".sub_startdate").datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            autoclose: true,
        });
        $(".sub_enddate").datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            autoclose: true,
        });

    }
  );
  $("#new_module_counter").val(next_counter);
}
function DeleteNewModule(counter)
{
    var div_id = "module_row_"+counter;
    $("#"+div_id).remove();
}
function AddUpdateOrgModules()
{

  $("select[name='new_module[]']").each(function() 
  {
    if($(this).val() == "-1") 
    {
        Alert("Please select Module!");
        return false;
    }
  });
  $("select[name='new_subscription_type[]']").each(function() 
  {
    if($(this).val() == "-1") 
    {
        Alert("Please select Subscription Type!");
        return false;
    }
  });
  $("input[name='new_sub_startdate[]']").each(function() 
  {
    if($(this).val() === "") 
    {
        Alert("Start Date can't be blank for any Module!");
        return false;
    }
  });
  $("input[name='new_sub_enddate[]']").each(function() 
  {
    if($(this).val() === "") 
    {
        Alert("End Date can't be blank for any Module!");
        return false;
    }
  });
  
  let myForm = document.getElementById("organization_module_form");
  var formData = new FormData(myForm);
  $.ajax({
    url: "action/add_update_modules.php",
    type: "POST",
    data: formData,
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);
      if (response.error == false) {
        $('#organization_modules_modal').modal('hide');
      }
      else
      {
        
      }
    },
      cache: false,
      contentType: false,
      processData: false,
  });
  return false;
  return false;
}
function EditModuleMapping(MappingID)
{
    var org_module_id = "org_module_id_"+MappingID;
    var org_module_subscription_type = "org_module_subscription_type_"+MappingID;
    var org_module_subscription_start_date = "org_module_subscription_start_date_"+MappingID;
    var org_module_subscription_end_date = "org_module_subscription_end_date_"+MappingID;
    var edit_button_div = "edit_button_div_"+MappingID;
    //$('#'+org_module_id).removeAttr('readonly');
    $('#'+org_module_subscription_type).removeAttr('disabled');
    $('#'+org_module_subscription_start_date).removeAttr('disabled');
    $('#'+org_module_subscription_end_date).removeAttr('disabled');
    var save_html = "<a onclick='SaveModuleMapping("+MappingID+")' class='btn btn-primary mt-4 text-white'><i class='fe fe-check'></i></a>";
    document.getElementById("edit_button_div_"+MappingID).innerHTML = save_html;
}
function SaveModuleMapping(MappingID)
{
    var org_module_id = "org_module_id_"+MappingID;
    var org_module_subscription_type = "org_module_subscription_type_"+MappingID;
    var org_module_subscription_start_date = "org_module_subscription_start_date_"+MappingID;
    var org_module_subscription_end_date = "org_module_subscription_end_date_"+MappingID;
    var edit_button_div = "edit_button_div_"+MappingID;
    var org_module_subscription_type_val = $("#"+org_module_subscription_type).val();
    var org_module_subscription_start_date_val = $("#"+org_module_subscription_start_date).val();
    var org_module_subscription_end_date_val = $("#"+org_module_subscription_end_date).val();
    $.post("action/update_module_mapping.php",
    {
        SubscriptionType:org_module_subscription_type_val,
        SubscriptionStartDate:org_module_subscription_start_date_val,
        SubscriptionEndDate:org_module_subscription_end_date_val,
        MappingID:MappingID
    },
    function (data, status) {
        $('#'+org_module_subscription_type).attr('disabled','true');
        $('#'+org_module_subscription_start_date).attr('disabled','true');
        $('#'+org_module_subscription_end_date).attr('disabled','true');
        var edit_html = "<a onclick='EditModuleMapping("+MappingID+")' class='btn btn-danger mt-4 text-white'><i class='fe fe-edit'></i></a>";
        document.getElementById("edit_button_div_"+MappingID).innerHTML = edit_html;
    }
  );
}

function SetOrgModuleDatabase(MappingID)
{
    $.post("ajax/get_org_modules_mapping_data.php",
    {
        MappingID:MappingID
    },
    function (response_data, status) {
        var data = JSON.parse(response_data);
        $("#db_name_global").val(data.db_name_global);
        $("#db_user_global").val(data.db_user_global);
        $("#db_password_global").val(data.db_password_global);
        $("#db_name_local").val(data.db_name_local);
        $("#db_user_local").val(data.db_user_local);
        $("#db_password_local").val(data.db_password_local);
        $("#set_database_modal_mapping_id").val(MappingID);
        $("#organization_module_database_modal").modal("show");
    });
    
}

function SetModuleDatabase()
{
    let myForm = document.getElementById("module_database_form");
    var formData = new FormData(myForm);
    $.ajax({
        url: "action/update_module_mapping_database.php",
        type: "POST",
        data: formData,
        success: function (data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
            $('#organization_module_database_modal').modal('hide');
          }
          else
          {
            
          }
        },
          cache: false,
          contentType: false,
          processData: false,
    });
}

function SyncUsers()
{
    var mapping_id = $("#set_database_modal_mapping_id").val();
    $.post("action/sync_org_module_users.php",
    {
        MappingID:mapping_id
    },
    function (response_data, status) {
        var data = JSON.parse(response_data);
        Alert(data.message);
    });
}