<?php

namespace LiveChat\src\Database;

interface Crud
{
    public static function ReadObj($data);
    public static function DeleteObj($data);
    public static function UpdateObj($data);
    public static function CreateObj($data);
}
