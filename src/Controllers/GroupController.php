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
            $result = DB::$q->prepare("INSERT INTO `groups`(group_name,about_group,group_owner) VALUE(:group_name,:about_group,:group_owner)")->execute($tempData);
            DB::close();
            if ($result) {
                return Validator::ErrorMessage("success", array("msg" => "successfully Created a group"));
            } else {
                throw new Exception(Validator::ErrorMessage("put_error", array("msg" => "Something went wrong !,Try again"), 1));
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
                $result = DB::$q->query(
                    "SELECT id,group_name,about_group,group_owner FROM `groups` WHERE id NOT IN(SELECT group_id FROM groups_subscribers WHERE user_id = $userID)"
                )->fetchAll(PDO::FETCH_ASSOC);
                // $result["subscibed"] = false;
                // return var_dump($result);
                return Validator::ErrorMessage("groups", $result);
                break;
            case 'subscribes':
                $result = DB::$q->query(
                    "SELECT id,group_name,about_group,group_owner FROM `groups` WHERE id IN(SELECT group_id FROM groups_subscribers WHERE user_id = $userID)"
                )->fetchAll(PDO::FETCH_ASSOC);
                // return $result;
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
                    if (!DB::$q->query("SELECT * FROM groups_subscribers WHERE group_id = '$gID' AND user_id = '$userID'")->fetch(PDO::FETCH_ASSOC)) {
                        $result = DB::$q->prepare("INSERT INTO `groups_subscribers`(group_id,user_id) VALUE(:group_id,:user_id)")->execute(array('group_id' => $gID, 'user_id' => $userID));
                        DB::close();
                        if ($result) {
                            return Validator::ErrorMessage("success", array("msg" => "successfully Subscribed"));
                        } else {
                            throw new Exception(Validator::ErrorMessage("put_error", array("msg" => "Something went wrong !,Try again"), 1));
                        }
                    }
                    break;
                case 'unsubscribe':
                    $gID = $request['data']['group_id'];
                    $result = DB::$q->exec("DELETE FROM groups_subscribers WHERE group_id = $gID ");
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
    public static function Delete()
    {
    }
    public static function Update()
    {
    }
}
