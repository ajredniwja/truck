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


/*************************************************************************
 *************************************************************************
 * Initial route, gives user the option to login or register  ************
 *************************************************************************
 *************************************************************************
 */
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
            $profile = getProfile($username);
            $user->setEmail($profile['email']);
            $user->setFname($profile['fname']);
            $user->setLname($profile['lname']);

            $_SESSION['user'] = $user; //assigning it to a session variable
            $f3->reroute('/main');
        }


    }
    /************************************************************************
     * The registration
     ************************************************************************
     */
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
            //inserting to database
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


/*************************************************************************
 *************************************************************************
 * The first route, which is for user registration and completing the profile
 *************************************************************************
 *************************************************************************
 */
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
        profile("", $user->getFname(), $user->getLname(), $user->getPhone(),$user->getEmail());
        $_SESSION['user'] = $user;
        $f3->reroute('/main');
    }

    $template = new Template();
    echo $template->render('views/first.html');
}
);


/*************************************************************************
 *************************************************************************
 * The main route, which takes user to make or view a post****************
 *************************************************************************
 *************************************************************************
 */
$f3->route('GET|POST /main', function ($f3)
{
    $user = $_SESSION['user'];

    $user->setInState($_POST['state']);
    $user->setScaleinfo($_POST['scaleinfo']);
    $user->setInfo($_POST['info']);
    $f3->set('fname', $user->getFname());
    $f3->set('lname', $user->getLname());
    //$f3->set('user', $user);
    //insertPost("","i","i","sd","dsds","dk","kjdsjkljsd");



    if (isset($_POST['submit']))
    {
        //$user = $_SESSION['user'];

        $result = insertPost("",$user->getFname(),$user->getLname(),$user->getEmail(),$user->getScaleinfo(),$user->getInState(),$user->getInfo());
        if ($result)
        {
            $f3->reroute('google.com');
        }
    }

    $template = new Template();
    echo $template->render('views/main.html');
}
);


//testing
$f3->route('GET|POST /viewpost', function ($f3)
{
    $result = getPost("Colorado");

    $f3->set('posts', $result);

    print_r($result);
    echo "hie";

    $template = new Template();
    echo $template->render('views/hhh.html');
}
);


//Run fat free
$f3->run();