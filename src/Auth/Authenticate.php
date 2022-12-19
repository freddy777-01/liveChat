<?php

namespace LiveChat\src\Auth;

use Exception;
use LiveChat\src\Controllers\UserController;
use LiveChat\src\Utility\Validator;

/** 
 * 
 * This class is responsible to authenticate user for login purpose
 * also it will be responsible to logout a user.
 * Other functionality is that it will authenticate user for other purpose
 */
session_start();
class Authenticate
{

    public static function Read($data) // I have changed the name of the function to "Read" instead of login becouse login functionality is a Read process to the data base
    {
        // $_SESSION['User'] = array('fName' => $fname, 'lName' => $lname, 'type' => $rows['user_type'], 'regist' => $rows['regist_no'], 'email' => $UserEmail);
        // header("Location:profile2.php?");
        try {
            $tempArray = array();
            $tempArray['request'] = 'login';
            switch ($data['request']) {
                case 'login':
                    $data = Validator::RemoveFirstRequsetElement($data); //this remove the 'request' element of the array

                    if (Validator::ValidateEmail($data['email'])) {
                        $tempArray['select'] = 'email';
                        $tempArray['data'] = $data;
                    } else {
                        $tempArray['select'] = 'user_name';
                        $tempArray['data'] = $data;
                    }
                    // UserController::Read($tempArray);
                    $result = UserController::Read($tempArray);
                    // header("Location:/liveChat/profile/");
                    // return realpath("profile/");
                    $_SESSION['User'] = $result;
                    return Validator::ErrorMessage("url", array('msg' => '/liveChat/profile/'));
                    // return $data;
                    break;
                case 'user':
                    return UserController::Read($data);
                default:
                    # code...
                    break;
            }
        } catch (\Exception $e) {
            switch ($e->getCode()) {
                case 2002:
                    //connection error for database
                    return Validator::ErrorMessage("conn_error", array("msg" => "Database Server is not available !, Please Try Again"));
                    break;
                default:
                    return $e->getMessage();
                    break;
            }
        }
    }
    public static function LogOut()
    {
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        return Validator::ErrorMessage("url", array('msg' => '/liveChat/forms/login/'));
    }
    public static function RegisterUser($data)
    {
        try {
            $data = Validator::RemoveFirstRequsetElement($data);
            $data = Validator::validate($data);
            $data = Validator::ValidateEmail($data);
            $data = Validator::TestInputs($data);
            return UserController::Create($data);
        } catch (\Exception $e) {
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
        }
    }
    public static function checkSessionIsSet()
    {
        if (isset($_SESSION['User'])) {
            return true;
        } else {
            return false;
        }
    }
}
