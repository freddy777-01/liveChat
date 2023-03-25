<?php

namespace LiveChat\src\Utility;

use Exception;

class Files
{
    private static $allowedFileTypes = array("pdf", "doc", "docx", "jpg", "png", "jpeg");
    private static $size = 15728640; //aproximate to 15MB
    private static $upload_dir = "C:/xampp/htdocs/liveChat/uploads/";

    public static function ValidateFile($file)
    {
        $file = $file['file'];
        $fileExtention = strtolower(pathinfo(basename($file['name']), PATHINFO_EXTENSION));
        if (in_array($fileExtention, self::$allowedFileTypes)) {
            if ($file['size'] <= self::$size) {
                return true;
            } else {
                throw new Exception(Validator::ErrorMessage("file_error", array("msg" => "File size greater than 5MB")), 1);
            }
        } else {
            throw new Exception(Validator::ErrorMessage("file_error", array("msg" => "Sorry, only " . implode('/', self::$allowedFileTypes) . " files are surpported")), 1);
        }
    }
    public static function UploadFile($user, $file)
    {
        $fileExtention = pathinfo(basename($file['file']['name']), PATHINFO_EXTENSION);
        $newFileName = $user . date_timestamp_get(date_create()) . "." . $fileExtention;

        return move_uploaded_file($file['file']['tmp_name'], self::$upload_dir . '' . basename($newFileName));
    }
    public static function FileError($error)
    {
    }
    public static function DeleteFile($file)
    {
        if (file_exists(self::$upload_dir . '' . $file)) {
            if (unlink(self::$upload_dir . '' . $file)) {
                return true;
            } else {
                throw new Exception(Validator::ErrorMessage("file_error", array("msg" => "Unable to delete the file")), 1);
            }
        } else {
            throw new Exception(Validator::ErrorMessage("file_error", array("msg" => "File Does not exist")), 1);
        }
    }
}
