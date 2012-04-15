<?php
echo "<pre>";
include_once ( "inc/class/request.php" );
$GLOBALS['request'] = new request($_GET['act']);
var_dump($GLOBALS['request']);
$GLOBALS['request']->ignite();
var_dump($GLOBALS['request']);

//phpinfo();
echo "</pre>";
