<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * dbconnections.php
 * 3/18/2018
 * <<TRUCK POST>>
 * Containing all functions to interact with the database.
 *************************************************************************
 */


/*******************************************
 ********** login Table ********************
 *******************************************
 * CREATE TABLE `asinghgr_grc`.`login`
 * (`id` INT(200) NOT NULL AUTO_INCREMENT ,
 * `email` VARCHAR(30) NOT NULL ,
 * `password` VARCHAR(20) NOT NULL ,
 * `PRIMARY KEY (`id`))
 * ENGINE = MyISAM
 **********************************************
 **********************************************
 */


/*******************************************
 ********** profile Table ********************
 *******************************************
 * CREATE TABLE `asinghgr_grc`.`profile`
 * ( `id` INT(200) NOT NULL AUTO_INCREMENT ,
 * `fname` VARCHAR(50) NOT NULL ,
 * lname` VARCHAR(50) NOT NULL ,
 * `phone` VARCHAR(50) NOT NULL ,
 * `email` VARCHAR(50) NOT NULL,
 * PRIMARY KEY (`id`)) ENGINE = MyISAM;
 **********************************************
 **********************************************
 */


/*******************************************
 ********** Posts Table ********************
 *******************************************
CREATE TABLE `asinghgr_grc`.`posts`
 * ( `id` INT(50) NOT NULL AUTO_INCREMENT ,
 * `fname` VARCHAR(50) NOT NULL ,
 * `lname` VARCHAR(50) NOT NULL ,
 * `email` VARCHAR(50) NOT NULL ,
 * `scaleinfo` VARCHAR(20) NOT NULL ,
 * `state` VARCHAR(50) NOT NULL ,
 * `info` TEXT NOT NULL ,
 * `date` varchar(20) NOT NULL ,
 * `time` varchar(20) NOT NULL ,
 * PRIMARY KEY (`id`))
 * ENGINE = MyISAM;
 **********************************************
 **********************************************
 */

/*
************************************************************************
 * This is connect functions, which takes Ajwinder's, dsn, username, pw,
 * to connect to the database.
*************************************************************************
 */
function connect()
{
    try
    {
        //Instantiate a database object
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        return $dbh;
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
        return;
    }
}

/**
 *
 * The user function is used to insert a new user to the database.
 *
 * @param $id
 * @param $email
 * @param $password
 * @return bool
 *
 */
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

/**
 *
 * The get user, checks the for the password in the user table
 * and returns if it is in there or not.
 * @param $pw
 * @return mixed
 *
 */
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

/**
 *
 * The profile function inserts the info of the
 * user when he completes his profile to the db.
 * In table profile.
 *
 * @param $id
 * @param $fname
 * @param $lname
 * @param $phone
 * @param $email
 * @return bool
 *
 */
function profile($id, $fname, $lname, $phone, $email)
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


/**
 *
 * The insert post is used to insert the post and the credentials
 * of the person who posted the data to the db.
 *
 * @param $id
 * @param $fname
 * @param $lname
 * @param $email
 * @param $scaleinfo
 * @param $state
 * @param $info
 * @param $dateg
 * @param $timeg
 * @return bool
 *
 */
function insertPost($id, $fname, $lname, $email, $scaleinfo, $state, $info, $dateg, $timeg)
{
    global $dbh;

    //1. Define the query
    $sql = "INSERT INTO posts VALUES (:id, :fname, :lname, :email, :scaleinfo, :state, :info, :dateg, :timeg);";

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
    $statement->bindParam(':dateg', $dateg, PDO::PARAM_STR);
    $statement->bindParam(':timeg', $timeg, PDO::PARAM_STR);


    //4. Execute the query
    $result = $statement->execute();


    //5. Return the result
    return $result;
}

/**
 *
 * The getpost is used to get the posts of the particular state.
 *
 * @param $state
 * @return array of all the posts from same state
 *
 */
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

/**
 * Get posts get all the posts from the db orderd by the id.
 *
 * @return array of all the posts
 *
 */
function getPosts()
{
    global $dbh;

//select from database
    $sql = "SELECT * FROM posts ORDER BY id";

//prepare statement
    $statement = $dbh->prepare($sql);

//bind params
    //$statement->bindParam(':state', $state, PDO::PARAM_INT);

//execute
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * It takes the id to delete the particular post where id matches.
 *
 * @param $delete the id
 *
 * @return bool
 */
function deletePost($delete)
{
    global $dbh;

//select from database
    $sql = "DELETE FROM `posts` WHERE `posts`.`id` = :delete";

//prepare statement
    $statement = $dbh->prepare($sql);

//bind params
    $statement->bindParam(':delete', $delete, PDO::PARAM_INT);

//execute
    $result = $statement->execute();

    return $result;
}

/**
 * This is used to update the info on the basis of id match.

 * @param $info the post
 * @param $id the post id
 * @return bool
 *
 */
function updatePost($info, $id)
{
    global $dbh;

//select from database
    $sql = "UPDATE `posts` SET `info` = :info WHERE `posts`.`id` = :id";

//prepare statement
    $statement = $dbh->prepare($sql);

//bind params
    $statement->bindParam(':info', $info, PDO::PARAM_INT);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

//execute
    $result = $statement->execute();

    return $result;


}

/**
 * Get profile is used to get the profile of the user where email matches.
 *
 * @param $email
 * @return mixed
 *
 */
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
