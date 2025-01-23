function login() {
  var email = $("#f_email").val();
  if (email == '') {
    alert("Please enter valid email address");
    return false;
  }

  var password = $("#f_password").val();
  if (password == '') {
    alert("Please enter password");
    return false;
  }

  var data = $("#f_form-login").serialize();
  $.ajax({
    method: "POST",
    url: "uhladmin/admin/authentication/action/login-action.php",
    data: data,
    success: function (data) {
      var response = JSON.parse(data);
      if (response.error == false) {
        window.location.href = "./index";
      } else {
        alert(response.message);
      }
    }
  });
  return false;
}