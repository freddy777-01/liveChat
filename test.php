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

// echo __DIR__;

// File submittion
$upload_dir = "uploads/";
$allowedFileTypes = array("pdf", "doc", "docx", "jpg", "png", "jpeg");

$size = 15728640; //aproximate to 15MB
/* if (isset($_POST['submit'])) {
    print_r($_POST);
    if (!empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $target_file = $upload_dir . basename($file["name"]);
        // var_dump($file);
        $fileExtention = pathinfo(basename($file['name']), PATHINFO_EXTENSION);
        print_r($fileExtention);
        if (in_array($fileExtention, $allowedFileTypes)) {
            if ($file['size'] <= $size) {
                $newFileName = "freddy" . uniqid() . "." . $fileExtention;
                if (move_uploaded_file($file['tmp_name'], $upload_dir . '' . $newFileName)) {
                    echo 'File Uploaded';
                }
            }

        }
    }
} */
// $date = date_create();
echo date_timestamp_get(date_create());
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h4>File Upload</h4>
    <form id="fupForm" enctype="multipart/form-data" method="POST" action="">
        <input type="text" name="name" id="">
        <div class="form-group">
            <label for="file">File:</label>
            <input type="file" class="form-control" id="file" name="file" />
        </div>

        <input type="submit" name="submit" class="btn btn-primary submitBtn" value="SUBMIT" />
    </form>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#file').change(function() {
            console.log(this.files[0]);
            let file = this.files[0]
            let imageType = ["image/jpg", "image/png", "image/jpeg"]
            imageType.includes(file.type) ? console.log('True') : console.log('false');
        })
    </script>
</body>

</html> -->