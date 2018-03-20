<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * dupdate.php
 * 3/18/2018
 * <<TRUCK POST>>
 *************************************************************************
 */


/*
************************************************************************
 * This is a file which receives the data from the ajax call made on
 * admin page to update a particular post.
*************************************************************************
 */


//get the the updated data and the id
$update = $_POST['update'];
$change = $_POST['changed'];

//clear 'b from id
$update = str_replace('b','',$update);

//require files
require_once('/home/asinghgr/config.php');

require_once('dbconnections.php');

//connect to the db
$dbh = connect();

//use update funtcion to update
$success = updatePost($change,$update);


//if done
if ($success)
{
    echo "The change was made.";

}
//if not done
else
{
    echo "There was problem making a change.";
}
