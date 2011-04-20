<?php
require_once('config.php');

$path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
$req_url = substr($_SERVER['REQUEST_URI'], strlen($path));
$url = SITE . $req_url;

if(0 === stripos($req_url, 'search?')) {
	require_once('search.php');
} else {
	require_once('proxy.php');
}
?>
