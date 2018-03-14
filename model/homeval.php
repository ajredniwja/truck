<?php

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