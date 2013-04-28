<?php
require $_SERVER['DOCUMENT_ROOT'].'/includes/classes/Mysql.php';

$mysql = new Mysql();

$blogs = $mysql->get_blogs("", "");
$now = date("D, d M Y H:i:s T");

$output = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
 <rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">
 <channel>
 	<title>Trevor's Blog</title>
	<link>http://www.trevor-mack.com</link>
	<description>Random blog articles from Trevor Mack</description>
	<language>en-us</language>
	<pubDate>".$now."</pubDate>
	<lastBuildDate>".$now."</lastBuildDate>
	<atom:link href=\"http://trevor-mack.com/feed\" rel=\"self\" type=\"application/rss+xml\" />";
	
	foreach($blogs as $blog) {
		$year = date("Y", $blog['date_posted']);
		$month = date("m", $blog['date_posted']);
		$day = date("d", $blog['date_posted']);
		
		$output .= "<item>
				<title>".htmlentities($blog['title'])."</title>
				<guid>http://trevor-mack.com/blog/".$year."/".$month."/".$day."</guid>
				<link>http://trevor-mack.com/blog/".$year."/".$month."/".$day."</link>
				<pubDate>".date('D, d M Y H:i:s T', $blog['date_posted'])."</pubDate> 
				<description>".htmlentities('<img height="120px"; align="left" hspace="20"; src="'.$blog['picture'].'" />'.$blog['articleText'])."</description>
			  </item>";
	}
	$output .= "</channel></rss>";

header("Content-Type: application/rss+xml");
echo $output;
?>
