<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * loginval.php
 * 3/18/2018
 * <<TRUCK POST>>
 *************************************************************************
 */


/*
************************************************************************
 * This is used to validate data on the home page for log in
*************************************************************************
 */
//require files
require_once('/home/asinghgr/config.php');

require_once ('model/dbconnections.php');

//connect to the db
$dbh = connect();

//get user with pw
$result = getUser(sha1($pw));

$result = $result['password'];


//if the user not founf
if (!$result && !filter_var($username, FILTER_VALIDATE_EMAIL))
{
    $errors['notfound'] = "User not found";
}

//if password less than 7 or the password not returnd from db
if (strlen($pw)<7 || sha1($pw) != $result)
{
    $errors['pw'] = "Invalid password!";
}

//size of array
$success = sizeof($errors) == 0;