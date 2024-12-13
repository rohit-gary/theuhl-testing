function SetPassword()
{

    var password = $("#password").val();
    if(password == ''){
        Alert("Please enter password");
        return false;
    }

    var password = $("#confirmpassword").val();
    if(password == ''){
        Alert("Please enter confirm password");
        return false;
    }

	
}
