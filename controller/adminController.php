<?php

function crud(){
    require('view/crud/index.php');
}

function crudArticle(){
    require('view/crud/article.php');
}

function deleteArticle(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if($_SESSION['user']['role'] == 1){
        $article = new Article();
        $articleRepo = new ArticleRepository;
        $article = $articleRepo->getArticle($data['id']);
        $articleRepo->deleteArticle($article);
    }
}

function crudUser(){
    require('view/crud/user.php');
}

function deleteUser(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if($_SESSION['user']['role'] == 1){
        $user = new User;
        $userRepo = new UserRepository;
        $user = $userRepo->getUserById($data['id']);
        $userRepo->deleteUser($user);
    }
}

function addArticle(){
    if(isset($_POST)){
        $article = new Article;
        if($article->createToInsert($_POST)){
            $articleRepo = new ArticleRepository;
            $articleRepo->insertArticle($article);
        }
    }
}

function addSection(){
    if(isset($_POST['section'])){
        $section = new Section;
        var_dump($_POST);
        if($section->createToInsert($_POST)){
            $sectionRepo = new SectionRepository;
            $sectionRepo->insertSection($section);
            var_dump($section);
        }
    }
}


?>