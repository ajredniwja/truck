<?php

//CREATE TABLE `asinghgr_grc`.`login`
//(`id` INT(200) NOT NULL AUTO_INCREMENT ,
//`email` VARCHAR(30) NOT NULL ,
//`password` VARCHAR(20) NOT NULL ,
//PRIMARY KEY (`id`))
//ENGINE = MyISAM;

class logindatabase
{
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

    function insertUser($id, $email, $password)
    {
        global $dbh;

        //insert to db
        $sql = "INSERT INTO login VALUES (:id; :email, :password)";

        //prepare statement
        $statement = $dbh->prepare($sql);

        //bind params
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);

        //execute the statement
        $success = $statement->execute();

        //return $success
        return $success;
    }
}
