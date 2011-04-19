<?php
require_once('simple_html_dom.php');

$google = "http://www.google.com.hk/";
$url = $google . "search?" . $_SERVER["QUERY_STRING"];
$html = file_get_html($url);

foreach($html->find('a') as $a)
{
	if (0 <> stripos($a->href, 'http://'))
		$a->href = $google . $a->href;
	$a->onmousedown = '';
}

foreach($html->find('img') as $img)
{
	if(0 <> stripos($img->src, 'http://'))
		$img->src = $google . $img->src;
}

foreach($html->find('form') as $form)
{
	if($form->action == '/search') {
		$form->action = basename(__FILE__);
	} else if(0 <> stripos($form->action, 'http://')) {
		$form->action = $google . $form->action;
	}
}

echo $html;
?>
