<?php
require_once('config.php');
require_once('httpheaders.php');

$path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
$url = SITE . substr($_SERVER['REQUEST_URI'], strlen($path));
?>
