function loginPlanHolder()
{
    var plan_number = $("#plan_number").val();
    
     if(plan_number == ''){
        Alert("Please enter Plan Number");
        return false;
    }

    var password = $("#password").val();
    if(password == ''){
        Alert("Please enter password");
        return false;
    }

    var data = $("#form-planlogin").serialize();
    $.ajax({
            type: "POST",
            url: "action/loginplan-action",
            data: data,
            success: function(data) {
                 var response = JSON.parse(data);
                 if(response.error == false)
                 {
                   
                    if(response.multi_modules == 0)
                    {

                                redirect_link = response.redirect_link+"/dashboard/policy-customer-main-dashboard.php";
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
