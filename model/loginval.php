<?php

require_once('/home/asinghgr/config.php');

require_once ('model/dbconnections.php');

$dbh = connect();

$result = getUser($pw);

if (!$result && !filter_var($username, FILTER_VALIDATE_EMAIL))
{
    $errors['notfound'] = "User not found";
}


//if (!filter_var($username, FILTER_VALIDATE_EMAIL))
//{
//    $errors['username'] = "Please enter a valid email";
//}

if (strlen($pw)<8)
{
    $errors['pw'] = "Invalid password!";
}

$success = sizeof($errors) == 0;