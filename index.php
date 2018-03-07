<?php
//Ajwinder Singh
//3/2/2018
//index.php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Require the files
require_once('vendor/autoload.php');
//require config file
require_once('/home/asinghgr/config.php');

//start a session
session_start();

//Create an instance of the Base Class
$f3 = Base :: instance();

//Set debug level
//will take care of php errors as well which gives 500 error
$f3->set('DEBUG', 3);
//start the session


$f3->route('GET|POST /', function ($f3)
{
    if (isset($_POST['start']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        require ('model/homeval.php');

        $f3->set('success',$success);
        $f3->set('errors', $errors);

        if ($success)
        {
            echo "hie";
        }
    }
    $template = new Template();
    echo $template->render('views/home.html');
}
);

//Run fat free
$f3->run();