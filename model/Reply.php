<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Reply{
    public $id;
    public $date;
    public $message;
    public $comment;
    public $user;
    public $reports;

    public function createToInsert(array $replyForm):bool{

        $this->message = $replyForm['reply'];

        $user = new User;
        $userRepo = new UserRepository;
        $user = $userRepo->getUserById($_SESSION['user']['id']);
        $this->user = $user;

        $comment = new Comment;
        $commentRepo = new CommentRepository;
        $comment = $commentRepo->getCommentById($replyForm['comment']);
        $this->comment = $comment;


        return true;
    }
}

class ReplyRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }

    public function insertReply(Reply $reply){
        $req = $this->bdd->prepare("INSERT INTO reply
        (reply_message, user_id, comment_id) VALUES (?,?,?)");
        $req->execute(
            [$reply->message,$reply->user->id,$reply->comment->id]);

        $user = new User;
        $userRepo = new UserRepository;
        $user = $userRepo->getUserByID($_SESSION['user']['id']);
        $date = date("d M, Y");

        $response = array(
            "status" => "success",
            "message" => "La réponse a bien été postée",
            "comment" => $reply->message,
            "date" => $date,
            "image" => "upload/".$user->image,
            "name" => $user->name,
        );

        echo json_encode($response);
    }

    public function deleteReply(Reply $reply){

        if($reply->user->id != $_SESSION['user']['id'] AND $_SESSION['user']['role'] != 1){
            $response = array(
                "status" => "failure",
                "message" => "Ta mère aurait honte de toi... !",
            );

        }elseif($_SESSION['user']['role'] == 1 OR $_SESSION['user']['id'] == $reply->user->id){
            $req = $this->bdd->prepare("DELETE FROM reply WHERE reply_id = ?");
            $req->execute([$reply->id]);

            $response = array(
                "status" => "success",
                "message" => "La réponse a bien été supprimée",
            );
        }

        echo json_encode($response);
    }

    public function reportReply(Reply $reply){
        if(!isset($_SESSION['user']['reports'])){ $_SESSION['user']['reports'] = []; }

        if(in_array($reply->id, $_SESSION['user']['reports'])){
            $response = array(
                "status" => "failure",
                "message" => "Vous avez déjà signalé cette réponse.",
            );
        }else{
            $req = $this->bdd->prepare("UPDATE reply SET reply_reports = reply_reports + 1 WHERE reply_id = ?");
            $req->execute([$reply->id]);

            $_SESSION['user']['reports'][] = $reply->id;

            $response = array(
                "status" => "success",
                "message" => "La réponse a bien été signalé !",
            );
        }


        echo json_encode($response);
    }

    public function getReplyByID($id){
        $req = $this->bdd->prepare("SELECT * FROM reply WHERE reply_id = ? ");
        $req->execute([$id]);
        $data = $req->fetch();
        // var_dump($data);

        if($data != false){
            $reply = new reply();
            $reply->id = $data['reply_id'] ;
            $reply->date = $data['reply_date'] ;
            $reply->message = $data['reply_message'] ;
            $reply->reports = $data['reply_reports'] ;

            $user = new User;
            $userRepo = new UserRepository;
            $user = $userRepo->getUserByID($data['user_id']);
            $reply->user = $user;

            $comment = new comment;
            $commentRepo = new commentRepository;
            $comment = $commentRepo->getCommentById($data['comment_id']);
            $reply->comment = $comment;

            return $reply;
        }else{

            return false;

        }
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