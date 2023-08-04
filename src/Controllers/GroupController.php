<?php

namespace LiveChat\src\Controllers;

use Exception;
use LiveChat\src\Auth\Authenticate;
use LiveChat\src\Database\DB;
use LiveChat\src\Utility\Validator;
use PDO;

class GroupController
{
    public static function Create($request)
    {
        parse_str($request['data'], $tempData);
        if (Authenticate::checkSessionIsSet()) {
            $tempData['group_owner'] = intval($_SESSION['User']['id']);
        }
        try {
            if (Validator::validateNumberOfWordsAndChars($tempData['about_group'])) {
                $result = DB::CREATE("INSERT INTO `GROUPS`(group_name,about_group,group_owner) VALUE(:group_name,:about_group,:group_owner)", $tempData);
                if ($result['result']) {
                    return Validator::ErrorMessage("success", array("msg" => "successfully Created a group"));
                } else {
                    throw new Exception(Validator::ErrorMessage("put_error", array("msg" => "Something went wrong !,Try again"), 1));
                }
                // return Validator::ErrorMessage("success", array("msg" => "Looks Good"));
            }
            /**
             * ** Data too long for about_group column
             * Here I had to validate number of characters before saving them to the data base.
             * - currently number of characters in the about_group column is 100,
             * - an error message should be returned that user as exceed numbeer of characters greater than 100.
             */
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
        /** 
         * I had a problem on inserting in "groups" table.
         * -- this was due to the reason that mysql has a reserved word "groups" for its use (that is used for other purpose)
         * -- so in order to use the "groups" keyword i had to quote it with backticks
         */
        /* $stmt->bindParam(':group_name', $tempData['group_name']);
        $stmt->bindParam(':about_group', $tempData['about_group']);
        $stmt->bindParam(':group_owner', $tempData['group_owner'], PDO::PARAM_INT); */
        // if (gettype($tempData) === "array") {
        // }
        // return $tempData;
    }
    public static function getGroupsByFilter($request)
    {
        if (Authenticate::checkSessionIsSet()) {
            $userID = intval($_SESSION['User']['id']);
        }
        switch ($request['filter']) {
            case 'all-groups':
                $result = DB::GETALL(
                    "SELECT id,group_name,about_group,group_owner FROM `GROUPS` WHERE group_owner <> $userID  AND
                    id NOT IN(SELECT group_id FROM GROUPS_SUBSCRIBERS WHERE user_id = $userID)"
                );
                // $result["subscibed"] = false;
                // return var_dump($result);
                return Validator::ErrorMessage("groups", $result);
                break;
            case 'subscribes':
                $result = DB::GETALL(
                    "SELECT id,group_name,about_group,group_owner FROM `GROUPS` WHERE id IN(SELECT group_id FROM GROUPS_SUBSCRIBERS  WHERE user_id = $userID)"
                );
                // return $result;
                return Validator::ErrorMessage("groups", $result);
                break;
            case 'my-groups':
                $result = DB::GETALL("SELECT * FROM `GROUPS` WHERE group_owner = $userID");
                return Validator::ErrorMessage("groups", $result);
                break;
            default:
                return Validator::ErrorMessage("groups", "......");
                break;
        }
    }
    public static function Subscription($request)
    {
        if (Authenticate::checkSessionIsSet()) {
            $userID = intval($_SESSION['User']['id']);
            $gID = intval($request['data']['group_id']);
        }
        try {
            switch ($request['data']['requestTo']) {
                case 'subscribe':
                    // $getResult = DB::GET("SELECT * FROM GROUPS_SUBSCRIBERS WHERE group_id = '$gID' AND user_id = '$userID'");
                    // return Validator::ErrorMessage("success", array("msg" => $getResult));
                    if (!DB::GET("SELECT * FROM GROUPS_SUBSCRIBERS WHERE group_id = '$gID' AND user_id = '$userID'")) {
                        $result = DB::CREATE("INSERT INTO `GROUPS_SUBSCRIBERS`(group_id,user_id) VALUE(:group_id,:user_id)", array('group_id' => $gID, 'user_id' => $userID));
                        if ($result['result']) {
                            return Validator::ErrorMessage("success", array("msg" => "successfully Subscribed"));
                            // return Validator::ErrorMessage("success", array("msg" => $getResult));
                        } else {
                            throw new Exception(Validator::ErrorMessage("put_error", array("msg" => "Something went wrong !,Try again"), 1));
                        }
                    }
                    break;
                case 'unsubscribe':
                    $gID = $request['data']['group_id'];
                    $result = DB::DELETE("DELETE FROM GROUPS_SUBSCRIBERS WHERE group_id = $gID ");
                    if ($result) {
                        return Validator::ErrorMessage("success", array("msg" => "successfully UnSubscribed"));
                    } else {
                        // return $result;
                        throw new Exception(Validator::ErrorMessage("put_error", array("msg" => "Something went wrong !,Try again"), 1));
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
        // return $request['data']['group_id'];
    }
    public static function Delete($request)
    {
        $groupId = $request['data']['group_id'];
        $result = DB::GETALL("SELECT id FROM GROUPS_SUBSCRIBERS WHERE group_id = '$groupId'");
        if ($result) {
            foreach ($result as $key => $value) { // Removing all subscribers
                $tempId = $value['id'];

                // $t = DB::DELETE("DELETE FROM GROUPS_SUBSCRIBERS WHERE id = $value ");
                var_dump(DB::DELETE("DELETE FROM GROUPS_SUBSCRIBERS WHERE id = $tempId "));
                // return Validator::ErrorMessage("success", array("msg" => gettype($tempId)));
                /* if (DB::DELETE("DELETE FROM GROUPS_SUBSCRIBERS WHERE id = $tempId ")) {
                    // Do nothing
                } else {

                    throw new Exception(Validator::ErrorMessage("error", array("msg" => "Unkown Error Please try again")), 1);
                } */
            }
            if (DB::DELETE("DELETE FROM `GROUPS` WHERE id = $groupId ")) {
                return Validator::ErrorMessage("success", array("msg" => "agroup was deleted"));
            }
        } else { // incase no one subscribed to the group
            /* if (DB::DELETE("DELETE FROM `GROUPS` WHERE id = $groupId ")) {
                return Validator::ErrorMessage("success", array("msg" => "agroup was deleted"));
            } */
        }
        // $result = DB::GETALL();
    }
    public static function Update()
    {
    }
}
