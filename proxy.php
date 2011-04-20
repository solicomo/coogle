<?php
require_once('route.php');
$content = @file_get_contents($url, false, $context);
if(!empty($content)) {
	echo $content;
} else if (file_exists(PAGE404)) {
	@readfile($file);
} else {
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");
	exit;	
}
?>
