<?php
require_once "config.php";

$parts = parse_url($_SERVER['HTTP_REFERER']);
parse_str($parts['query'], $params);

?><!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="refresh" content="0;URL=<?=addParamsToUrl($aff_link, $params)?>" />
	</head>
</html>
