<?php

namespace LiveChat\src\Utility;

use Exception;


class Validator
{
    public static function validate($request)
    {
        $tempKey = '';
        // $errorMessage = '';
        // try {
        foreach ($request as $key => $value) {
            if (strlen($value) == 0) {
                $tempKey = $key;
                throw new Exception(json_encode(array('type' => "input_error", "context" => array('field_name' => $tempKey, "msg" => "This filed is required"))), 1);
            } else {
                continue;
            }
        }
        return self::testInputs($request);
        /*  } catch (\Exception $e) {
            // $error = $e->getMessage();
            // $arrayName = array('type' => "input_error", "context" => array('field_name' => $tempKey, "msg" => $e->getMessage()));
            echo json_encode(array('type' => "input_error", "context" => array('field_name' => $tempKey, "msg" => $e->getMessage())));
            echo json_encode(array('type' => "input_error", "context" => array('field_name' => $tempKey, "msg" => "This filed is required")));
        } */
    }

    public static function testInputs($data)
    {
        $tempArray = array();
        if (gettype($data) === "array") {
            foreach ($data as $key => $value) {
                $value = trim($value);
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                $tempArray[$key] = $value;
            }
            return $tempArray;
        } else {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
}
