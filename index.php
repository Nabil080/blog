<?php
session_start();
require_once('controller/indexController.php');
require_once('controller/userController.php');
require_once('controller/adminController.php');

// var_dump($_SESSION);
// $_SESSION['slt'] = 0;

if(!isset($_SESSION['user'])){
    if(isset($_GET['action'])){
        switch($_GET['action']){
            case'signup':
                signUp();
                break;
            case'signup_php':
                signUpTreatment();
                break;
            case'validate_mail':
                validateMail();
                break;
            case'reset_password':
                resetPassword();
                break;
            case'change_password':
                changePassword();
                break;
            default:
            login();
            break;
            case'login_php':
                loginTreatment();
                break;
            }
    }else{
        login();
    }
}elseif($_SESSION['user']['role'] != 1){
    require('user.php');
}else{
    require('admin.php');
}


?>