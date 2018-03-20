<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * user.php
 * 3/18/2018
 * <<TRUCK POST>>
 *************************************************************************
 */


/*
************************************************************************
 * This is the parent class, called user, it is extended by other two
 * classes, it sets the email.
*************************************************************************
 */
class User
{
    //fields
    protected $email;


    function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Getter to get the email.
     * @return email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Setter to set the email.
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}