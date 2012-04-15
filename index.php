<?php
echo "<pre>";
include_once ( "inc/class/request.php" );
include_once ( "inc/globals/default.php" );
$GLOBALS['request'] = new request($_GET['act']);
$GLOBALS['request']->ignite();

//phpinfo();
echo "</pre>";
