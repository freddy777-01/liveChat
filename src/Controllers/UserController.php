<?php

namespace LiveChat\src\Controllers;

use Exception;
use LiveChat\src\Models\User;
use LiveChat\src\Database\Crud;
use LiveChat\src\Database\Connect;
use LiveChat\src\Utility\Validator;

class UserController extends Connect implements Crud
{

    public static function validator($request)
    {
        array_shift($request);
        // $validData = Validator::validate($request);
        // return Validator::testInputs($validData);
        return Validator::validate($request);
    }
    public static function CreateObj($request)
    {
        // return count($data);
        try {
            // $data = self::validator($request);
            $sql = "INSERT INTO users(first_name,last_name,email,pasword) VALUES(:first_name,:last_name,:email,:pasword)";
            $stmt = parent::Con()->prepare($sql);
            if (gettype(self::validator($request)) === "array") {
                $result = $stmt->execute(self::validator($request));
                if ($result) {
                    return json_encode(array("type" => "success", "context" => array("msg" => "successfully signed up")));
                } else {
                    throw new Exception(json_encode(array("type" => "put_error", "context" => array("msg" => "something went wrong !,Try again"))), 1);
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
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
