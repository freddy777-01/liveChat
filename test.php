<?php
/* parse_str("name=Peter&age=43", $myArray);
print_r($myArray);
echo $myArray['name']; */

/* $t = '';
echo strlen($t); */

/* function divide($dividend, $divisor)
{
    if ($divisor == 0) {
        throw new Exception("Division by zero");
    }
    return $dividend / $divisor;
}

try {
    echo divide(5, 0);
} catch (Exception $e) {
    print_r($e->getMessage());
} */

/* $age = array("Peter" => "35", "Ben" => "37", "Joe" => "43");
$temp = array();
foreach ($age as $key => $value) {
    $value = $value . "0";
    $temp[$key] = $value;
}
print_r($temp); */
/* try {

    self::$conn = new PDO('mysql:host=localhost;dbname=livechat', 'root', '');
    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Throwable $th) {
    print_r(gettype($th->getCode()));
} */

/* $file =  file_get_contents("env.json");
var_dump(json_decode($file, true)); */

echo __DIR__;
