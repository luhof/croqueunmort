<?php

define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('SERVER', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('IMAGES', SERVER.'/webroot/images/');


require CORE.DS.'includes.php';

new Dispatcher();


?>

