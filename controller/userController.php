<?php

function logout(){
    session_destroy();
    login();
}

function profile(){
    require ('view/profile.php') ;
}

function homepage(){
    require ('view/homepage.php') ;
}

function blog(){
    require ('view/blog.php') ;
}

function blogArticle(){
    require ('view/blogArticle.php') ;
}

function Comment(){

    $comment = new Comment;
    $commentRepo = new CommentRepository;
    if($comment->createToInsert($_POST)){
        $commentRepo->insertComment ($comment);
    }else{
        // traitement messade d'erreur dans la fonction insertComment
    }
}

function profileTreatment(){
    $user = new User;
    $userRepo = new UserRepository;

    if($user->createToModify($_POST)){
        $userRepo->updateUser($user);
    }else{
        // message d'erreur dans createToModify
    }
}

function userImageTreatment(){
    $user = new User;
    $userRepo = new UserRepository;
    $user = $userRepo->getUserByID($_SESSION['user']['id']);
    
        $user->image = securizeImage($_FILES['image']);
        if($user->image != false){
            $userRepo->updateUser($user);
        }else{
            // message d'erreurs dans securizeImage
        }

}

?>