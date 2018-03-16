<?php
//<!--Ajwinder Singh-->
//<!--2/15/2018-->
//<!--Membe.php-->

class User
{
    //fields
    protected $email;


    function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}