function AddCompany() 
{
  $('#company_form')[0].reset();
  $("#form_action").val("Add");
  $("#add_company_modal").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#UserModalHeading").html("Add Company");
}
function AddUpdateCompany()
{
  var form_action = $("#form_action").val();
  var company_name = $("#company_name").val();
  if(company_name == ""){
      Alert("Please Enter Company Name");
      return false;
  }

  var poc_email = $("#poc_email").val();
  if(poc_email != "")
  {
     if(isValidEmail(poc_email) == false)
     {
      Alert("Please Enter Valid Email.");
      return false;
      }
  }

  var poc_phone_number = $("#poc_phone_number").val();
  if(poc_phone_number != "")
  {
     if(validatephone(poc_phone_number) == false){
      Alert("Please Enter Valid Phone Number.");
      return false;
    }
  }
  
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-update-company.php",
      type: "POST",
      data: $("#company_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              $('#view-companies').DataTable().ajax.reload();
              $("#add_company_modal").modal("hide");
              $("#addUpdateBtn").html("Add");
              $('#company_form')[0].reset();
          }
          else
          {
            $("#addUpdateBtn").html("Add");
          }
      },
  });
  return false;
}
function UpdateCompany(CompanyID)
{
  $.post("ajax/get-company-details.php",
  {
    CompanyID: CompanyID
  },
  function (data, status) 
  {
      var response = JSON.parse(data);
      $("#company_name").val(response.CompanyName);
      $("#ta_company_address").val(response.CompanyAddress);
      $("#poc_name").val(response.POCName);
      $('#poc_email').val(response.POCEmail);
      $("#poc_phone_number").val(response.POCContact);
  });
  $("#form_action").val("Update");
  $("#form_id").val(CompanyID);
  $("#add_company_modal").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#UserModalHeading").html("Update Company");
}

function DeleteCompany(CompanyID)
{
  $.post("action/delete-company.php",
  {
    CompanyID: CompanyID
  },
  function (data, status) 
  {
      var response = JSON.parse(data);
      Alert(response.message);
      if(response.error == false)
      {
        $('#view-companies').DataTable().ajax.reload();
      }
  });
}

function AddCompanySite()
{
  
  $('#company_site_form')[0].reset();
  $("#form_action").val("Add");
  $("#add_company_site_modal").modal("show");
  $("#s_company").select2({
    placeholder: "Select Company"
    });
  $("#s_company").select2("val","");
  $("#s_company").select2({
    dropdownParent: $("#add_company_site_modal")
  });

  $("#s_zoneid").select2({
    placeholder: "Select Company"
    });
  $("#s_zoneid").select2("val","");
  $("#s_zoneid").select2({
    dropdownParent: $("#add_company_site_modal")
  });
    // select2-search__field
   
  $("#addUpdateBtn").html("Add");
  $("#UserModalHeading").html("Add Company Site");
}

function AddUpdateCompanySite()
{
  var form_action = $("#form_action").val();
  var s_company = $("#s_company").val();
  if(s_company == ""){
      Alert("Please Select Company");
      return false;
  }

  var s_zoneid = $("#s_zoneid").val();
  if(s_zoneid == ""){
      Alert("Please Select Zone");
      return false;
  }

  var company_site_name = $("#company_site_name").val();
  if(company_site_name == ""){
      Alert("Please Enter Company Site Name");
      return false;
  }

  var site_poc_email = $("#site_poc_email").val();
  if(site_poc_email != "")
  {
     if(isValidEmail(site_poc_email) == false)
     {
      Alert("Please Enter Valid Email.");
      return false;
      }
  }

  var site_poc_contact = $("#site_poc_contact").val();
  if(site_poc_contact != "")
  {
     if(validatephone(site_poc_contact) == false){
      Alert("Please Enter Valid Phone Number.");
      return false;
    }
  }
  
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-update-company-site.php",
      type: "POST",
      data: $("#company_site_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              $('#view-company-sites').DataTable().ajax.reload();
              $("#add_company_site_modal").modal("hide");
              $("#addUpdateBtn").html("Add");
              $('#company_site_form')[0].reset();
          }
          else
          {
            $("#addUpdateBtn").html("Add");
          }
      },
  });
  return false;
}

function UpdateCompanySite(CompanySiteID)
{
  $.post("ajax/get-company-site-details.php",
  {
    CompanySiteID: CompanySiteID
  },
  function (data, status) 
  {
      var response = JSON.parse(data);
      $("#s_company").select2("val",response.CompanyID);
      $("#company_site_name").val(response.SiteName);
      $("#ta_company_site_address").val(response.SiteAddress);
      $("#site_poc_name").val(response.SitePOCName);
      $('#site_poc_email').val(response.SitePOCEmail);
      $("#site_poc_contact").val(response.SitePOCContact);
  });
  $("#form_action").val("Update");
  $("#form_id").val(CompanySiteID);
  $("#add_company_site_modal").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#UserModalHeading").html("Update Company Site");
}
function DeleteCompanySite(CompanySiteID)
{
  $.post("action/delete-company-site.php",
  {
    CompanySiteID: CompanySiteID
  },
  function (data, status) 
  {
      var response = JSON.parse(data);
      Alert(response.message);
      if(response.error == false)
      {
        $('#view-company-sites').DataTable().ajax.reload();
      }
  });
}
function ViewSites(CompanyID)
{
  $.post("../controllers/setSession.php", 
      {
        CompanyID: CompanyID,
      },
      function(data, status) 
      {
          BasicURLRouter("../company/view-company-sites");
      });
}