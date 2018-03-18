<?php

$petname = $_POST['petname'];

//connect to databse
require_once('/home/asinghgr/config.php');

//echo "hie";

if ($petname != "Ajwinder")
{
    echo "<p id ='h'>1</p>";
}