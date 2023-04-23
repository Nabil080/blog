<?php

function logout(){
    session_destroy();
    login();
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
    echo json_encode($_POST);
}

?>