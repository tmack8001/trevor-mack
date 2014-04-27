<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Photos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verify-v1" content="m1dvd/6NJK7tFxA6ga9Tky1gsh2FmKVMFmFo3ITgT3Y=" />
<meta content="Trevor Mack" name="Author"/>

<script language="javascript" src="/includes/js/lib.js"></script>
<script language="javascript" src="/includes/js/photo-configuration.js"></script>
<script language="javascript" src="/includes/js/photos.js"></script>

<script src="/includes/js/highslide.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">    
// remove the registerOverlay call to disable the close button
hs.registerOverlay({
	overlayId: 'closebutton',
	position: 'top right',
	fade: 2 // fading the semi-transparent overlay looks bad in IE
});

hs.showCredits = false;
hs.graphicsDir = 'images/ui/highslide/';
</script>

<link href="/includes/css/styles.css" rel="stylesheet" type="text/css" />
<link href="/includes/css/photos.css" rel="stylesheet" type="text/css" />
<link href="/includes/css/highslide.css" rel="stylesheet" type="text/css" />

<style type="text/css">
#nav ul .photos a {margin-top:0px;border-top:3px solid #FFFFFF;color:#FFFFFF;}
#sidemenu ul .photos a {color:#FFFFFF;}
</style>

</head>

<body>
	<script src="/includes/js/hashlistener.js" language="javascript" type="text/javascript"></script>
	<script type="text/javascript">
		<!--
		hashListener.onHashChanged = function () {
			display();
		};
		//-->
		scroll(0,0);
	</script>
	<div id="wrapper">

		<div id="side_trevor_mack"></div>

	    <div id="main_holder">
		<div id="nav">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/top-navigation.php'); ?>
		</div> <!-- end #nav -->
		    <div id="banner"></div>

			<div id="content_holder">
				<div id="content_full">
					<h1><span id="albumDescription"></span></h1>
					<br/>
					
					<div id="gallery" style="display:inline">
					</div> <!-- end #gallery -->
				</div> <!-- end #content -->
			</div> <!--end #content_holder -->

		    <div id="footer">
			<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/footer.php'); ?>
			</div> <!-- end #footer-->
		</div> <!-- end #main_holder -->

	</div> <!-- end #wrapper -->

	<!--GoogleAnalytics-->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/google-analytics.php'); ?>
	
	<script type="text/javascript" language="JavaScript">
		loadPictures();
    </script>
	
</body>
</html>
