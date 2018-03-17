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

require_once ('classes/user.php');
require_once ('classes/profile.php');
require_once ('classes/info.php');


//start a session
session_start();

//Create an instance of the Base Class
$f3 = Base :: instance();

//Set debug level
//will take care of php errors as well which gives 500 error
$f3->set('DEBUG', 3);

//array of states
$f3->set('states',array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','District of Columbia','Florida',
    'Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota',
    'Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota',
    'Ohio','Oklahoma','Oregon','Pennsylvania', 'Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont',
    'Virginia','Washington','West Virginia','Wisconsin','Wyoming'));

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
            $user = new Info($username);
            $_SESSION['user'] = $user; //assigning it to a session variable
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

            $user = new Info($email);
            $_SESSION['user'] = $user;

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

    $user = $_SESSION['user'];
    $user->setFname($_POST['fname']);
    $user->setLname($_POST['lname']);
    $user->setPhone($_POST['phone']);
    $user->setState($_POST['state']);

    $f3->set('fname', $user->getFname());
    $f3->set('lname', $user->getLname());
    $f3->set('email', $user->getEmail());


    if (isset($_POST['submit']))
    {
        $_SESSION['user'] = $user;
        $f3->reroute('/main');
    }

    $template = new Template();
    echo $template->render('views/first.html');
}
);

$f3->route('GET|POST /main', function ($f3)
{
    $user = $_SESSION['user'];

    $user->setInState($_POST['state']);
    $user->setScaleinfo($_POST['scaleinfo']);
    $user->setInfo($_POST['info']);
    $f3->set('fname', $user->getFname());
    $f3->set('lname', $user->getLname());

    if (isset($_POST['submit']))
    {
//        $result = insertInfo("", "$user->getFname","$user->getLname", "$user->getEmail",
//            "$user->getScaleinfo","$user->getInState","$user->getInfo");
//
//        if ($result)
//        {
//
//        }
        print_r($user);
    }

    $template = new Template();
    echo $template->render('views/main.html');
}
);

//Run fat free
$f3->run();