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

function comment(){
    $comment = new Comment;
    $commentRepo = new CommentRepository;
    if($comment->createToInsert($_POST)){
        $commentRepo->insertComment ($comment);
    }else{
        // traitement messade d'erreur dans la fonction insertComment
    }
}

function reply(){
    $reply = new Reply;
    $replyRepo = new ReplyRepository;
    if($reply->createToInsert($_POST)){
        $replyRepo->insertReply($reply);
    }else{
        var_dump('erreur');
    }
}

function report(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $comment = new Comment;
    $commentRepo = new CommentRepository;
    $comment = $commentRepo->getCommentById($data['comment']);
    $commentRepo->reportComment($comment);

}

function delete(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $comment = new Comment;
    $commentRepo = new CommentRepository;
    $comment = $commentRepo->getCommentById($data['comment']);
    $commentRepo->deleteComment($comment);

}

function update(){
    $commentRepo = new CommentRepository;
    $comment = new Comment;
    if($comment->createToModify($_POST)){
        $commentRepo->updateComment($_POST);
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