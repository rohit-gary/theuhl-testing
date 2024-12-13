function SearchFillterServiceReport() {
  var table = $('#view-service-reports').DataTable();
  table.destroy();
  var param = "";
  var filter_start_date = document.getElementById("filter_start_date").value;
  var filter_end_date = document.getElementById("filter_end_date").value;
  param = "?filter_start_date=" + filter_start_date + "&filter_end_date=" + filter_end_date;


  var fillter_company_id = document.getElementById("fillter_company_id");
  if (fillter_company_id !== null) {
    var fillter_company_id = document.getElementById("fillter_company_id").value;
    param = param + "&fillter_company_id=" + fillter_company_id;
  }

  var fillter_company_site_id = document.getElementById("fillter_company_site_id");
  if (fillter_company_site_id !== null) {
    var fillter_company_site_id = document.getElementById("fillter_company_site_id").value;
    param = param + "&fillter_company_site_id=" + fillter_company_site_id;
  }


  var fillter_service_value = document.getElementById("fillter_service_value");
  if (fillter_service_value !== null) {
    var fillter_service_value = document.getElementById("fillter_service_value").value;
    param = param + "&fillter_service_value=" + fillter_service_value;
  }


  $('#view-service-reports').dataTable({
    responsive: true,
    'processing': true,
    'serverSide': true,
    'ordering': false,
    'serverMethod': 'post',
    'ajax': {
      'url': 'ajax/view-service-reports-post.php' + param
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
      data: 'SiteNameCompanyName'
    },
    {
      data: 'ServiceName'
    },
    {
      data: 'Status'
    },
    {
      data: 'CreatedAt'
    },
    {
      data: 'Technician'
    },
    {
      data: 'PDFGenearte'
    },
    {
      data: 'Action'
    }
    ]
  });
  GetServiceReportStats();
}

function GetServiceReportStats() {
  $.ajax({
    url: "ajax/get-general-service-report-stats.php",
    type: "POST",
    data: $("#service_report_fillter").serialize(),
    success: function (data) {
      document.getElementById("total_service_report").innerHTML = data;
    },
  });
}


function AddServiceReport() {
  $('#service_report_modal_form')[0].reset();
  $("#service_report_form_action").val("Add");
  // services select2

  $("#ser_company").select2({
    placeholder: "Select Company"
  });
  $("#ser_company").select2("val", "");
  $("#ser_company").select2({
    dropdownParent: $("#service_report_modal")
  });

  $("#ser_services").select2({
    placeholder: "Select Service"
  });
  $("#ser_services").select2("val", "");
  $("#ser_services").select2({
    dropdownParent: $("#service_report_modal")
  });

  // Date picker 


  $("#addUpdateServiceBtn").html("Add");
  $("#ServiceModalHeading").html("Add Service Report");
  $("#service_report_modal").modal("show");
}

function GetFilletrCompanySiteDropdown(CompanyID) {
  $.post("ajax/get-company-site-dropdown-html.php",
    {
      CompanyID: CompanyID
    },
    function (data, status) {
      document.getElementById("fillter_company_site_id").innerHTML = data;
      // $("#fillter_company_site_id").select2({
      //   placeholder: "Select Company Site"
      // });
      // $("#fillter_company_site_id").select2("val", "");
      // $("#fillter_company_site_id").select2({
      //   dropdownParent: $("#service_report_modal")
      // });
    });
}

function GetCompanySiteDropdown(CompanyID) {
  $.post("ajax/get-company-site-dropdown-html.php",
    {
      CompanyID: CompanyID
    },
    function (data, status) {
      document.getElementById("ser_company_sites").innerHTML = data;
      document.getElementById("ser_company_sites").disabled = false;
      document.getElementById("ser_services").disabled = false;
      $("#ser_company_sites").select2({
        placeholder: "Select Company Sites"
      });
      $("#ser_company_sites").select2("val", "");
      $("#ser_company_sites").select2({
        dropdownParent: $("#service_report_modal")
      });
    });
}

function GenerateServiceReportForms(ServiceID) {
  var ajax_form_url = "";
  if (ServiceID == 1) {
    ajax_form_url = "get-general-service-report.php";
  }
  else {
    ajax_form_url = "get-general-service-report.php";
  }
  ajax_form_url = "ajax/" + ajax_form_url;
  $.post(ajax_form_url,
    {
      ServiceID: ServiceID
    },
    function (data, status) {
      document.getElementById("service_report_form_div").innerHTML = data;
      $('#ser_attended_date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
      });

      $('#ser_completed_date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
      });

      $('#ser_registered_date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
      });
      // $("#ser_jll_mes_technician").select2({
      //   placeholder: "Select Technician"
      // });
      // $("#ser_jll_mes_technician").select2("val", "");
      // $("#ser_jll_mes_technician").select2({
      //   dropdownParent: $("#service_report_modal")
      // });


    });
}

function DeleteSignature(counter) {
  var div_id = "signature_row_" + counter;
  $("#" + div_id).remove();
}

function AddServiceImage() {
  var new_service_counter = $("#new_service_counter").val();
  next_counter = parseInt(new_service_counter) + 1;
  $.post("ajax/service-image-html.php",
    {
      counter: new_service_counter
    },
    function (data, status) {
      $("#service_image_box").append(data);


    }
  );
  $("#new_service_counter").val(next_counter);
}

function DeleteServiceImage(counter) {
  var div_id = "service_image_row_" + counter;
  $("#" + div_id).remove();
}

function AddUpdateServiceReport() {

  var ser_reported_by = $("#ser_reported_by").val();
  if (ser_reported_by == "") {
    Alert("Please Enter Reported By");
    return false;
  }

  var ser_jll_helpdesk_no = $("#ser_jll_helpdesk_no").val();
  if (ser_jll_helpdesk_no == "") {
    Alert("Please Enter JLL Helpdesk Complaint No.");
    return false;
  }

  var ser_registered_date = $("#ser_registered_date").val();
  if (ser_registered_date == "") {
    Alert("Please Select Registered Date");
    return false;
  }

  var ser_attended_date = $("#ser_attended_date").val();
  if (ser_attended_date == "") {
    Alert("Please Select Attended Date");
    return false;
  }

  var ser_completed_date = $("#ser_completed_date").val();
  if (ser_completed_date == "") {
    Alert("Please Select Completed Date");
    return false;
  }

  var NatureOfCallradios = document.getElementsByName('NatureOfCall');
  var isChecked = false;
  for (var i = 0; i < NatureOfCallradios.length; i++) {
    if (NatureOfCallradios[i].checked) {
      isChecked = true;
      break;
    }
  }
  if (!isChecked) {
    Alert("Please Select  Nature Of Call!");
    return false;
  }


  var ser_problem_reported = $("#ser_problem_reported").val();
  if (ser_problem_reported == "") {
    Alert("Please Enter Problem Reported By Client");
    return false;
  }

  var ser_jll_observation = $("#ser_jll_observation").val();
  if (ser_jll_observation == "") {
    Alert("Please Enter Observation");
    return false;
  }

  var ser_action_taken = $("#ser_action_taken").val();
  if (ser_action_taken == "") {
    Alert("Please Enter Action Taken");
    return false;
  }
  var ser_jll_mes_technician = $("#ser_jll_mes_technician").val();
  if (ser_jll_mes_technician == "") {
    Alert("Please Enter JLL MES Technician (Job Done By)");
    return false;
  }


  let service_report_modal_form = document.getElementById("service_report_modal_form");
  var formData = new FormData(service_report_modal_form);

  $("#addUpdateServiceBtn").html("Please Wait..");
  $.ajax({
    url: "action/add-service-report.php",
    type: "POST",
    data: formData,
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);
      if (response.error == false) {

        $("#addUpdateServiceBtn").html("Add");
        $("#service_report_form_id").val(response.report_id);
      }
      else {
        $("#addUpdateServiceBtn").html("Add");
      }
    },
    cache: false,
    contentType: false,
    processData: false,
  });
  return false;
}

function AddUpdateClientDetails() {

  var ser_onsite_client = $("#ser_onsite_client").val();
  if (ser_onsite_client == "") {
    Alert("Please Enter Client Representative Name");
    return false;
  }

  var ser_onsite_client_contact = $("#ser_onsite_client_contact").val();
  if (ser_onsite_client_contact == "") {
    Alert("Please Enter Client Representative Contact No.");
    return false;
  }

  // var ser_onsite_client_email = $("#ser_onsite_client_email").val();
  // if(ser_onsite_client_email == ""){
  //     Alert("Please Enter Client Representative Email");
  //     return false;
  // }


  // var ser_onsite_client_designation = $("#ser_onsite_client_designation").val();
  // if(ser_onsite_client_designation == ""){
  //     Alert("Please Enter Client Representative Designation");
  //     return false;
  // }

  let service_report_modal_form = document.getElementById("service_report_modal_form");
  var formData2 = new FormData(service_report_modal_form);

  $("#addUpdateCompleteBtn").html("Please Wait..");
  $.ajax({
    url: "action/add-client-details.php",
    type: "POST",
    data: formData2,
    success: function (data) {
      var response = JSON.parse(data);
      Alert(response.message);
      if (response.error == false) {
        setInterval(function () {
          location.reload();
        }, 1500);
        $("#addUpdateCompleteBtn").html("Complete");
      }
      else {
        $("#addUpdateCompleteBtn").html("Complete");
      }
    },
    cache: false,
    contentType: false,
    processData: false,
  });
  return false;
}

function checkRadioButtons(response) {
  var radioButtons = document.getElementsByName("NatureOfCall");

  for (var i = 0; i < radioButtons.length; i++) {
    if (response.includes(radioButtons[i].value)) {
      radioButtons[i].checked = true;
    }
  }
}

function UpdateGeneralServiceReport(ReportID) {
  $('#service_report_modal_form')[0].reset();
  $.post("ajax/get-service-report-details.php",
    {
      ReportID: ReportID
    },
    function (data, status) {
      var response = JSON.parse(data);
      // console.log(response);
      $("#ser_company").select2({
        placeholder: "Select Company"
      });
      $("#ser_company").select2("val", response.CompanyID);
      $("#ser_company").select2({
        dropdownParent: $("#service_report_modal")
      });
      $("#ser_company_sites").select2({
        placeholder: "Select Company Sites"
      });
      $("#ser_company_sites").select2("val", response.CompanySiteID);
      $("#ser_company_sites").select2({
        dropdownParent: $("#service_report_modal")
      });

      $("#ser_services").select2({
        placeholder: "Select Service"
      });
      $("#ser_services").select2("val", response.ServiceID);
      $("#ser_services").select2({
        dropdownParent: $("#service_report_modal")
      });

      $('#Channel_Partner').val(response.ChannelPartner);
      setTimeout(function () {
        if (response.ServiceID != "-1") {
          $("#ser_reported_by").val(response.ReportCreatedByName);
          $('#ser_jll_helpdesk_no').val(response.HelpdeskComplaintNumber);
          $("#ser_registered_date").val(response.RegisteredDate);
          $('#ser_attended_date').val(response.AttendedDate);
          $("#ser_completed_date").val(response.CompletedDate);
          $('#ser_problem_reported').val(response.ProblemReportedByClient);
          $("#ser_jll_observation").val(response.JLLObservation);
          $('#ser_action_taken').val(response.ActionTaken);
          $("#ser_remarks").val(response.Remarks);
          $('#ser_jll_mes_technician').val(response.TechnicianName);
          $("#ser_onsite_client").val(response.ClientRepresentative);
          $('#ser_onsite_client_contact').val(response.ClientRepresentativeContact);
          $("#ser_onsite_client_email").val(response.ClientRepresentativeEmails);
          $('#ser_onsite_client_designation').val(response.ClientRepresentativeDesignation);
          checkRadioButtons(response.NatureOfCall);
          $('#signature_img_div').css('display', 'block');
          $('#client_signature_img').attr('src', `./media/signature/${response.ClientSignature}`);

          $("#addUpdateServiceBtn").html("Update");
          $("#addUpdateCompleteBtn").html("Update");
          $("#service_report_form_id").val(ReportID);

          let Image_arr = response.report_images;
          const img_container = document.getElementById('service-image-container');
          img_container.innerHTML = ''; 
          img_container.style.display = "flex";
          Image_arr.forEach((imageSrc, index) => {
            let image_ID_arr = response.report_images_id; 
            const imgElement = document.createElement('img');
            imgElement.src = `./media/service_image/${imageSrc}`;
            imgElement.alt = `Service Image ${image_ID_arr[index]}`;
            
            
            const wrapper = document.createElement('div');
            wrapper.className = 'image-wrapper';
            wrapper.id = `Service_Image_${image_ID_arr[index]}`;

            const deleteButton = document.createElement('button');
            deleteButton.className = 'delete-button';
            deleteButton.innerHTML = '&times;'; 
            deleteButton.onclick = () => DeleteServiceImage(image_ID_arr[index]); 

            wrapper.appendChild(imgElement);
            wrapper.appendChild(deleteButton);
            img_container.appendChild(wrapper);
          });
        }
      }, 500);

    });

  $("#service_report_form_action").val("Update");
  $("#service_report_modal").modal("show");
  $("#ServiceModalHeading").html("Update Service Report");

}

function DeleteServiceImage(ServiceImageID) {
    alertify.confirm(
      "RPM Enterprises",
      "Do you really want to delete Service Image?",
      function () {
        $.post(
          "action/delete-service-image.php",
          {
            ID: ServiceImageID,
          },
          function (data, status) {
            var response = JSON.parse(data);
            Alert(response.message);
            if (response.error == false) {
              document.getElementById(`Service_Image_${ServiceImageID}`).style.display = 'none';
              // setInterval(function () {
              //   location.reload();
              // }, 2000);
            }
          }
        );
      },
      function () {
        alertify.error("Deletion Cancelled");
      }
    );
  }