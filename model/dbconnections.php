<?php


//////////////////////////////////////
/// login table///////////////////////
/// /////////////////////////////////

//CREATE TABLE `asinghgr_grc`.`login`
//(`id` INT(200) NOT NULL AUTO_INCREMENT ,
//`email` VARCHAR(30) NOT NULL ,
//`password` VARCHAR(20) NOT NULL ,
//PRIMARY KEY (`id`))
//ENGINE = MyISAM



//////////////////////////////////////
/// profile table/////////////////////
/// /////////////////////////////////


//CREATE TABLE `asinghgr_grc`.`profile`
// ( `id` INT(200) NOT NULL AUTO_INCREMENT ,
// `fname` VARCHAR(50) NOT NULL ,
// `lname` VARCHAR(50) NOT NULL ,
// `phone` VARCHAR(50) NOT NULL ,
// `email` VARCHAR(50) NOT NULL,
// PRIMARY KEY (`id`)) ENGINE = MyISAM;



/*************************************************************************
 *************************************************************************
CREATE TABLE `asinghgr_grc`.`posts`
 * ( `id` INT(50) NOT NULL AUTO_INCREMENT ,
 * `fname` VARCHAR(50) NOT NULL ,
 * `lname` VARCHAR(50) NOT NULL ,
 * `email` VARCHAR(50) NOT NULL ,
 * `scaleinfo` VARCHAR(20) NOT NULL ,
 * `state` VARCHAR(50) NOT NULL ,
 * `info` TEXT NOT NULL ,
 * `q` INT(50) NOT NULL ,
 * PRIMARY KEY (`id`))
 * ENGINE = MyISAM;
 *************************************************************************
 *************************************************************************
 */

function connect()
{
    try
    {
        //Instantiate a database object
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
//        if ($dbh)
//        {
//            echo "hie";
//        }
        return $dbh;
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
        return;
    }
}

function user($id, $email, $password)
{
    global $dbh;

    //1. Define the query
    $sql = "INSERT INTO user VALUES (:id, :email, :password);";

    //2. Prepare the statement
    $statement = $dbh->prepare($sql);

    //3. Bind parameters
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    //4. Execute the query
    $result = $statement->execute();


    //5. Return the result
    return $result;
}

function getUser($pw)
{
    global $dbh;

    //select from database
    $sql = "SELECT * FROM user WHERE password = :password";

    //prepare statement
    $statement = $dbh->prepare($sql);

    //$sid = 'sid';

    //bind params
    $statement->bindParam(':password', $pw, PDO::PARAM_INT);

    //execute
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function profile($id,$fname,$lname,$phone,$email)
{
    global $dbh;

    //1. Define the query
    $sql = "INSERT INTO profile VALUES (:id, :fname, :lname, :phone,:email);";

    //2. Prepare the statement
    $statement = $dbh->prepare($sql);

    //3. Bind parameters
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
    $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);



    //4. Execute the query
    $result = $statement->execute();


    //5. Return the result
    return $result;
}


function insertPost($id,$fname,$lname,$email,$scaleinfo,$state,$info)
{
    global $dbh;

    //1. Define the query
    $sql = "INSERT INTO posts VALUES (:id, :fname, :lname, :email, :scaleinfo, :state, :info);";

    //2. Prepare the statement
    $statement = $dbh->prepare($sql);

    //3. Bind parameters
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':scaleinfo', $scaleinfo, PDO::PARAM_STR);
    $statement->bindParam(':state', $state, PDO::PARAM_STR);
    $statement->bindParam(':info', $info, PDO::PARAM_STR);

    //4. Execute the query
    $result = $statement->execute();


    //5. Return the result
    return $result;
}

//function to get the post
function getPost($state)
{
    global $dbh;

//select from database
    $sql = "SELECT * FROM posts WHERE state = :state";

//prepare statement
    $statement = $dbh->prepare($sql);

//bind params
    $statement->bindParam(':state', $state, PDO::PARAM_INT);

//execute
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getProfile($email)
{
    global $dbh;

    //select from database
    $sql = "SELECT * FROM profile WHERE email = :email";

    //prepare statement
    $statement = $dbh->prepare($sql);

    //bind params
    $statement->bindParam(':email', $email, PDO::PARAM_INT);

    //execute
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}
