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

    public function getCommentByArticleId($articleId){
        $req = $this->bdd->prepare("SELECT * FROM comment WHERE article_id = ?");
        $req->execute([$articleId]);
        $comment_data = $req->fetchAll(PDO::FETCH_ASSOC);

        $comments = [];
        foreach ($comment_data as $key){
            $comment = new Comment;
            $comment->id = $key['comment_id'];
            $comment->date = $key['comment_date'];
            $comment->message = $key['comment_message'];
            $comment->article = $key['article_id'];

            $user = new User ();
            $userRepo = new UserRepository;
            $user = $userRepo->getUserByID($key['user_id']);
            $comment->user = $user;

            $reply = new Reply ();
            $replyRepo = new ReplyRepository;
            $reply = $replyRepo->getRepliesByCommentId($comment->id);
            $comment->reply = $reply;

            $comments[] = $comment;
        }

        return $comments;
    }

}



?>