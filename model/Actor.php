<?php


//this class defines a actor object
class Actor
{
    private $m_actorId; //int
    private $m_firstName; //string
    private $m_lastName; //string

    

    public function __construct($in_id,$in_fname,$in_lname)
    {
        $this->m_actorId = $in_id;
        $this->m_firstName = $in_fname;
        $this->m_lastName = $in_lname;
    }
    
    public function getID()
    {
        return ($this->m_actorId);
    }
    public function setID($in_actorID)
    {
        $this->m_actorId = $in_actorID;
    }
    public function getFirstName()
    {
        return ($this->m_firstName);
    }
    
    public function setFirstName($in_firstName)
    {
        $this->m_firstName = $in_firstName;
    }

    public function getLastName()
    {
        return ($this->m_lastName);
    }
    
    public function setLastName($in_lastName)
    {
        $this->m_lastName = $in_lastName;
    }
    


}

?>
