<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Contact Me</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="verify-v1" content="m1dvd/6NJK7tFxA6ga9Tky1gsh2FmKVMFmFo3ITgT3Y=" />
	<meta content="Trevor Mack" name="Author"/>
	<script src="../includes/js/formval.js" type="text/javascript"></script>
	
	<link href="../includes/css/styles.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	#nav ul .contact a {margin-top:0px;border-top:3px solid #fff;color:#fff;}
	#sidemenu ul .contact a {color:#FFFFFF;}
	</style>
</head>

<body>

	<div id="wrapper">

		<div id="side_trevor_mack"></div>

	    <div id="main_holder">
		<div id="nav">
		<?php
		echo file_get_contents('./includes/html/top_navigation.html', true);
		?>
		</div>
		    <div id="banner"></div>

			<div id="content_holder">
				<div id="content_full">
					<table width="100%">
					  <tr>
					    <td width="20%">&nbsp;</td>
					    <td width="60%">
						  <script type="text/javascript">
							// Only script specific to this form goes here.
							// General-purpose routines are in a separate file.
							 function validateOnSubmit(theForm) {
								var reason = "";

								reason += validateName(theForm.from);
								reason += validateEmail(theForm.email);
								reason += validateMessage(theForm.mess);
								reason += validateCode(theForm.code);
								 
								if (reason != "") {
								  alert("Some fields need correction:\n" + reason);
								  return false;
								}

								return true;
							 };
						  </script>
							<form action="completedForm.html" onsubmit="return validateOnSubmit(this)" name="demo">
							<!--<table class="formtab" frame="border" cellpadding="5px" summary="Demonstration Form">-->
							<table width="100%" id="formtab">
							  <thead>
							  <tr>
							    <td colspan="2">Contact Me</td>
							  </tr>
							  </thead>
							  <tbody>
							  <tr>
								<td width="40%">
								  <label for="from">Name: <font color="red">*</font></label>
								 </td>
								<td width="60%">
								  <input id="from" type="text" maxlength="50" size="35"/>
								</td>
							  </tr>
							  <tr>
								<td width="40%">
								  <label for="email">Email (optional):</label>
								</td>
								<td width="60%">
								  <input id="email" type="text" onchange="validateEmail(this, 'inf_email', true);" maxlength="50" size="35" name="email"/>
								</td>
							  </tr>
							  <tr>
								<td width="40%">
								  <label for="from">Age (optional):</label>
								</td>
								<td width="60%">
								  <input id="age" type="text" onchange="validateAge(this, 'inf_age', false);" maxlength="5" size="35" name="age"/>
								</td>
							  </tr>
							  <tr>
								<td width="40%">
								  <label for="mess">Message: <font color="red">*</font></label>
								</td>
								<td width="60%">
								  <textarea id="mess" onchange="validateMess(this, 'inf_mess', true);" rows="5" cols="35" name="mess" />
								</td>
							  </tr>
							  <tr>
								<td width="40%">
								  <label for="code">Verification Code: <font color="red">*</font></label>
								</td>
								<td width="60%">
								  <input id="code" type="text" onchange="validateCode(this, 'inf_code', true);" maxlength="5" size="15" name="code"/>
								  <img src='../images/code.png' alt='Word embedded in an image for Human Interactive Proof' />
								</td>
							  </tr>
							  <tr>
								<td>&nbsp;</td>
								<td><font color="gray">(enter the characters you see in the above picture)</font></td>
							  </tr>
							  <tr>
								<td>&nbsp;</td>
								<td>
								  <input type="submit" value="Send" name="Submit"/>
								</td>
							  </tr>
							  </tbody>
							</table>
							<input type="hidden" name="recipient" value="drummer8001@gmail.com" />
							</form>
						</td>
						<td width="20%">&nbsp;</td>
					  </tr>
					</table>
				</div> <!-- end #content -->
			</div> <!--end #content_holder -->

		    <div id="footer">
			<?php
			echo file_get_contents('./includes/html/footer.html', true);
			?>
			</div>
		</div> <!-- end #main_holder -->

	</div> <!-- end #wrapper -->

	<!--GoogleAnalytics-->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/google-analytics.php'); ?>
	
</body>
</html>
