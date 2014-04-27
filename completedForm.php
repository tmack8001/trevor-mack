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
					<table width='100%'>
					  <tr><td width='22%'>&nbsp;</td>
					    <td width='55%'>
						  <h1>Form Submitted OK</h1>
						  <p>I don't have a server-side script for this demo form, so the contents have been discarded.</p>
						</td>
						<td width='22%'>&nbsp;</td>
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
