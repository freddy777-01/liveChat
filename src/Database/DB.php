<?php

namespace LiveChat\src\Database;

use Exception;
use LiveChat\src\Utility\Validator;
use PDO;
use PDOException;

error_reporting(E_ALL);
ini_set('display_errors', '1');
class DB implements Crud
{
    private static $con;
    public static $lastInsertId;
    function __construct()
    {
        try {
            self::$con = new PDO('mysql:host=localhost;dbname=livechat', 'root', '1237');
            // set the PDO error mode to exception
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "qected successfully";
            // return self::$q;
            /* if (self::$q) {
            } else {
                throw new Exception(json_encode(array("type" => "q_error", "context" => array("msg" => "Server is not available"))), 1);
            } */
            return self::$con;
        } catch (PDOException $e) {
            switch ($e->getCode()) {
                case 2002: //connection error for database
                    return json_encode(array("type" => "conn_error", "context" => array("msg" => "Database is not available")));
                    break;
                default:
                    return json_encode(array("type" => "conn_error", "context" => array("msg" => $e->getMessage())));
                    break;
            }
            // echo "Connection failed: " . $e->getMessage();
            // echo json_encode(array("type" => "conn_error", "context" => array("msg" => $e->getMessage())));
        }
    }

    public static function CREATE($sql, $data)
    {
        try {
            $result = self::$con->prepare($sql)->execute($data);
            self::$lastInsertId = self::$con->lastInsertId();
            self::CLOSE();
            return array("result" => $result, "lastInsertId" => self::$lastInsertId);
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
                case 42502:
                    return Validator::ErrorMessage("error", array("msg" => "Unknown error please try again !"));
                    break;
                default:
                    return Validator::ErrorMessage("error", array("msg" => $e->getMessage()));
                    break;
            }
        }
    }
    public static function DELETE($sql)
    {
        $result = self::$con->exec($sql);
        // self::CLOSE();
        return $result;
    }
    public static function UPDATE($sql, $data)
    {
        $result = self::$con->prepare($sql)->execute($data);
        self::CLOSE();
        return $result;
    }
    public static function GET($sql)
    {
        $result =  self::$con->query($sql)->fetch(PDO::FETCH_ASSOC);
        // self::CLOSE();
        return $result;
    }
    public static function GETALL($sql)
    {
        $result = self::$con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        self::CLOSE();
        return $result;
    }
    public static function CLOSE()
    {
        self::$con = null;
    }
}
$DB = new DB();
