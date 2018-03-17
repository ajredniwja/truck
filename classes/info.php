<?php


class Info extends Profile
{
//fields
    protected $inState;
    protected $scaleinfo;
    protected $info;

    function __construct($email)
    {
        parent::__construct($email);
    }

    /**
     * @return mixed
     */
    public function getInState()
    {
        return $this->inState;
    }

    /**
     * @param mixed $inState
     */
    public function setInState($inState)
    {
        $this->inState = $inState;
    }

    /**
     * @return mixed
     */
    public function getScaleinfo()
    {
        return $this->scaleinfo;
    }

    /**
     * @param mixed $scaleinfo
     */
    public function setScaleinfo($scaleinfo)
    {
        $this->scaleinfo = $scaleinfo;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

}