<?php


require_once './vendor/autoload.php';

use ImageController as GlobalImageController;
use LiveChat\src\Auth\Authenticate;
use LiveChat\src\Controllers\UserController;
use LiveChat\src\Controllers\ImageController;


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
    case 'user_images':
        print_r(ImageController::getUserImages($_POST));
        break;
    case 'change_profile_image':
        print_r(ImageController::changeUserImage($_POST));
        break;
    case 'get_profile_image':
        print_r(ImageController::getProfileImage($_POST));
        break;
    case 'delete_image':
        print_r(ImageController::deleteImage($_POST));
        break;
    default:
        echo 'Hello';
        break;
}
