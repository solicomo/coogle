<?php
require_once('simple_html_dom.php');

$google = "http://www.google.co.jp/";
$url = $google . "search?" . $_SERVER["QUERY_STRING"];

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

$html = file_get_html($url, false, $context);

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
