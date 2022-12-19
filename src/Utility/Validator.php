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
                throw new Exception(self::ErrorMessage("input_error", array('field_name' => $tempKey, "msg" => "This filed is required")), 1);
            } else {
                continue;
            }
        }
        return $request;
        /*  } catch (\Exception $e) {
            // $error = $e->getMessage();
            // $arrayName = array('type' => "input_error", "context" => array('field_name' => $tempKey, "msg" => $e->getMessage()));
            echo json_encode(array('type' => "input_error", "context" => array('field_name' => $tempKey, "msg" => $e->getMessage())));
            echo json_encode(array('type' => "input_error", "context" => array('field_name' => $tempKey, "msg" => "This filed is required")));
        } */
    }

    public static function TestInputs($data)
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
    public static function HashFunc($data)
    {
        $tempArray = array();
        // $hashVal = hash("sha256", $data, false);
        if (gettype($data) === "array") {
            foreach ($data as $key => $value) {
                $key === 'pasword' ?
                    $tempArray[$key] = hash("sha256", $value, false) :
                    $tempArray[$key] = $value;
            }
            return $tempArray;
        } else {
            return hash("sha256", $data, false);
        }
    }
    public static function ErrorMessage($ErrorType, $Context)
    {
        return json_encode(array('type' => $ErrorType, 'context' => $Context));
    }
    public static function RemoveFirstRequsetElement($data)
    {
        /**
         * This function is responsible for removing the first request
         * element from the array of request
         */
        array_shift($data); // this removes the first element from the array
        return $data;
    }
    public static function ValidateEmail($data)
    {
        $tempKey = '';
        if (gettype($data) === "array") {
            foreach ($data as $key => $value) {
                if (strcmp($key, 'email') == 0) {
                    $tempKey = $key;
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception(self::ErrorMessage("input_error", array('field_name' => $tempKey, "msg" => "Provide a valid Email")), 1);
                    }
                } else {
                    continue;
                }
            }
            return $data;
        } else {
            return filter_var($data, FILTER_VALIDATE_EMAIL);
        }
    }
}
