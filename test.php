<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/simplehtmldom/simple_html_dom.php';
$achievement_url = "http://www.360-hq.com/Halo_3_Xbox_360_Achievements-117.html";
/**
 * Set the user_agent just in case 360-hq checks.
 */
ini_set('user_agent', 'Scrape/2.5');
$html = file_get_html($achievement_url);
/*foreach($html->find('a[class=hqgreen11] font[size=3]') as $k => $v) {
	echo "key: " . $k;
	echo " value: " . $v;
	echo "<br>";
}

foreach($html->find('a[class=hqgrey11] font[class=hqgrey11]') as $k => $v) {
	if($k > 0) {
		echo "key: " . $k;
		echo " value: " . $v;
		echo "<br>";
	}	
}*/

foreach($html->find('a[class=hqgrey11] img[id=image]') as $k => $v) {
	echo "key: " . $k;
	echo " value (img): <img src='http://www.360-hq.com/" . $v->src . "'/>";
	echo " value (alt): " . $v->alt;
	echo "<br>";
}

?>