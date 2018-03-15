<?php

require_once('/home/asinghgr/config.php');

require_once ('model/dbconnections.php');

$dbh = connect();

$result = getUser(sha1($pw));

$result = $result['password'];

if (!$result && !filter_var($username, FILTER_VALIDATE_EMAIL))
{
    $errors['notfound'] = "User not found";
}

if (strlen($pw)<8 || sha1($pw) != $result)
{
    $errors['pw'] = "Invalid password!";
}

$success = sizeof($errors) == 0;