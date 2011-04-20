<?php
require_once('httpheaders.php');

$content = @file_get_contents($url, false, $context);

//404
if(empty($content)) {
	deal_404();
	exit;
}

echo $content;
?>
