
function isValidEmail(email) {
  // Regular expression to check if the email is valid
  var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
  
  // Test the email against the regular expression
  return emailRegex.test(email);
}

function login()
{
    var email = $("#email").val();
    /*if (!isValidEmail(email)) {
      Alert("Please enter valid email address");
      return false;
    } */

    var password = $("#password").val();
    if(password == ''){
        Alert("Please enter password");
        return false;
    }

	var data = $("#form-login").serialize();
	$.ajax({
            type: "POST",
            url: "action/login-action",
            data: data,
            success: function(data) {
                 var response = JSON.parse(data);
                 if(response.error == false)
                 {
                    if(response.UserType == "System Admin")
                    {
                        window.location.href = "../dashboard/admin-dashboard";
                        exit();
                    }
                    if(response.multi_modules == 0)
                    {
                        
                        if(response.UserType == "Client Admin")
                        {
                            redirect_link = response.redirect_link+"/dashboard/main-dashboard.php";
                            window.location.href = redirect_link;
                        }
                        if(response.UserType == "Client User")
                        {
                            redirect_link = response.redirect_link+"/dashboard/main-dashboard.php";
                            window.location.href = redirect_link;
                        }

                        if(response.UserType == "Channel Partner")
                        {
                            redirect_link = response.redirect_link+"/dashboard/main-dashboard.php";
                            window.location.href = redirect_link;
                        }

                        if(response.UserType == "Policy Customer")
                            {
                                redirect_link = response.redirect_link+"/dashboard/policy-customer-main-dashboard.php";
                                window.location.href = redirect_link;
                            }
                    }
                    else
                    {
                        redirect_link = "../../dwd-organization/dashboard/app-dashboard.php";
                        window.location.href = redirect_link;
                    }
                 }
                 else
                 {
                    Alert(response.message);
                 }
                
            }
        });
    return false;
}
