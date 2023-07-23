<?php

namespace LiveChat\src\Controllers;

use Exception;
use LiveChat\src\Auth\Authenticate;
use LiveChat\src\Models\User;
use LiveChat\src\Database\Crud;
use LiveChat\src\Database\DB;
use LiveChat\src\Utility\Files;
use LiveChat\src\Utility\Validator;
use PDO;

class UserController
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
        // $sql = ;
        if (gettype($request) === "array") {
            $result = DB::CREATE("INSERT INTO USERS(first_name,last_name,email,pasword) VALUES(:first_name,:last_name,:email,:pasword)", $request);
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
                    return Validator::ErrorMessage("error", array("msg" => $e->getMessage()));
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
                    $sql = "SELECT id,first_name, last_name,user_name,profile_image,email FROM USERS WHERE email = '$field' AND pasword = '$pwd'";
                } else {
                    $sql = "SELECT id,first_name, last_name,user_name,profile_image,email FROM USERS WHERE  user_name = '$field' AND pasword = '$pwd'";
                }
                $result = DB::GET($sql);
                // return $result;
                if ($result) {
                    return $result;
                    // return $result->fetch(PDO::FETCH_BOTH);
                } else {
                    throw new Exception(Validator::ErrorMessage("error", array("msg" => "Invalid User Name / Email / Password")), 1);
                }
                break;
            case 'user':
                $id = $data['id'];
                $sql = "SELECT first_name, last_name,user_name,email FROM USERS WHERE id = '$id'";
                $result = DB::GET($sql);
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
                switch ($data['request']) {
                    case 'updateUser':
                        // if (strcmp($data['request'], 'updateUser') == 0) {
                        $data = Validator::RemoveFirstRequsetElement($data);
                        // $sql = "UPDATE users SET first_name = ?,last_name = ?,email= ? WHERE id = ?";
                        $sql = "UPDATE USERS SET first_name = ?,last_name = ?,user_name = ?,email= ? WHERE id = ?";
                        if (strlen($data['user_name']) == 0) {
                            foreach ($data as $key => $value) {
                                if (strcmp($key, 'user_name') != 0) {
                                    $tempArray[$key] = $value;
                                }
                            }
                            validator::ValidateEmail(validator::validate($tempArray));
                            $result = DB::UPDATE($sql, [$tempArray['first_name'], $tempArray['last_name'], NULL, $tempArray['email'], $_SESSION['User']['id']]);
                        } else {
                            validator::ValidateEmail(validator::validate($data));
                            $result = DB::UPDATE($sql, [$data['first_name'], $data['last_name'], $data['user_name'], $data['email'], $_SESSION['User']['id']]);
                        }
                        if ($result) {
                            return Validator::ErrorMessage("success", array("msg" => "successfully updated"));
                        }
                        // }
                        break;
                    case 'updatePassword':
                        $sql = "UPDATE USERS SET pasword = ? WHERE id = ?";
                        $result = DB::UPDATE($sql, [$data['pasword'], $_SESSION['User']['id']]);
                        if ($result) {
                            return Validator::ErrorMessage("success", array("msg" => "successfully password updated"));
                        }
                        break;

                    default:
                        throw new Exception(Validator::ErrorMessage("error", array("msg" => "Unkown Request")), 1);
                        break;
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
            array_splice($tempArray, 0, sizeof($tempArray)); // emptying an array
        } else {
            return Validator::ErrorMessage("error", array("msg" => "You are not Auathorized"));
        }
    }
    public static function Upload($request, $file)
    {
        if (Authenticate::checkSessionIsSet()) {
            $sql = '';
            $tempArray = array();
            try {
                switch ($request['request']) {
                    case 'image_upload':
                        $imageType = array("jpg", "png", "jpeg");
                        $fileExtention = strtolower(pathinfo(basename($file['file']['name']), PATHINFO_EXTENSION));
                        if (in_array($fileExtention, $imageType)) {
                            if (Files::ValidateFile($file)) {
                                if (Files::UploadFile($_SESSION['User']['first_name'], $file)) {

                                    $newFileName = $_SESSION['User']['first_name'] . date_timestamp_get(date_create()) . "." . $fileExtention;
                                    /* $sql = "UPDATE users SET profile_image = ? WHERE id = ?";
                                    $result= parent::Con()->prepare($sql)->execute([$newFileName, $_SESSION['User']['id']]); */

                                    $sql = "INSERT INTO USER_UPLOADS(user_id,file_name,file_type) VALUES(:user_id,:file_name,:file_type)";
                                    $result = DB::CREATE($sql, array('user_id' => $_SESSION['User']['id'], 'file_name' => $newFileName, 'file_type' => 'image'));
                                    //this "$db->lastInsertId()" is used to get last inserted ID
                                    $last_id = $result['lastInsertId'];
                                    if ($result['result']) {
                                        $imageInfor = DB::GET("SELECT user_id,file_name FROM user_uploads WHERE id = '$last_id'");
                                        $userId = $imageInfor['user_id'];
                                        $imageName = $imageInfor['file_name'];
                                        $profilePictureUpdated = DB::update("UPDATE users SET profile_image = ? WHERE id = ?", [$imageName, $userId]);
                                        if ($profilePictureUpdated) {
                                            return Validator::ErrorMessage("success", array("msg" => "Image Upload Success"), 1);
                                        }
                                    }
                                }
                            }
                        } else {
                            throw new Exception(Validator::ErrorMessage("file_error", array("msg" => "Please Upload an Image")), 1);
                        }
                        break;
                    case 'file':
                        $fileType = array("pdf", "doc", "docx");
                        # code...
                        break;
                    default:
                        throw new Exception(Validator::ErrorMessage("error", array("msg" => "Unkown Request")), 1);
                        break;
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
        } else {
            return Validator::ErrorMessage("error", array("msg" => "You are not Auathorized"));
        }
    }
    public static function Delete($data)
    {
    }
}
