<?php
class User
{
    private $first_name;
    private $last_name;
    private $user_name;
    private $email;
    private $gender;
    private $about;
    private $created_at;

    /*  function __construct($firstName, $lastName, $userName, $email, $gender, $about, $createdAt)
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->user_name = $userName;
        $this->email = $email;
        $this->gender = $gender;
        $this->about = $about;
        $this->created_at = $createdAt;
    } */
    // Setter Functions
    public function set_FirstName($firstName)
    {
        $this->first_name = $firstName;
    }
    public function set_LastName($lastName)
    {
        $this->last_name = $lastName;
    }
    public function set_UserName($UserName)
    {
        $this->user_name = $UserName;
    }
    public function set_email($email)
    {
        $this->email = $email;
    }
    public function set_Gender($gender)
    {
        $this->gender = $gender;
    }
    public function set_About($about)
    {
        $this->about = $about;
    }
    public function set_CreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    // Getter Functions
    public function get_FirstName()
    {
        return $this->first_name;
    }
    public function get_LastName()
    {
        return $this->last_name;
    }
    public function get_UserName()
    {
        return $this->user_name;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function get_Gender()
    {
        return $this->gender;
    }
    public function get_About()
    {
        return $this->about;
    }
    public function get_CreatedAt()
    {
        return $this->created_at;
    }
}

$User = new User();
