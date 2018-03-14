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

require_once ('model/dbconnections.php');

require_once ('classes/userinfo.php');

//start a session
session_start();

//Create an instance of the Base Class
$f3 = Base :: instance();

//Set debug level
//will take care of php errors as well which gives 500 error
$f3->set('DEBUG', 3);
//start the session

$dbh = connect();

$f3->route('GET|POST /', function ($f3)
{
    if (isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $pw = $_POST['pw'];


        require ('model/loginval.php');

        $f3->set('username',$username);
        $f3->set('pw',$pw);

        $f3->set('success',$success);
        $f3->set('errors', $errors);

        if ($success)
        {
            $f3->reroute('/first');
        }


    }
    else if (isset($_POST['start']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        require ('model/homeval.php');

        $f3->set('email',$email);
        $f3->set('password',$password);
        $f3->set('cpassword', $cpassword);
        $f3->set('success',$success);
        $f3->set('errors', $errors);
        //insertUser(1,ajwinde.com,aloo);



        if ($success)
        {
            $password = sha1($password);
            //$result = insertStudent(891121,"ajwn","aqer",0000-00-00,1,1);
            $result = user("",$email,$password);

            if ($result)
            {
                $f3->reroute('/first');
            }
            else
            {
                $f3->reroute('views/errorpage');
            }
        }
    }
    $template = new Template();
    echo $template->render('views/home.html');
}
);

$f3->route('GET|POST /first', function ($f3)
{

    $template = new Template();
    echo $template->render('views/first.html');
}
);

//Run fat free
$f3->run();