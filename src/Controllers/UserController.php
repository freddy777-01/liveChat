<?php

namespace LiveChat\src\Controllers;

use Exception;
use LiveChat\src\Auth\Authenticate;
use LiveChat\src\Models\User;
use LiveChat\src\Database\Crud;
use LiveChat\src\Database\Connect;
use LiveChat\src\Utility\Validator;
use PDO;

class UserController extends Connect
{

    public static function validator($request)
    {
        return Validator::validate(Validator::RemoveFirstRequsetElement($request));
    }
    public static function Create($request)
    {
        // return count($data);
        // try {
        // $data = self::validator($request);
        $sql = "INSERT INTO users(first_name,last_name,email,pasword) VALUES(:first_name,:last_name,:email,:pasword)";
        $stmt = parent::Con()->prepare($sql);
        if (gettype($request) === "array") {
            $result = $stmt->execute($request);
            if ($result) {
                return Validator::ErrorMessage("success", array("msg" => "successfully signed up !, Please Signin"));
            } else {
                throw new Exception(Validator::ErrorMessage("put_error", array("msg" => "Something went wrong !,Try again"), 1));
            }
        }
        /* } catch (\Exception $e) {
            switch ($e->getCode()) {
                case 2002:
                    //connection error for database
                    return Validator::ErrorMessage("conn_error", array("msg" => "Database Server is not available !, Please Try Again"));
                    break;
                case 23000:
                    //error for unique values in the database, if that value already exists
                    return Validator::ErrorMessage("error", array("msg" => "Email already exist !"));
                    break;
                default:
                    return $e->getMessage();
                    break;
            }
        } */
    }
    public static function Read($data)
    {
        $sql = '';
        switch ($data['request']) {
            case 'login':
                $field = $data['data']['email'];
                $pwd = $data['data']['pasword'];
                if ($data['select'] === 'email') {
                    $sql = "SELECT id,first_name, last_name,user_name,email FROM users WHERE email = '$field' AND pasword = '$pwd'";
                } else {
                    $sql = "SELECT id,first_name, last_name,user_name,email FROM users WHERE  user_name = '$field' AND pasword = '$pwd'";
                }
                $result = parent::Con()->query($sql)->fetch(PDO::FETCH_ASSOC);
                // return $result;
                if ($result) {
                    return $result;
                    // return $result->fetch(PDO::FETCH_BOTH);
                } else {
                    throw new Exception(Validator::ErrorMessage("error", array("msg" => "Invalid User Name / Email")), 1);
                }
                break;
            case 'user':
                $id = $data['id'];
                $sql = "SELECT first_name, last_name,user_name,email FROM users WHERE id = '$id'";
                $result = parent::Con()->query($sql)->fetch(PDO::FETCH_ASSOC);
                return Validator::ErrorMessage("user", $result);
                break;
            default:
                throw new Exception(Validator::ErrorMessage("error", array("msg" => "Unkown Error")), 1);
                break;
        }
        /*   if ($data['request'] === 'login') {
            
        } */
    }
    public static function Update($data)
    {
        if (Authenticate::checkSessionIsSet()) {
            $sql = '';
            $tempArray = array();
            try {
                if (strcmp($data['request'], 'updateUser') == 0) {
                    $data = Validator::RemoveFirstRequsetElement($data);
                    // $sql = "UPDATE users SET first_name = ?,last_name = ?,email= ? WHERE id = ?";
                    $sql = "UPDATE users SET first_name = ?,last_name = ?,user_name = ?,email= ? WHERE id = ?";
                    if (strlen($data['user_name']) == 0) {
                        foreach ($data as $key => $value) {
                            if (strcmp($key, 'user_name') != 0) {
                                $tempArray[$key] = $value;
                            }
                        }
                        validator::ValidateEmail(validator::validate($tempArray));
                        $result = parent::Con()->prepare($sql)->execute([$tempArray['first_name'], $tempArray['last_name'], NULL, $tempArray['email'], $_SESSION['User']['id']]);
                    } else {
                        validator::ValidateEmail(validator::validate($data));
                        $result = parent::Con()->prepare($sql)->execute([$data['first_name'], $data['last_name'], $data['user_name'], $data['email'], $_SESSION['User']['id']]);
                    }
                    if ($result) {
                        return Validator::ErrorMessage("success", array("msg" => "successfully updated"));
                    }
                }
            } catch (\Exception $e) {
                switch ($e->getCode()) {
                    case 2002: //connection error for database
                        return Validator::ErrorMessage("conn_error", array("msg" => "Database Server is not available !, Please Try Again"));
                        break;
                    default:
                        return $e->getMessage();
                        break;
                }
            }
        }
    }
    public static function Delete($data)
    {
    }
}
