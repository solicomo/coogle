<?php
require_once('simple_html_dom.php');

$google = "http://www.google.co.jp/";
$url = $google . "search?" . $_SERVER["QUERY_STRING"];
$html = file_get_html($url);

foreach($html->find('a') as $a)
{
	if (0 <> strcasecmp(substr($a->href, 0, 7), 'http://'))
		$a->href = $google . $a->href;
	$a->onmousedown = '';
}

foreach($html->find('img') as $img)
{
	if(0 <> strcasecmp(substr($img->src, 0, 7), 'http://'))
		$img->src = $google . $img->src;
}

foreach($html->find('script') as $script)
{
	if(0 <> strcasecmp(substr($script->src, 0, 7), 'http://'))
		$script->src = $google . $script->src;
}

foreach($html->find('form') as $form)
{
	if($form->action == '/search') {
		$form->action = basename(__FILE__);
	} else if(0 <> strcasecmp(substr($form->action, 0, 7), 'http://')) {
		$form->action = $google . $form->action;
	}
}

echo $html;
?>
