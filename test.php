<?php
/* parse_str("name=Peter&age=43", $myArray);
print_r($myArray);
echo $myArray['name']; */

/* $t = '';
echo strlen($t); */

function divide($dividend, $divisor)
{
    if ($divisor == 0) {
        throw new Exception("Division by zero");
    }
    return $dividend / $divisor;
}

echo divide(5, 0);
