<?php
require_once('httpheaders.php');
require_once('simple_html_dom.php');

$html = @file_get_html($url, false, $context);

//404
if(empty($html)) {
	deal_404();
	exit;
}

//还原搜索结果的链接为真正的目的网址
foreach($html->find('a') as $e) {
	if($e->class === "l") {
		$e->target = '_blank';
		
		//!IE
		$e->onmousedown = '';

		//IE
		if(!empty($e->href) && 0 === strcasecmp(substr($e->href, 0, 7), '/url?q=')) {
			$e->href = substr($e->href, 7, strpos($e->href, '&amp;')-7);
		}
	}
}

echo $html;
?>
