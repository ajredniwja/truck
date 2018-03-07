<?php

//error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base :: instance();

$f3->route('GET /', function ()
{
    $template = new Template();
    echo $template->render('views/home.html');
}
);

//Run fat free
$f3->run();