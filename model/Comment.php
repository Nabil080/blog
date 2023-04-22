<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Comment{
    public $id;
    public $date;
    public $message;
    public $article;
    public $user;
    public $reply;
    
    public function createToInsert(array $categoryForm):bool{

        $this->message = $categoryForm['message'];
        $this->article = $categoryForm['article'];
        $this->user = $categoryForm['user'];

        return true;
    }
}

class CommentRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }


}



?>