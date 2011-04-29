<?php
define('SITE', 'http://www.google.com/');
define('PAGE404', '404.shtml');

function deal_404() {
	if (file_exists(PAGE404)) {
		@readfile($file);
	} else {
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
	}
}
?>
