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

        if(securizeComment($categoryForm['comment']) == false){

            return false;
        }else{
            $this->message = securizeComment($categoryForm['comment']);
        }

        $this->article = $categoryForm['article'];
        $this->user = $categoryForm['user'];

        return true;
    }
}

class CommentRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }

    public function insertComment(Comment $comment){
        $req = $this->bdd->prepare("INSERT INTO comment
            (comment_message, user_id, article_id) VALUES (?,?,?)");
        $req->execute(
            [$comment->message,$comment->user,$comment->article]);

        $user = new User;
        $userRepo = new UserRepository;
        $user = $userRepo->getUserByID($_SESSION['user']['id']);
        $date = date("d M, Y");

        $response = array(
            "status" => "success",
            "message" => "Le commentaire a bien été posté",
            "comment" => $comment->message,
            "date" => $date,
            "image" => "upload/".$user->image,
            "name" => $user->name,
        );

        echo json_encode($response);
    }

    public function getCommentByArticleId($articleId){
        $req = $this->bdd->prepare("SELECT * FROM comment WHERE article_id = ? ORDER BY article_id DESC");
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

    public function getUserComments($userId){
        
        $req = $this->bdd->prepare("SELECT * FROM comment WHERE user_id = ?");
        $req->execute([$userId]);
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $comments = [];

        foreach($data as $comment_data){
            $comment = new Comment;
            $comment->id = $comment_data['comment_id'];
            $comment->date = $comment_data['comment_date'];
            $comment->message = $comment_data['comment_message'];

            $user = new User;
            $userRepo = new UserRepository;
            $user = $userRepo->getUserByID($comment_data['user_id']);
            $comment->user = $user;

            $article = new article;
            $articleRepo = new articleRepository;
            $article = $articleRepo->getArticle($comment_data['article_id']);
            $comment->article = $article;

            $comments[] = $comment;

        }

        return $comments;
    }

    public function getcommentByID($id){
        $req = $this->bdd->prepare("SELECT * FROM comment WHERE comment_id = ? ");
        $req->execute([$id]);
        $data = $req->fetch();
        // var_dump($data);

        if($data != false){
            $comment = new comment();
            $comment->id = $data['comment_id'] ;
            $comment->date = $data['comment_date'] ;
            $comment->message = $data['comment_message'] ;

            $user = new User;
            $userRepo = new UserRepository;
            $user = $userRepo->getUserByID($data['user_id']);
            $comment->user = $user;

            $article = new article;
            $articleRepo = new articleRepository;
            $article = $articleRepo->getArticle($data['article_id']);
            $comment->article = $article;

            return $comment;
        }else{

            return false;

        }
    }

}

?>