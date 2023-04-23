<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Reply{
    public $id;
    public $date;
    public $message;
    public $comment;
    public $user;
    
    public function createToInsert(array $categoryForm):bool{

        $this->message = $categoryForm['message'];
        $this->comment = $categoryForm['comment'];
        $this->user = $categoryForm['user'];

        return true;
    }
}

class ReplyRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }

    public function getRepliesByCommentId($commentId){
        $req = $this->bdd->prepare("SELECT * FROM reply WHERE comment_id = ?");
        $req->execute([$commentId]);
        $reply_data = $req->fetchAll(PDO::FETCH_ASSOC);
        $replies = [];

        foreach ($reply_data as $key){
            $reply = new Reply;
            $reply->id = $key['reply_id'];
            $reply->date = $key['reply_date'];
            $reply->message = $key['reply_message'];
            $reply->comment = $key['comment_id'];
            $user = new User ();
            $userRepo = new UserRepository;
            $user = $userRepo->getUserByID($key['user_id']);
            $reply->user = $user;

            $replies[] = $reply;
        }
        
        return $replies;
    }


}



?>