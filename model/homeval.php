<?php

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = "Please enter a valid email";
}

$success = sizeof($errors) == 0;