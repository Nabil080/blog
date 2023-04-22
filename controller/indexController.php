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
        if($check_existing == []){
            $userRepo->insertUser($user);
            // traitement message de succès dans insertUser
        }else{
            $response = array(
                "status" => "failure",
                "message" => "Cet email est déjà utilisé !",
                "connect" => "index.php?action=login&mail=".$_POST['mail']
            );

            echo json_encode($response);
        }
    }else{
        // traitement des erreurs présent dans createToInsert (dans les fonctions)
    }
}

function loginTreatment(){
    $userRepo = new UserRepository;
    // $postData = json_decode(file_get_contents("php://input"), true);
    // var_dump($postData);
    // var_dump($_POST);
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
            // header('Location: index.php');
            $response = array(
                "status" => "success",
                "message" => "Succès"
            );
            
            echo json_encode($response);
            }else{
                // $_SESSION['error'] = 'activate_account';

                $response = array(
                    "status" => "failure",
                    "message" => "Le compte n'est pas activé !",
                    "activate" => "index.php?action=validate_mail&token=".$user->token
                );

                echo json_encode($response);
                // header('Location: index.php?action=login&token='.$user->token);
            }
        
        }else{
            $response = array(
                "status" => "failure",
                "message" => "Mot de passe invalide ! (Une majuscule, un chiffre et un charactère spécial minimum)"
            );
            
            echo json_encode($response);
            // $_SESSION['error'] = 'invalid_password';
            // header('Location: index.php?');
        }
    }else{
        // gestion erreurs mail traité dans getUserMail()
        // header('Location: index.php?');
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