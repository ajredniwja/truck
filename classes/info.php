<?php
/*************************************************************************
 * Ajwinder Singh & Parminder Singh
 * info.php
 * 3/18/2018
 * <<TRUCK POST>>
 *************************************************************************
 */


/*
************************************************************************
 * This is the info class, it extends from profile, it is used to set,
 * and get three fields, which are instate, scaleinfo and info,
 * instate,- the state the user is posting into or looking info for,
 * scale info - open or not open
 * info- the information user enetered
*************************************************************************
 */
class Info extends Profile
{
//fields
    protected $inState;
    protected $scaleinfo;
    protected $info;


    /**
     * Info constructor.
     * Used to pass the email to the parent constructor.
     * @param $email
     */
    function __construct($email)
    {
        parent::__construct($email);
    }


/*
************************************************************************
            ************** Getters **************
*************************************************************************
 */

    /**
     * Getter that returns the state.
     * @return state
     */
    public function getInState()
    {
        return $this->inState;
    }

    /**
     * Getter that returns the scaleinfo.
     * @return scaleinfo
     */
    public function getScaleinfo()
    {
        return $this->scaleinfo;
    }

    /**
     * Getter that returns the info.
     * @return post info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Getter that returns the first name.
     * @return First Name
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Getter that returns the last name.
     * @return last name
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Getter that returns the phone number.
     * @return phonenumber
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Getter that returns the state.
     * @return state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Getter that returns the email
     * @return email
     */
    public function getEmail()
    {
        return $this->email;
    }


/*
************************************************************************
            ************** SETTERS **************
*************************************************************************
 */
    /**
     * Setter to set the state selected by the user.
     * @param $inState
     */
    public function setInState($inState)
    {
        $this->inState = $inState;
    }

    /**
     * Setter to set the scale info.
     * @param $scaleinfo
     */
    public function setScaleinfo($scaleinfo)
    {
        $this->scaleinfo = $scaleinfo;
    }


    /**
     * Setter to set the indo (post)
     * @param $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }


    /**
     * Setter to set the first name
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }


    /**
     * Setter to set the last name
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * Setter to set the phone
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Setter to set the state
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

}