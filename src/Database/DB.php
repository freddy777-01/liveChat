<?php

namespace LiveChat\src\Database;

use Exception;
use PDO;
use PDOException;

class DB
{
    public static $q;
    function __construct()
    {
        try {
            self::$q = new PDO('mysql:host=localhost;dbname=livechat', 'root', '2022');
            // set the PDO error mode to exception
            self::$q->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "qected successfully";
            // return self::$q;
            /* if (self::$q) {
            } else {
                throw new Exception(json_encode(array("type" => "q_error", "context" => array("msg" => "Server is not available"))), 1);
            } */
            return self::$q;
        } catch (PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
            // echo json_encode(array("type" => "conn_error", "context" => array("msg" => $e->getMessage())));
            return json_encode(array("type" => "conn_error", "context" => array("msg" => "Database is not available")));
        }
    }
    public static function close()
    {
        self::$q = null;
    }
}
$DB = new DB();
