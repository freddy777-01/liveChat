<?php

namespace LiveChat\src\Database;

interface Crud
{
    public static function GET($sql);
    public static function GETALL($sql);
    public static function DELETE($sql);
    public static function UPDATE($sql, $data);
    public static function CREATE($sql, $data);
}
