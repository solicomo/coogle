<?php
if(empty($_SERVER["QUERY_STRING"]))
{
	header("Location:http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']));
	exit;
}

require_once('route.php');
require_once('simple_html_dom.php');
require_once('httpheaders.php');

$html = file_get_html($url, false, $context);

foreach($html->find('a') as $e)
{
	$e->onmousedown = '';

	if(empty($e->href))
		continue;

	//还原搜索结果的链接为真正的目的网址
	if(0 == strcasecmp(substr($e->href, 0, 7), '/url?q=')) {
		//IE
		$e->href = substr($e->href, 7, strpos($e->href, '&amp;')-7);
	} else if(0 <> strcasecmp(substr($e->href, 0, 7), 'http://')) {
		//!IE
		$e->href = $google . $e->href;
	}
}

echo $html;
?>
