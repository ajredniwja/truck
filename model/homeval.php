<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * homeval.php
 * 3/18/2018
 * <<TRUCK POST>>
 *************************************************************************
 */


/*
************************************************************************
 * This is used to validate data on the home page and the registration.
*************************************************************************
 */
//require files
require_once('/home/asinghgr/config.php');

require_once ('model/dbconnections.php');

//connect to the db
$dbh = connect();

//get the profile by email
$result = getProfile($email);

$result = $result['email'];

//if the user is trying to re register with same email
if ($result == $email)
{
    $errors['email'] = "Email already been used!";
}

//check if email valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = "Please enter a valid email";
}

//check passowrd is atleast 7 characters
if (strlen($password)<7)
{
    $errors['password'] = "Invalid password, password must be atleast 7 characters";
}

//check if the confirm password matches
if ($password !== $cpassword)
{
    $errors['cpassword'] = "Password do not match";
}
//size of array
$success = sizeof($errors) == 0;