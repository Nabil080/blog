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
    public $reports;

    public function createToInsert(array $commentForm):bool{

        if(securizeComment($commentForm['comment']) == false){

            return false;
        }else{
            $this->message = securizeComment($commentForm['comment']);
        }

        $this->article = $commentForm['article'];
        $this->user = $commentForm['user'];

        return true;
    }

    public function createToModify(array $commentForm){
        if(securizeComment($commentForm['new_comment']) == false){

            return false;
        }else{
            $this->message = securizeComment($commentForm['new_comment']);
        }
        $this->id = $commentForm['commentId'];

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

    public function reportComment(Comment $comment){
        if(!isset($_SESSION['user']['reports'])){ $_SESSION['user']['reports'] = []; }

        if(in_array($comment->id, $_SESSION['user']['reports'])){
            $response = array(
                "status" => "failure",
                "message" => "Vous avez déjà signalé ce commentaire.",
            );
        }else{
            $req = $this->bdd->prepare("UPDATE comment SET comment_reports = comment_reports + 1 WHERE comment_id = ?");
            $req->execute([$comment->id]);

            $_SESSION['user']['reports'][] = $comment->id;

            $response = array(
                "status" => "success",
                "message" => "Le commentaire a bien été signalé !",
            );
        }


        echo json_encode($response);
    }

    public function deleteComment(Comment $comment){

        if($comment->user->id != $_SESSION['user']['id']){
            $response = array(
                "status" => "failure",
                "message" => "Ta mère aurait honte de toi... !",
            );

            echo json_encode($response);
        }else{
            $req = $this->bdd->prepare("DELETE FROM reply WHERE comment_id = ?");
            $req->execute([$comment->id]);
    
            $req = $this->bdd->prepare("DELETE FROM comment WHERE comment_id = ?");
            $req->execute([$comment->id]);

            $response = array(
                "status" => "success",
                "message" => "Le commentaire a bien été supprimé !",
            );

            echo json_encode($response);
        }

    }

    public function updateComment(array $commentPost, Comment $comment){

        if($comment->user->id != $_SESSION['user']['id']){
            $response = array(
                "status" => "failure",
                "message" => "Ta mère aurait honte de toi... !",
            );

            echo json_encode($response);
        }else{
            $req = $this->bdd->prepare("UPDATE comment SET comment_message = ? WHERE comment_id = ?");
            $req->execute([$commentPost['new_comment'],$comment->id]);
            
            $response = array(
                "status" => "success",
                "message" => "Le commentaire a bien été modifié !",
                "comment" => $commentPost['new_comment'],
            );

        echo json_encode($response);
        }
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

    public function getCommentByID($id){
        $req = $this->bdd->prepare("SELECT * FROM comment WHERE comment_id = ? ");
        $req->execute([$id]);
        $data = $req->fetch();
        // var_dump($data);

        if($data != false){
            $comment = new comment();
            $comment->id = $data['comment_id'] ;
            $comment->date = $data['comment_date'] ;
            $comment->message = $data['comment_message'] ;
            $comment->reports = $data['comment_reports'] ;

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

    public function getComments(){
        $req = $this->bdd->prepare("SELECT * FROM comment ORDER BY comment_reports DESC, comment_id DESC");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $comments = [];
        
        foreach($data as $key){
            $comment = new Comment;
            $comment = $this->getCommentByID($key['comment_id']);
            $comments[] = $comment;
        }

        return $comments;
    }

}

?>