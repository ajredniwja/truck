<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * profile.php
 * 3/18/2018
 * <<TRUCK POST>>
 *************************************************************************
 */


/*
************************************************************************
 * This is the Profile class, it extends from User class, it passes the
 * email the user. i.e parent class. The protected fields has getters and
 * setters in Info class.
*************************************************************************
 */
class Profile extends User
{

    //fields

    protected $fname;
    protected $lname;
    protected $phone;
    protected $state;


    /**
     * Profile constructor, passes the email to the parent class.
     * @param $email
     */
    function __construct($email)
    {
        //passing to parent constructor
        parent::__construct($email);
    }

}