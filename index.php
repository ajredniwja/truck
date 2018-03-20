<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * index.php
 * 3/18/2018
 * <<TRUCK POST>>
 * Containing all functions to interact with the database.
 *************************************************************************
 */


/*
************************************************************************
 * This is the index page which is the main page for all the routes and
 * validation.
*************************************************************************
 */

//turning on the error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Require the files (fat-free)
require_once('vendor/autoload.php');

//require config file
require_once('/home/asinghgr/config.php');

//to connect to the db
require_once ('model/dbconnections.php');

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

//from dbconnections
$dbh = connect();


/**
 ***********************************************************************
                      ******* Initial route *******
 *************************************************************************
 */
$f3->route('GET|POST /', function ($f3)
{

/*
 ***********************************************************************
                          * The login
 ************************************************************************
 */

    //if submit hit
    if (isset($_POST['submit']))
    {
        //get the username
        $username = $_POST['username'];
        //get the pw
        $pw = $_POST['pw'];

        //validate server side
        require ('model/loginval.php');

        //set fatfree variables
        $f3->set('username',$username);
        $f3->set('pw',$pw);

        //set the errors and success var
        $f3->set('success',$success);
        $f3->set('errors', $errors);

        if ($success)
        {
            //make Info object pass the username which is the email
            $user = new Info($username);
            //get the profile from the database
            $profile = getProfile($username);

            $user->setEmail($profile['email']);
            $user->setFname($profile['fname']);
            $user->setLname($profile['lname']);

            $_SESSION['user'] = $user; //assigning it to a session variable

            //redirect
            $f3->reroute('/main');
        }


    }
    /*
     ***********************************************************************
                              * The registration
     ************************************************************************
     */
    else if (isset($_POST['start']))
    {
        //get email and pw
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        //validate
        require ('model/homeval.php');

        //set to fatfree vars
        $f3->set('email',$email);
        $f3->set('password',$password);
        $f3->set('cpassword', $cpassword);

        //set the errors and success var from homeval.php
        $f3->set('success',$success);
        $f3->set('errors', $errors);
        //insertUser(1,ajwinde.com,aloo);
        if ($success)
        {
            //encrypt the pw
            $password = sha1($password);

            //insert to database
            $result = user("",$email,$password);

            //make new object
            $user = new Info($email);
            //put to session variable
            $_SESSION['user'] = $user;

            //if succesfully entered and made user
            if ($result)
            {
                //redirect
                $f3->reroute('/first');
            }
            else
            {
                $f3->reroute('views/errorpage');
            }
        }
    }

    $template = new Template();
    //render
    echo $template->render('views/home.html');
}
);


/*
 ************************************************************************
 ******* first route ******* to complete the profile
 *************************************************************************
 */
$f3->route('GET|POST /first', function ($f3)
{

    //if anyone trying to access the link without registration(security)
    if (!(isset($_SESSION['user'])))
    {
        $f3->reroute('/');
    }

    //get the session data
    $user = $_SESSION['user'];

    //set the fields in the class
    $user->setFname($_POST['fname']);
    $user->setLname($_POST['lname']);
    $user->setPhone($_POST['phone']);
    $user->setState($_POST['state']);

    //set fat free vars
    $f3->set('fname', $user->getFname());
    $f3->set('lname', $user->getLname());
    $f3->set('email', $user->getEmail());

    //if submit hit
    if (isset($_POST['submit']))
    {
        //insert to data base (validation done through js)
        profile("", $user->getFname(), $user->getLname(), $user->getPhone(),$user->getEmail());

        //put to session var
        $_SESSION['user'] = $user;

        //redirect
        $f3->reroute('/main');
    }
    if (isset($_POST['logout']))
    {
        //if logout hit
        session_destroy();
        //redirect
        $f3->reroute('/');
    }

    //render
    $template = new Template();
    echo $template->render('views/first.html');
}
);


/*
 ************************************************************************
 ******* Main route, this shows view post and make a post *******
 *************************************************************************
 */
$f3->route('GET|POST /main', function ($f3)
{

    //if anyone trying to access the link without registration(security)
    if (!(isset($_SESSION['user'])))
    {
        $f3->reroute('/');
    }

    /*
    ***********************************************************************
                             * Make a POST
    ************************************************************************
    */
    //get session data
    $user = $_SESSION['user'];

    //set fields in the class
    $user->setInState($_POST['state']);
    $user->setScaleinfo($_POST['scaleinfo']);
    $user->setInfo($_POST['info']);

    //set fatfree vars
    $f3->set('fname', $user->getFname());
    $f3->set('lname', $user->getLname());

    //put to session variable
    $_SESSION['user'] = $user;

    //the submiting of a post
    if (isset($_POST['submit']))
    {

        //get date and time default zone
        $dateg = date("Y-m-d");
        $timeg = date("h:i:sa");


        //insert the post and user info to the db
        $result = insertPost("",$user->getFname(),$user->getLname(),$user->getEmail(),$user->getScaleinfo(),$user->getInState(),$user->getInfo(),$dateg,$timeg);

        //if post made
        if ($result)
        {
            $f3->reroute('/main');
        }
    }

    /*
***********************************************************************
                         * View Posts
************************************************************************
*/
    else if (isset($_POST['go']))
    {
        $user->setstate($_POST['statein']);
        //set session var
        $_SESSION['user'] = $user;
        //redirect
        $f3->reroute('/viewpost');
    }
    //if log out hit
    if (isset($_POST['logout']))
    {
        session_destroy();
        $f3->reroute('/');
    }

    //render
    $template = new Template();
    echo $template->render('views/main.html');
}
);


/*
 ************************************************************************
 ******* The viewpost route ******* to view a post
 *************************************************************************
 */$f3->route('GET|POST /viewpost', function ($f3)
{
    //if anyone trying to access the link without registration(security)

    if (!(isset($_SESSION['user'])))
    {
        $f3->reroute('/');
    }

    //get session data
    $user = $_SESSION['user'];

    //set fat free vars
    $f3->set('name', $user->getFname());
    $f3->set('state', $user->getState());

    //get the post from the db
    $result = getPost($user->getState());
    $f3->set('posts', $result);

    //if log out hit
    if (isset($_POST['logout']))
    {
        //destroy the session
        session_destroy();
        //re route to the home
        $f3->reroute('/');
    }

    //render
    $template = new Template();
    echo $template->render('views/viewpost.html');
}
);


/*
 ************************************************************************
 ******* Admin route ******* for admin page
 *************************************************************************
 */

$f3->route('GET|POST /admin', function ($f3)
{

    //get the posts
    $post = getPosts();

    //set that array to fat free
    $f3->set('posts', $post);
    //pu in session
    $_SESSION['user'] = $post;

    //if logout hit
    if (isset($_POST['logout']))
    {
        //destrtoy the session
        session_destroy();
        //redirect to home
        $f3->reroute('/');
    }

    //render
    $template = new Template();
    echo $template->render('views/admin.html');
}
);

//Run fat free
$f3->run();