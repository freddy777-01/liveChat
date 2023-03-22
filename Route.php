<?php


require_once './vendor/autoload.php';

use LiveChat\src\Auth\Authenticate;
use LiveChat\src\Controllers\UserController;


switch ($_POST['request']) {
    case 'registerUser':
        // echo sizeof($_POST);
        print_r(Authenticate::RegisterUser($_POST));
        break;
    case 'login':
        print_r(Authenticate::Read($_POST));
        break;
    case 'logout':
        print_r(Authenticate::LogOut());
        break;
    case 'user': //getting user data
        print_r(Authenticate::Read($_POST));
        break;
    case 'updateUser':
        print_r(UserController::Update($_POST));
        break;
    case 'updatePassword':
        print_r(UserController::Update($_POST));
        break;
    case 'image':
        print_r(UserController::Upload($_POST, $_FILES));
        // print_r($_POST['request']);
        break;
    default:
        echo 'Hello';
        break;
}
