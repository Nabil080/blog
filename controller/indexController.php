<?php
require_once('config/functions.php');
require_once('model/Comment.php');
require_once('model/User.php');
function login(){
    require ('view/login.php') ;
}

function signUp(){
    require ('view/signUp.php') ;
}

function signUpTreatment(){
    $user = new User;
    $userRepo = new UserRepository;

    if($user->createToInsert($_POST)){
        $check_existing = $userRepo->getUserByMail($_POST['mail']);
        var_dump($check_existing);
        if($check_existing == []){
            $userRepo->insertUser($user);
            echo 'Un mail pour valider votre compte vous a été envoyé !';
            echo '<a href="?action=validate_mail&token='.$user->token.'">Lien temporaire pour valider le compte </a> ';

            // header('Location: index.php');
        }else{
            // echo 'Email déjà existant';
            $_SESSION['error'] = 'existing_mail';
            header('Location: index.php?action=signup');
        }
    }else{
        // echo 'Elements manquants';
        // session error traité dans "createToInsert()"
        header('Location: index.php?action=signup');
    }
}

function loginTreatment(){
    $userRepo = new UserRepository;
    $user = $userRepo->getUserByMail($_POST['mail']);

    if($user != []){
        if(password_verify($_POST['password'],$user->password)){
            if($user->active == true){
                $_SESSION['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'mail' => $user->mail,
                'role' => $user->role
            ];
            header('Location: index.php');
            }else{
                $_SESSION['error'] = 'activate_account';

                header('Location: index.php?action=login&token='.$user->token);
            }
        
        }else{

            $_SESSION['error'] = 'invalid_password';
            header('Location: index.php?');
        }
    }else{
        // echo 'Email incorrect';
        
        header('Location: index.php?');
    }
}

function validateMail(){
    $userRepo = new UserRepository;
    $userRepo->validateMail($_GET['token']);
}


function resetPassword(){
    if(!isset($_GET['token']) && !isset($_POST['mail'])){
        require('view/resetPassword.php') ;
    }elseif(!isset($_GET['token']) && isset($_POST['mail'])){
        // sendResetPassword($_POST['mail']);
        $userRepo = new UserRepository;
        $user = $userRepo->getUserByMail($_POST['mail']);
        echo'<a href="?action=reset_password&token='.$user->token.'"> LIEN TEMPORAIRE POUR RESET LE MDP </a>';

        echo '<br>Un mail pour réinitialiser votre mot de passe vous a été envoyé !';
        echo '<br><a href="index.php">Se connecter</a>';

    }elseif(isset($_GET['token']) && !isset($_POST['mail'])){
        $userRepo = new UserRepository;
        $checkToken = $userRepo->resetPasswordAccess($_GET['token']);

        // header('Location: index.php');

        if($checkToken != false){
            require('view/changePassword.php') ;
        }
    }
}

function changePassword(){
        $userRepo = new UserRepository;
        $userRepo->changePassword($_POST);

        if($userRepo->changePassword($_POST) == false){
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }else{
            header('Location: index.php');
        }
}

?>