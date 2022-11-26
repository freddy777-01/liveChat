<?php
include_once 'Classes.php';

class Auth implements Crud
{

    private $con;
    function __construct()
    {
        include_once 'Connect.php';
        $this->con = $conn;
    }

    public function CreateObj($data)
    {
        $sql = 'INSERT INTO Users(first_name,last_name,email) VALUES(:first_name,:last_name,:email)';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':first_name', $data);
        $stmt->bindParam(':last_name', $data);
        $stmt->bindParam(':email', $data);
    }
    public function ReadObj($data)
    {
    }
    public function UpdateObj($data)
    {
    }
    public function DeleteObj($data)
    {
    }
}
