<?php

namespace LiveChat\src\Controllers;

use LiveChat\src\Models\User;
use LiveChat\src\Database\Crud;


class UserController extends User implements Crud
{

    private $con;
    function __construct()
    {
        include_once '../Database/Connect.php';
        $this->con = $conn;
    }
    public static function backEnd($request)
    {
        array_shift($request);
        return $request;
    }
    public static function CreateObj($request)
    {
        try {
            $sql = 'INSERT INTO Users(first_name,last_name,email) VALUES(?,?,?,?)';
            $stmt = self::$con->prepare($sql);
            $result = $stmt->execute([$request['firstName'], $request['lastName'], $request['email']]);
            if ($result) {
                return true;
            }
        } catch (\Exception $th) {
            //throw $th;
        }
    }
    public static function ReadObj($data)
    {
    }
    public static function UpdateObj($data)
    {
    }
    public static function DeleteObj($data)
    {
    }
}
