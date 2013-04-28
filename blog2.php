<?php
require $_SERVER['DOCUMENT_ROOT'].'/includes/classes/Mysql.php';

$mysql = new Mysql();
$article = isset($_GET['article']) ? $_GET['article'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

/* DEBUG CODE */
//echo "article: $article<br>";
//echo "date: $date<br>";
/* DEBUG CODE */

$blogs = $mysql->get_blogs($article, $date);

if( isset($_POST['action']) && $_POST['action'] === "comment" ) {
	$errorMessage = "";
	
	$name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
	$email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
	$commentText = isset($_POST['comment']) ? $_POST['comment'] : '';
	$articleID = isset($_POST['article']) ? $_POST['article'] : '';
	
	if(empty($name) || empty($email) || empty($commentText) || empty($articleID) || is_int($articleID) ) {
		echo('<p class="error">You did not fill in a required field.</p>');
	}else {		
		$response = $mysql->add_Comment($name, $email, $commentText, $articleID);
	}
	
	echo '<b>'.$response.'</b>';
	
	if( $response <= 0 ) {
		/* *** ERROR OCCURED: User already exists *** */
		$errorMessage = "Username already exists. If you have already registered " .
			"please check your inbox. If you haven't registered before please choose a new username.";
		//header('Location: http://'.$_SERVER['SERVER_NAME'].'/includes/php/register.php');			
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 
	$title = "";
	if(count($blogs) == 1) {
		$title .= $blogs[0]['title'] . " - ";
	}
	$title .= "Trevor's Blog";
	echo "<title>" . $title . "</title>";
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="verify-v1" content="m1dvd/6NJK7tFxA6ga9Tky1gsh2FmKVMFmFo3ITgT3Y=" />
	<meta content="Trevor Mack" name="Author"/>
	
	<meta name="keywords" content="cool gadgets, electronic toys, electronics, future, gadget, gadget blog, gadgets, 
	latest technology, new gadgets, new technology, tech gadgets, tech news, technology, technology blog, technology news" />
	
	<link href="/includes/css/styles.css" rel="stylesheet" type="text/css" />
	<link href="/includes/css/blog.css" rel="stylesheet" type="text/css" />
	
	<link rel="alternate" type="application/rss+xml" title="Trevor's Blog RSS Feed" href="/feed" />
	
	<style type="text/css">
	#nav ul .blog a {margin-top:0px;border-top:3px solid #FFFFFF;color:#FFFFFF;}
	#sidemenu ul .blog a {color:#FFFFFF;}
	</style>
	
	<script type="text/javascript" src="/lib/jquery-1.3.2.js"></script>
	<script type=text/javascript>
		$(function() {
			$('h4.alert').hide().fadeIn(700);
			$('<span class="exit">X</span>').appendTo('h4.alert');
			
			$('span.exit').click(function() {
				$(this).parent('h4.alert').fadeOut('slow');
			});
		})
	</script>
	
</head>
<body>
	<div id="wrapper">
		<div id="side_trevor_mack"></div>
	    <div id="main_holder">
	    
	    <!-- google_ad_section_start(weight=ignore) -->
		<div id="nav">
			<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/top-navigation.php'); ?>
		</div> <!-- end #nav -->
		<!-- google_ad_section_end -->
		
		    <div id="banner"></div>

			<div id="content_holder">
				<div id="content_full">
					<!--  Google AdSense Ads  -->
					<div style="text-align: center;">
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
					</div>
					
					<!-- google_ad_section_start -->
					<div id="blogs">
					<?php
					foreach($blogs as $blog) {
						$year = date("Y", $blog['date_posted']);
						$month = date("m", $blog['date_posted']);
						$day = date("d", $blog['date_posted']);
						if(count($blogs) > 1) {
							$blog['articleText'] = substr($blog['articleText'], 0, strpos($blog['articleText'], "</p>")+4);
						}
						?>
						<div id="blog<?php echo date('Ymd', $blog['date_posted']); ?>" class='blog'>
							<h2 class="blog-title"><a href="<?php echo 'http://trevor-mack.com/blog/'.$year.'/'.$month.'/'.$day ?>"><?php echo $blog['title']; ?></a></h2>
							<div class="blog-header">
								<span class="blog-stats">
									Author: <a class="author" href="http://trevor-mack.com/about"><?php echo $blog['name']; ?></a> 
									posted <span class="blog-date"><?php echo date('F jS, Y', $blog['date_posted']); ?></span>
								</span><!--end blog-stats-->
							</div><!--end blog-header-->
							<div class="blog-body">
								<div id="summary<?php echo $blog['date_posted']; ?>">
									<?php  if(count($blogs) > 1) { ?>
									<span style="padding: 0px 10px 5px 0px; float: left;">
										<img width="200px" src="<?php echo $blog['picture']; ?>"/>
									</span>
									<?php } else { ?>
									<span style="padding: 0px 10px 5px 10px; float: right;">
										<img width="200px" src="<?php echo $blog['picture']; ?>"/>
									</span>
									<?php } ?>
									<div><?php echo $blog['articleText']; ?></div>
								</div><!--end blog-summary-->
								<?php if(count($blogs) > 1) { ?>
								<div class="blog-readmore">
									<a href="<?php echo 'http://trevor-mack.com/blog/'.$year.'/'.$month.'/'.$day ?>">READ MORE</a>
								</div><!--end blog-readmore-->
								<?php } ?>
								<div class="clear"></div>
							</div><!--end blog-body-->
							<div class="blog-footer">                              
								<div class="blog-comment-icon">
									<div class="blog-num-comments">
										<a href="<?php echo 'http://trevor-mack.com/blog/'.$year.'/'.$month.'/'.$day ?>#comments"><?php echo count($blog['comments']); ?></a>
									</div>
								</div><!--end blog-comment-icon-->
								<div class="blog-comment-tail">
									<img src="/images/ui/comment_tail.gif" />
								</div>
								<div class="blog-comment sprite">
									<a href="<?php echo 'http://trevor-mack.com/blog/'.$year.'/'.$month.'/'.$day ?>#comments"><span>Discuss</span></a>
								</div><!--end blog-comment-->
								<div class="blog-readhere sprite">
									<a href="<?php echo 'http://trevor-mack.com/blog/'.$year.'/'.$month.'/'.$day ?>"><span>Permalink</span></a>
								</div><!--end blog-readhere-->
								<?php if(count($blogs) == 1) { ?>
								<div class="blog-share sprite">
									<!-- ADDTHIS BUTTON BEGIN -->
									<script type="text/javascript">
									var addthis_config = {
									     username: "trevormack"
									}
									</script>
									
									<a href="http://www.addthis.com/bookmark.php?v=250" 
									    class="addthis_button"><img 
									    src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" 
									    width="125" height="16" border="0" alt="Share" /></a>
									
									<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
									<!-- ADDTHIS BUTTON END -->
								</div><!--end blog-share-->
								<?php } ?>  
							 </div><!--end blog-footer-->
							 <div class="clear"></div>
							 <?php if(count($blogs) == 1) { ?>
							 	<div id="blog-comments">
							 		<?php if(count($blog["comments"]) > 0) { ?>
							 		<h3>Discussion</h3>
							 		<ol id="commentList">
							 		<?php
							 		$oddRow = false; //toggle at begining of foreach loop (thus row# = 0) 
							 		foreach($blog["comments"] as $comment) {
										$commentID = $comment['commentID'];
							 			$name = $comment['name'];
										$email = $comment['email'];
										$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5(strtolower($email))."&size=70";
										$commentText = $comment['commentText'];
										$date = $comment['date_posted'];
										$oddRow = !$oddRow;
							 			?>
										<li class="comment <?php if($oddRow){ echo "odd";} else{ echo "even";}?> depth-1" id="comment-<?php echo $comment['commentID']; ?>">
											<div class="comment-body">
												<div class="comment-author">
													<img alt="<?php echo $comment['name']; ?>'s Gravatar" src="<?php echo $grav_url; ?>" class="gravatar" />
													<cite class="fn"><?php echo $name; ?></cite>
												</div>
												<div class="comment-metadata">
													<a href="<?php echo $_SERVER['PHP_SELF'] . '#comment-' . $comment['commentID']; ?>" ><?php echo date('F j, Y \a\t g:i a', $comment['date_posted']); ?></a>
												</div>
												<div class="comment-content"><!-- Comments could potentially contain HTML code --><?php echo $commentText; ?></div>
												<div class="reply" style="display: none;"></div>
											</div>
										</li>
									<?php } ?>
							 		</ol>
							 		<?php } ?>
								 	<div id="blog-comments-form">
								 		<h3>Add a Comment</h3>
										<form action="<?php echo 'http://trevor-mack.com/blog2/'.$year.'/'.$month.'/'.$day ?>" method="post">
											<div class="fname">
												<label for="name">Name</label>
												<input name="name" type="text" size="22" tabindex="1" />
											</div>
											<div class="femail">
												<label for="email">Email</label>
												<input name="email" type="text" size="22" tabindex="2" />
											</div>
											<div class="fcomment">
												<label for="comment">Your Comments</label>
												<textarea name="comment" rows="15" cols="40" tabindex="3"></textarea>
											</div>
											<div class="fsubmit">
												<input name="article" type="hidden" value="<?php echo $blog["articleID"]; ?>" />
												<input name="action" type="hidden" value="comment" />
												<input id="add-comment" type="submit" value="Add Comment" />
											</div>
										</form>
									</div>
						 		</div><!--end blog-comments-->
							 <?php } ?>
						</div><!--end blog-->
					<?php } ?>
					</div> <!-- end blogs -->
					<!-- google_ad_section_end -->
					<!--  Google AdSense Ads  -->
					<div style="text-align: center;">
					<br/>
						<script type="text/javascript"><!--
						google_ad_client = "ca-pub-0764005723613461";
						/* 728x90 */
						google_ad_slot = "8441085378";
						google_ad_width = 728;
						google_ad_height = 90;
						//-->
						</script>
						<script type="text/javascript"
						src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
					<br/>
					</div>
				</div> <!-- end content -->
			</div> <!--end content_holder -->
			
			<!-- google_ad_section_start(weight=ignore) -->
		    <div id="footer">
				<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/layout/footer.php'); ?>
			</div>
			<!-- google_ad_section_end -->
			
		</div> <!-- end #main_holder -->

	</div> <!-- end #wrapper -->

	<!--GoogleAnalytics-->
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-5228215-1");
	pageTracker._trackPageview();
	</script>
	
</body>
</html>