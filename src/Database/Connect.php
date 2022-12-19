<?php

namespace LiveChat\src\Database;

use Exception;
use PDO;
use PDOException;

abstract class Connect
{
    protected static $conn;
    protected static function Con()
    {
        // try {
        self::$conn = new PDO('mysql:host=localhost;dbname=livechat', 'root', '');
        // set the PDO error mode to exception
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        return self::$conn;
        /*  if (self::$conn) {
        } else {
            throw new Exception(json_encode(array("type" => "conn_error", "context" => array("msg" => "Server is not available"))), 1);
        } */
        /*      return self::$conn;
        } catch (PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
            // echo json_encode(array("type" => "conn_error", "context" => array("msg" => $e->getMessage())));
            return json_encode(array("type" => "conn_error", "context" => array("msg" => "Server is not available")));
        } */
    }
    abstract public static function Read($data);
    abstract public static function Delete($data);
    abstract public static function Update($data);
    abstract public static function Create($data);
}
