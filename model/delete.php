<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * delete.php
 * 3/18/2018
 * <<TRUCK POST>>
 *************************************************************************
 */


/*
************************************************************************
 * This is a file which recieves the data from the ajax call made on
 * admin page to delete a particular post.
*************************************************************************
 */

//get the element
$element = $_POST['element'];

//require files
require_once('/home/asinghgr/config.php');

require_once('dbconnections.php');

//connect to the db
$dbh = connect();

//use the delete post function
$result = deletePost($element);

//if deleted send message
if ($result)
{
    echo "The post was succesfully deleted.";
}
//else send this message
else
{
    echo "There was problem deleting the post.";
}
