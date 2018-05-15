<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<div style="width:400px"> 
  <form method="post" class="pure-form">
	<fieldset>
		<legend><h2>Add role</h2></legend>
		<table align="center" width="100%">
			<tr>
				<td>
                    <label for="code"><strong>Code:</strong></label><br />
                    <input type="text" name="code" id="code" class="pure-input-1"
                    	value="<?php echo rolesDao::instance()->getNewestCode(); ?>" readonly="readonly"/>
                    <div id="errcode"></div><br />
                </td>
			</tr>
			<tr>
				<td>
                    <label for="role"><strong>Role:</strong></label><br />
                    <input type="text" name="role" id="role" class="pure-input-1" autofocus="autofocus"/>
                    <div id="errrole"> </div><br />
                </td>
			</tr>
			<tr>
				<td align="center">
					<input type="submit" value="Save" name="Save" id="submit" class="pure-button pure-button-primary"/>
					<input type="reset" value="Clear" id="button" class="pure-button pure-button-active"/>
				</td>
			</tr>
		</table>	
        <a href="Roles.php" style="float:right; font-size:20px">Back</a>
	</fieldset>
  </form>
</div>
</body>
</html>