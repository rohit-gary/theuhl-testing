function AddChannelPartner() 
{
  $('#channelpartner_form')[0].reset();
  $('#user_username').prop('readonly', false);
  $("#modal_password_field").show();
  $("#modal_confirm_password_field").show();
  $("#form_action").val("Add");
  $("#add_channelpartner").modal("show");
  $("#addUpdateBtn").html("Add");
  $("#channelPartnerModalHeading").html("Add Channel Partner");
}

function UpdateChannelPartner(ID) {

  $("#modal_password_field").hide();
  $("#modal_confirm_password_field").hide();
  $.post("ajax/get-channel_partner-details.php",
  {
    ID: ID
  },
  function (data, status) 
  {
      var responseCp = JSON.parse(data);
         var response = responseCp.data[0];
      console.log('responce',response);
      $("#name").val(response.Name);
      $("#registration_number").val(response.RegistrationNumber);
      $("#email").val(response.Email);
      $("#phone_number").val(response.PhoneNumber);
      $("#license_number").val(response.LicenseNumber);
      $("#alternative_contact").val(response.AlternativeContact);
      $("#address").val(response.Address);
      $("#tin").val(response.Tin);
  });
  $("#form_action").val("Update");
  $("#form_id").val(ID);
  $("#add_channelpartner").modal("show");
  $("#addUpdateBtn").html("Update");
  $("#channelPartnerModalHeading").html("Update Channe lPartner");
}

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


function AddUpdateChannelPartner()
{
  var form_action = $("#form_action").val();
  var user_name = $("#name").val();
  if(user_name == ""){
      Alert("Please Enter Name");
      return false;
  }


  var email = $("#email").val();
  if(email == ""){
      Alert("Please Enter User Email.");
      return false;
  }

  if(isValidEmail(email) == false){
      Alert("Please Enter Valid Email.");
      return false;
  }
  var phone_number = $("#phone_number").val();

  if(phone_number == ""){
      Alert("Please Enter User Phone Number.");
      return false;
  }
  if(validaphone(phone_number) == false){
      Alert("Please Enter Valid Phone Number.");
      return false;
  }

  if(form_action != "Update")
  {
    var password = $("#password").val();
    if(password == ""){
        Alert("Please Enter User Password");
        return false;
    }

    var confirm_password = $("#confirm_password").val();
    if(confirm_password == ""){
        Alert("Please Enter Confirm Password");
        return false;
    }

    if(password !== confirm_password)
    {
        Alert("Password and Confirm Password doesn't match");
        return false;
    }
  }

  var registration_number = $("#registration_number").val();
  if(registration_number == ""){
      Alert("Please Enter Registration Number");
      return false;
  }
  
  $("#addUpdateBtn").html("Please Wait..");
  $.ajax({
      url: "action/add-update-channel_partner.php",
      type: "POST",
      data: $("#channelpartner_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              setInterval(function() {
                  location.reload();
              }, 1500);
              $("#addUpdateBtn").html("Submit");
              $('#channelpartner_form')[0].reset();
          }
          else
          {
            $("#addUpdateBtn").html("Add");
          }
      },
  });
  return false;
  
}


function DeleteChannelPartner(id) {
  alertify.confirm(
    "DWD",
    "Do you really want to delete User?",
    function () {
      $.post(
        "action/delete-channel-partner.php",
        {
          ID:id,
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

function ResetPassword(userEmail)
{
  $("#rp_user_email").val(userEmail);
  $("#reset_password_modal").modal("show");
}
function ResetPasswordAction()
{
  var password = $("#r_password").val();
  if(password == ""){
      ProductAlert("Please Enter User Password");
      return false;
  }

  var confirm_password = $("#r_confirm_password").val();
  if(confirm_password == ""){
      ProductAlert("Please Enter Confirm Password");
      return false;
  }
  if(password !== confirm_password)
  {
      ProductAlert("Password and Confirm Password doesn't match");
      return false;
  }
  $("#resetpasswordBtn").html("Please Wait..");
  $.ajax({
      url: "action/reset_password.php",
      type: "POST",
      data: $("#reset_password_form").serialize(),
      success: function(data) {
          var response = JSON.parse(data);
          Alert(response.message);
          if (response.error == false) {
              $("#resetpasswordBtn").html("Submit");
              $('#reset_password_form')[0].reset();
              $("#reset_password_modal").modal("hide");
          }
          else
          {
            $("#resetpasswordBtn").html("Add");
          }
      },
  });
  return false;
}