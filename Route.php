<?php


require_once './vendor/autoload.php';

use LiveChat\src\Controllers\UserController;

switch ($_POST['request']) {
    case 'registerUser':
        // echo sizeof($_POST);
        print_r(UserController::backEnd($_POST));
        break;

    default:
        echo 'Hello';
        break;
}
