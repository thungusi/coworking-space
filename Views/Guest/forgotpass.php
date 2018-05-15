<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redeem your account</title>
</head>
<style>
	.err{color:red}
</style>
<script>
function validate()
{
//Lấy thông tin từ form về ______________________________________________________________________________________________________________
	var uname =  document.getElementById("uname").value;
	var dob = document.getElementById("dob").value;
	var phone = document.getElementById("phone").value;
	var email = document.getElementById("email").value;
	var regUserName= /^[A-Za-z0-9]+$/;
	var regMail =/^[A-Za-z]+[a-zA-Z0-9._]+@[A-Za-z0-9]+\.?[A-Za-z]*\.[a-zA-Z]{2,3}$/;
//Validate Username_______________________________________________________________________________________________________________________
	if(uname.length<=7 || uname.length>50 || !regUserName.test(uname))
	{
		document.getElementById("erruname").innerHTML=
			"Enter from 8 to 50 characters<br />Username is characters and number (No space or special characters)";
		document.getElementById("uname").focus();
		return false;	
	}
	else 
	{
		document.getElementById("erruname").innerHTML="";
	}
//Validate Password _______________________________________________________________________________________________________________________
	if(dob.length==0)
	{
		document.getElementById("errdob").innerHTML="Fill in your date of birth";
		document.getElementById("dob").focus();
		return false;	
	}
	else 
	{
		document.getElementById("errdob").innerHTML="";
	}
//Validate Phone _______________________________________________________________________________________________________________________
	if(isNaN(phone) || phone.length<10 || phone.length>11)
	{
		document.getElementById("errphone").innerHTML="Invalid phone number";
		document.getElementById("phone").focus();
		return false;	
	}
	else 
	{
		document.getElementById("errphone").innerHTML="";
	}
//Validate Email _______________________________________________________________________________________________________________________
	if(email.length<=10 || email.length>50 || !regMail.test(email))
	{
		document.getElementById("erremail").innerHTML="Invalid email";
		document.getElementById("email").focus();
		return false;	
	}
	else 
	{
		document.getElementById("erremail").innerHTML="";
	}
	return true;
}
</script>
<body>
<div align="center" style="width:500px">
  <form method="post" class="pure-form">
	<fieldset>
		<legend><h2>Fill out these info to get your account back</h2></legend>
		<?php 
			if(isset($_GET['errecover']))
				echo "<h4 style='color:#F00'>*Information is not correct</h4>"
        ?>
		<table width="100%">
        
              <tr>
                <td>*Chúng tôi cần xác nhận thông tin của bạn<br /><br /></td>
              </tr>
      
			<tr>
              <td>
				<label for="uname"><strong>Username:</strong></label><br />
				<input type="text" name="uname" id="uname" class="pure-input-1" autofocus="autofocus"/>	
				<div id="erruname" class="err"></div><br />
              </td>
			</tr>
			<tr>
              <td>
                <label for="dob"><strong>Date of birth:</strong></label>
				<input type="date" name="dob" id="dob" style="width:400px" placeholder="dd/mm/yyyy"/>
				<div id="errdob" class="err"></div><br />
              </td>
			</tr>
			<tr>
              <td>
                <label for="phone"><strong>Phone:</strong></label><br />
				<input type="text" name="phone" id="phone" class="pure-input-1"/>
				<div id="errphone" class="err"> </div><br />
              </td>
				
			</tr>
			<tr>
              <td>
                <label for="email"><strong>Email:</strong></label><br />
                <input type="text" name="email" id="email" class="pure-input-1"/>
                <div id="erremail" class="err"> </div><br />
              </td>
			</tr>
			<tr>
				<td align="center">
					<input type="submit" value="Redeem" name="redeem" id="submit"
                     class="pure-button pure-button-primary" onclick="return validate()"/>
					<input type="reset" value="Clear" id="button" class="pure-button pure-button-active"/>       
				</td>
			</tr>
            <tr>
				<td>
                    <a href="?action=register" style="float:right; font-size:20px" >Register</a>
                    <a href="?action=login" style="float:left; font-size:20px" >Login</a>
                </td>
            </tr>
		</table>
  </fieldset>
</form>
</div>
</body>
</html>