<?php
require_once('simple_html_dom.php');

$google = "http://www.google.co.jp/";
$url = $google . "search?" . $_SERVER["QUERY_STRING"];
$html = file_get_html($url);

foreach($html->find('a') as $e)
{
	if (!empty($e->href) && 0 <> strcasecmp(substr($e->href, 0, 7), 'http://'))
		$e->href = $google . $e->href;
	$e->onmousedown = '';
}

foreach($html->find('img') as $e)
{
	if(!empty($e->src) && 0 <> strcasecmp(substr($e->src, 0, 7), 'http://'))
		$e->src = $google . $e->src;
}

foreach($html->find('script') as $e)
{
	if(!empty($e->src) && 0 <> strcasecmp(substr($e->src, 0, 7), 'http://'))
		$e->src = $google . $e->src;
}

foreach($html->find('form') as $e)
{
	if($e->action == '/search') {
		$e->action = basename(__FILE__);
	} else if(!empty($e->action) && 0 <> strcasecmp(substr($e->action, 0, 7), 'http://')) {
		$e->action = $google . $e->action;
	}
}

echo $html;
?>
