<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Projects</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verify-v1" content="m1dvd/6NJK7tFxA6ga9Tky1gsh2FmKVMFmFo3ITgT3Y=" />
<meta content="Trevor Mack" name="Author"/>

<link href="../includes/css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#nav ul .projects a {margin-top:0px;border-top:3px solid #fff;color:#fff;}
#sidemenu ul .projects a {color:#FFFFFF;}
</style>
</head>

<body>

	<div id="wrapper">

		<div id="side_trevor_mack"></div>

	    <div id="main_holder">
		<div id="nav">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/top-navigation.php'); ?>
		</div>
		    <div id="banner"></div>

			<div id="content_holder">
				<div id="content_full">
				<!--  Google AdSense Ads  -->
					<center>
					<br/>
						<script type="text/javascript"><!--
							google_ad_client = "pub-0764005723613461";
							/* 468x60, created 11/12/08 */
							google_ad_slot = "0318208824";
							google_ad_width = 468;
							google_ad_height = 60;
							//-->
						</script>
						<script type="text/javascript"
							src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
					</center>
					<table width='100%'>
					  <tr>
						<td valign=middle colspan=2>
						  <h1>Projects</h1>
						  <hr/><br/>
						</td>
					  </tr>
					  <tr>
						<td valign='top' width='75%'>
							<h5>Photo Album</h5>
							<h6><i>Highslide Implementation</i></h6>
							<p>I stumbled upon Highslide JS over the summer of 2008 when I was looking at adding a photo album page to my personal website. This open source JavaScript software offers a Web 2.0 approach to popup windows. It streamlines the use of thumbnail images and HTML popups on web pages. Therefore proves to be a great solution to a photo album implementation. Other features that make this a optimal approach to photo pages includes the fact that there is no need for plugins like Flash or Java, Popup blockers are no problem since the popups exist inside of the webpage, and the builtin compatibility and safe fallback features that if a user has disabled JavaScript or is using an unsupported browser, the browser will redirect to the image itself or to a fallback HTML page.</p>
							<p>In addition to the Highslide Implementation I have also created an automation program to add pictures to this photo page. Behind the scenes this program will create a XML file that has the album information and links to the physical location of the pictures to be included. You would need to only run this program when the file system where the photo albums are located. The program will automatically scan through the filesystem recognizing every folder under the main gallery folder as a new album and then will search for the photo files under that directory. The program was written solely in JAVA using the DOM representation of an XML file. This program has been generated into a JAR file and a configuration file for easy integration for other websites. Included in the zip file you will find all the files that you will need in order to integrate this to your website.</p>
							<center><p><b>Downloadable ZIP file coming soon.</b></p></center>
						<table width='100%'>
						  <tr>
							<td width='12%' align='center'><img src='../images/somerights.png' alt='Some Rights Reserved' /></td>
							<td valign='bottom'>Notice that HighSlide JS is licensed under a Creative Commons Attribution-NonCommercial 2.5 Lincense. This means that you need the author's permission to use Highslide JS on commercial websites.</td>
						  </tr>
						</table>
						</td>
					  </tr>
					</table>
				</div> <!-- end #content -->
			</div> <!--end #content_holder -->

		    <div id="footer">
			<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/footer.php'); ?>
			</div>
		</div> <!-- end #main_holder -->

	</div> <!-- end #wrapper -->

	<!--GoogleAnalytics-->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/google-analytics.php'); ?>
	
</body>
</html>