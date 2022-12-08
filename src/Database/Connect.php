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
        if (self::$conn) {
            return self::$conn;
        } else {
            throw new Exception(json_encode(array("type" => "conn_error", "context" => array("msg" => "Server is not available"))),1);
        }
        /* } catch (PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
            echo json_encode(array("type" => "conn_error", "context" => array("msg" => $e->getMessage())));
        } */
    }
}
