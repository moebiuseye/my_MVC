<?php
/*
 * These are the minimum lines for everything to work. Don't touch this. 
*/
include_once ( "inc/class/request.php" );
include_once ( "inc/globals/default.php" );
$GLOBALS['request'] = new request($_GET['act']);
$GLOBALS['request']->ignite();
