<?php

namespace LiveChat\src\Utils;

class Validator
{
    public static function checkEmptyString($st)
    {
        if (strlen($st) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
