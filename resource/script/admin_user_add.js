function check_user_add_email()
{
	var email = $("#user_add_email").val();
    				
   	if (email == null || email == "" || email == text_email) 
    {
		$('#user_add_email').removeClass("available");
		$('#user_add_email').removeClass("not_available");
        return false;
    }
    				
   	
   	var at_position = email.indexOf("@");
    var dot_position = email.lastIndexOf(".");
    if (at_position < 2 || dot_position < at_position+2 || dot_position+2 >= email.length)
    {
		$('#user_add_email').removeClass("available");
        $("#user_add_email").addClass("not_available");
        return false;
    }
	
	$.get("core_user.php?check=user&email="+email,function(response) 
	{
  		if (response == "true")
		{
			$('#user_add_email').removeClass("available");
			$('#user_add_email').addClass("not_available");
		}
		else
		{
			$('#user_add_email').removeClass("not_available");
			$('#user_add_email').addClass("available");
		}
	});
}

function check_user_add()
{
	var email_correct = false;
	var password_correct = false;
					
    var email = $("#user_add_email").val();
	var password = $("#user_add_password").val();
    				
    				
    if (email == null || email == "" || email == text_email) 
   	{
    	email_correct = false;
        $("#user_add_email").addClass("necessary");
    }
    else
    {
    	email_correct = true;
        $("#user_add_email").removeClass("necessary");
    }
    				
    var at_position = email.indexOf("@");
    var dot_position = email.lastIndexOf(".");
    if (at_position < 2 || dot_position < at_position+2 || dot_position+2 >= email.length)
    {
        email_correct = false;
        $("#user_add_email").addClass("necessary");
    }
    else
    {
    	email_correct = true;
        $("#user_add_email").removeClass("necessary");
    }
    
    				
    if (password == null || password == "" || password == text_password) 
   	{
        password_correct = false;
        $("#user_add_password").addClass("necessary");
    }
    else
    {
    	password_correct = true;
        $("#user_add_password").removeClass("necessary");
    }
    
    
    if (email_correct == true)
    {
		if ($('#user_add_email').hasClass("not_available"))
		{
			email_correct = false;
		}
	}
	
	
    if (email_correct == true && password_correct == true)
    {				
    	return true;
    }
    else
    {
    	return false;
    }
}