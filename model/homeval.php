<?php

require_once('/home/asinghgr/config.php');

require_once ('model/dbconnections.php');

$dbh = connect();

$result = getProfile($email);

$result = $result['email'];

if ($result == $email)
{
    $errors['email'] = "Email already been used!";
}



if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = "Please enter a valid email";
}

if (strlen($password)<8)
{
    $errors['password'] = "Invalid password, password must be atleast 7 characters";
}

if ($password !== $cpassword)
{
    $errors['cpassword'] = "Password do not match";
}
$success = sizeof($errors) == 0;