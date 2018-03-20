<?php

$element = $_POST['element'];

require_once('/home/asinghgr/config.php');

require_once ('model/dbconnections.php');

$dbh = connect();

$result = deletePost($element);

if ($result)
{
    echo "The post was succesfully deleted.";
}
else
{
    echo "There was problem deleting the post.";
}
