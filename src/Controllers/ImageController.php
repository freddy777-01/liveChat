<?php

namespace LiveChat\src\Controllers;

use LiveChat\src\Database\DB;
use LiveChat\src\Utility\Validator;
use PDO;
use Exception;
use LiveChat\src\Auth\Authenticate;
use LiveChat\src\Utility\Files;

class ImageController
{
    public static function getUserImages($request)
    {
        switch ($request['request']) {
            case 'user_images':
                $UserId = $request['id'];
                $result = DB::$q->query("SELECT id,user_id,file_name FROM user_uploads WHERE user_id = '$UserId' AND file_type ='image'")->fetchAll(PDO::FETCH_ASSOC);
                // return var_dump($result);
                return Validator::ErrorMessage("images", $result);
                # code...
                break;

            default:
                # code...
                break;
        }
    }
    public static function changeUserImage($request)
    {
        if (Authenticate::checkSessionIsSet()) {
            try {
                $result = DB::$q->prepare("UPDATE users SET profile_image = ? WHERE id = ?")->execute([$request['image'], $_SESSION['User']['id']]);
                if ($result) {
                    return Validator::ErrorMessage("success", array("msg" => "Profile Image Updated"), 1);
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
    public static function getProfileImage($request)
    {
        try {
            $id = $request['id'];
            $result = DB::$q->query("SELECT profile_image FROM users WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return Validator::ErrorMessage("profileImage", $result);
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
    public static function isProfileImage($data)
    {
        if (Authenticate::checkSessionIsSet()) {
            $id = $_SESSION['User']['id'];
            $result = DB::$q->query("SELECT profile_image FROM users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
            if ($result['profile_image'] == $data) {
                return true;
            } else {
                return false;
            }
        }
    }
    public static function deleteImage($request)
    {
        $imageList = array();
        $data = Validator::RemoveFirstRequsetElement($request);
        parse_str($data['data'], $tempData);
        foreach ($tempData as $key => $value) {
            // $tempArray[$key] = intval($value);
            array_push($imageList, $value);
        }
        try {
            $c = 0;
            foreach ($tempData as $key => $value) {
                $i = intval($key);
                $result = DB::$q->exec("DELETE FROM user_uploads WHERE id = $i ");
                if (self::isProfileImage($value)) {
                    self::changeUserImage(array('image' => 'null'));
                }
                if ($result) {
                    Files::DeleteFile($value);
                } else {
                    throw new Exception(Validator::ErrorMessage("error", array("msg" => "Unkown Error Please try again")), 1);
                }
            }
            return Validator::ErrorMessage("success", array("msg" => "Image Deleted"), 1);
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
        array_splice($imageList, 0, sizeof($imageList)); //emptying an array
        return var_dump($imageList);
    }
}
