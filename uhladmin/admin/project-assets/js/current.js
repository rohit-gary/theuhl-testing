 $(document).ready(function() {
        var i = 1;
        $('#view_currents').dataTable({
             responsive: true,
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajax/view-all-current-affairs.php'
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
                    data: 'CurrentDate'
                },
                {
                    data: 'PdfName'
                },
                {
                    data: 'Edit'
                },
                {
                    data: 'Delete'
                }


            ]


        });
    });

 document.addEventListener("DOMContentLoaded", function() {
    $('.fc-datepicker').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });

  });


function AddCurrent_Affairs() 
{
  $("#current_date").val("");
  const $dateInputField = $(".fc-datepicker");
  const currentDate = new Date();
  const formattedDate = currentDate.toISOString().split('T')[0];
  $dateInputField.val(formattedDate);
  $("#Update_Current_Affairs_Btn").hide();
  $("#Add_Current_Affairs_Btn").show();
  $("#add_current").modal("show");
  $("#Add_Current_Affairs_Btn").html("Add");
  $("#CurrentHeading").html("Add Current Affairs");
  $("#Current_Affairs_Show").text("");
}

/* update query start*/
$("#view_currents").on("click",".Edit_Current_Affairs",function(){
    $("#Add_Current_Affairs_Btn").hide();
    $("#Update_Current_Affairs_Btn").show();
    $("#add_current").modal("show");
    $("#Update_Current_Affairs_Btn").html("Update");
    $("#CurrentHeading").html("Update Current Affairs");
    var ID = $(this).attr("data-inspect_id");
    var CurrentDate = $(this).attr("alt");
    var PdfName = $(this).attr("alt2");
    $('#current_date').val(CurrentDate);
    $('#Current_Affairs_Show').text(PdfName); 
    $('#current_update_id').val(ID);
  });



function UpdateCurrentAffairs()
{
  var current_pdf = $("#current_pdf").val();
  if(current_pdf == ""){
      Alert("Please upload Current_pdf Affair PDF.");
      return false;
  }
  let myForm = document.getElementById("current_form");
  var formData = new FormData(myForm);

  $("#Update_Current_Affairs_Btn").html("Please Wait..");
  $.ajax({
      url: "action/update_current_pdf.php",
      type: "POST",
      data: formData,
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              setInterval(function() {
                  location.reload();
              }, 1500);
              $("#Update_Current_Affairs_Btn").html("Update");
              $('#current_form')[0].reset();
          }
      },
    cache: false,
    contentType: false,
    processData: false,
  });
    return false;
  
}
/* update query end*/

function isValidEmail(email) {
  // Regular expression to check if the email is valid
  var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
  
  // Test the email against the regular expression
  return emailRegex.test(email);
}

function validISNumber(basic) {
        const input = event.target;
        let value = input.value;

        value = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters

        input.value = value;
}


function AddCurrentAffairs()
{
  if(current_date == ""){
      Alert("Please Enter Current Date.");
      return false;
  }
  var current_pdf = $("#current_pdf").val();

  if(current_pdf == ""){
      Alert("Please upload Current Affair PDF");
      return false;
  }
  
  let myForm = document.getElementById("current_form");
  var formData = new FormData(myForm);

  $("#Add_Current_Affairs_Btn").html("Please Wait..");
  $.ajax({
      url: "action/add-current-pdf.php",
      type: "POST",
      data: formData,
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              setInterval(function() {
                  location.reload();
              }, 1500);
              $("#Add_Current_Affairs_Btn").html("Add");
              $('#current_form')[0].reset();
          }
      },
    cache: false,
    contentType: false,
    processData: false,
  });
    return false;
  
}


function DeleteCurrentPdf(Current_id) {
  alertify.confirm(
    "LAMS ",
    "Do you really want to delete Current Affair?",
    function () {
      $.post(
       "action/delete-current-pdf.php",
        {
          ID: Current_id,
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
 

/* Date Not Selected Next Date*/
 document.addEventListener("DOMContentLoaded", function() {
        var datePicker = document.querySelector(".datePicker");
        var today = new Date().toISOString().split("T")[0];
        datePicker.setAttribute("max", today);
        datePicker.addEventListener("input", function() {
            if (datePicker.value > today) {
                datePicker.value = today;
            }
        });
    });