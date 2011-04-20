<?php
//因为Google会根据http请求的头部输出不同的内容
//所以需要向它传递用户浏览器的http请求头部
$opts = array(
	'http'=>array(
		'header'=>""
	)
);

/* 仅在将 PHP 安装为 Apache 模块时，支持此函数。
foreach (getallheaders() as $name => $value) {
    $opts['http']['header'] .= "$name: $value\r\n";
}
*/

//$opts['http']['header'] .= "Cookie:" . $_SERVER['HTTP_COOKIE'] . "\r\n";
//$opts['http']['header'] .= "Connection:" . $_SERVER['HTTP_CONNECTION'] . "\r\n";
//$opts['http']['header'] .= "Cache-Control:" . $_SERVER['HTTP_CACHE_CONTROL'] . "\r\n";
//$opts['http']['header'] .= "Accept:" . $_SERVER['HTTP_ACCEPT'] . "\r\n";
//$opts['http']['header'] .= "Accept-Encoding:" . $_SERVER['HTTP_ACCEPT_ENCODING'] . "\r\n";
$opts['http']['header'] .= "Accept-Language:" . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "\r\n";
$opts['http']['header'] .= "Accept-Charset:" . $_SERVER['HTTP_ACCEPT_CHARSET'] . "\r\n";
$opts['http']['header'] .= "User-Agent:" . $_SERVER['HTTP_USER_AGENT'] . "\r\n";

$context = stream_context_create($opts);
?>
