<?php

$update = $_POST['update'];
$change = $_POST['changed'];


$update = str_replace('b','',$update);


require_once('/home/asinghgr/config.php');

require_once ('model/dbconnections.php');

$dbh = connect();

$success = updatePost($change,$update);

if ($success)
{
    echo "The change was made.";

}
else
{
    echo "There was problem making a change.";
}

//echo "The post was deleted succesfully!";