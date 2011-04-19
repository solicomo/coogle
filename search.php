<?php
require_once('simple_html_dom.php');
$url = "http://www.google.com/search?" . $_SERVER["QUERY_STRING"];
$html = file_get_html($url);

foreach($html->find('a') as $a)
	$a->onmousedown = '';
echo $html;
?>
