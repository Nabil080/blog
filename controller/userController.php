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

?>