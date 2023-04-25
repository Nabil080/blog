<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class User{
    public $id;
    public $name;
    public $mail;
    public $password;
    public $image;
    public $token;
    public $active;
    public $role;
    public $description;


    public function createToInsert(array $userPost):bool{

        if(securizeString($userPost['name']) == false){

            return false;
        }else{
            $this->name = securizeString($userPost['name']);
        }

        if(securizeMail($userPost['mail']) == false){

            return false;
        }else{
            $this->mail = securizeMail($userPost['mail']);
        }

        if(securizePassword($userPost['password'],$userPost['confirm_password']) == false){

            return false;
        }else{
            $this->password = securizePassword($userPost['password'],$userPost['confirm_password']);
        }

        $this->token = getRandomToken();
        $this->active = false;
        $this->role = 0;
        $this->image = "base_profil.png";


        return true;
    }

    public function createToModify(array $userPost):bool{


      if(isset($userPost['password'])){
            if(securizePassword($userPost['password'],$userPost['confirm_password'])){

            $this->password = securizePassword($userPost['password'],$userPost['password']);
            }else{

            return false;
            }
     }

        if(isset($userPost['name'])){    
            if(securizeString($userPost['name']) != false){
                $this->name = securizeString($userPost['name']);
            }else{

                return false;
            }
        }

        if(isset($userPost['mail'])){
            if(securizeMail($userPost['mail']) != false){
                $this->mail = securizeMail($userPost['mail']);
            }else{

                return false;
            }
        }

        if(isset($userPost['description'])){
            if(securizeString($userPost['description']) != false){
                $this->description = securizeString($userPost['description']);
            }else{

                return false;
            }
        }

            return true;
    }
}

class UserRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }

    public function getUserByMail(string $mail){
        if(securizeMail($mail) != false){
            $req = $this->bdd->prepare("SELECT * FROM `user` WHERE `user_mail` = ?");
            $req->execute([$mail]);
            $data = $req->fetch();
            // var_dump($data);

            if($data != false){
                $user = new User();
                $user->id = $data['user_id'] ;
                $user->name = $data['user_name'];
                $user->mail = $data['user_mail'];
                $user->password = $data['user_password'];
                $user->image = $data['user_image'];
                $user->token = $data['user_token'];
                $user->active = $data['user_active'];
                $user->role = $data['role_id'];

                return $user;
            }else{

                if(str_contains("signup",$_SERVER['REQUEST_URI'])){
                    $response = array(
                        "status" => "failure",
                        "message" => "E-mail lié a aucun compte"
                    );
                    echo json_encode($response);
                }

                return [];

            }
        }else{
            // $_SESSION['error'] = 'missing_mail';
            $response = array(
                "status" => "failure",
                "message" => "E-mail invalide"
            );
            echo json_encode($response);

            return [];
        }
    }

    public function insertUser(User $user){
        $req = $this->bdd->prepare("INSERT INTO user
            (user_name, user_mail, user_password, user_image, user_token, user_active, role_id) VALUES (?,?,?,?,?,?,?)");
        $req->execute(
            [$user->name, $user->mail, $user->password, $user->image, $user->token, $user->active, $user->role]);

        $response = array(
            "status" => "success",
            "message" => "Un mail pour valider votre compte vous a été envoyé !",
            "activate" => "index.php?action=validate_mail&token=".$user->token
        );

        echo json_encode($response);
    }

    public function deleteUser(User $user){
        $req = $this->bdd->prepare("SELECT * FROM comment WHERE user_id = ?");
        $req->execute([$user->id]);
        $data = $req->fetchAll();
        foreach($data as $key){
            $comment = new Comment;
            $commentRepo = new CommentRepository;
            $comment = $commentRepo->getCommentById($key['comment_id']);
            $commentRepo->deleteComment($comment);
        }

        $req = $this->bdd->prepare("DELETE FROM reply WHERE user_id =?");
        $req->execute([$user->id]);

        $req = $this->bdd->prepare("DELETE FROM user WHERE user_id = ?");
        $req->execute([$user->id]);

        $response = [
            'status' =>'success',
            'message' => 'user supprimé'
        ];

        echo json_encode($response);
    }


    public function getUserByID($id){
        $req = $this->bdd->prepare("SELECT * FROM `user` WHERE `user_id` = ?");
        $req->execute([$id]);
        $data = $req->fetch();
        // var_dump($data);

        if($data != false){
            $user = new User();
            $user->id = $data['user_id'] ;
            $user->name = $data['user_name'];
            $user->mail = $data['user_mail'];
            $user->password = $data['user_password'];
            $user->image = $data['user_image'];
            $user->token = $data['user_token'];
            $user->active = $data['user_active'];
            $user->role = $data['role_id'];
            $user->description = $data['user_description'];

            return $user;
        }else{

            return [];

        }
    }

    public function getUsers(){
        $req = $this->bdd->prepare("SELECT * FROM `user`");
        $req->execute();
        $data = $req->fetchAll();

        $users = [];
        foreach ($data as $key){
            $user = new User();
            $user->id = $key['user_id'] ;
            $user->name = $key['user_name'];
            $user->mail = $key['user_mail'];
            $user->password = $key['user_password'];
            $user->image = $key['user_image'];
            $user->token = $key['user_token'];
            $user->active = $key['user_active'];
            $user->role = $key['role_id'];
            $user->description = $key['user_description'];

            $users[] = $user;
        }

        return $users;
    }

    public function validateMail($token){
        $req = $this->bdd->prepare("UPDATE `user` SET user_active = 1 WHERE `user_token` = ?");
        $req->execute([$token]);
        $req = $this->bdd->prepare("SELECT user_mail FROM user WHERE user_token = ?");
        $req->execute([$token]);
        $req = $this->bdd->prepare("UPDATE user SET user_token = ? WHERE user_token = ?");
        $new_token = getRandomToken();
        $req->execute([$new_token,$token]);

        $mail = $req->fetch();
        header('Location: index.php?action=login&mail='.$mail['user_mail']);
    }

    public function resetPasswordAccess($token){
        $req = $this->bdd->prepare("SELECT * FROM user WHERE user_token = ? ");
        $req->execute([$token]);
        $data = $req->fetch();

        if($data != false){
            $user = new User();
            $user->id = $data['user_id'] ;
            $user->name = $data['user_name'];
            $user->mail = $data['user_mail'];
            $user->password = $data['user_password'];
            $user->image = $data['user_image'];
            $user->token = $data['user_token'];
            $user->active = $data['user_active'];
            $user->role = $data['role_id'];

            return $user;
        }else{

            return false;
        }
    }

    public function changePassword(array $userPost){

        if(securizePassword($userPost['password'],$userPost['confirm_password']) != false){
            $password = securizePassword($userPost['password'],$userPost['confirm_password']);
        }else{

            return false;
        }
        if(!isset($userPost['token'])){
            $_SESSION['error'] = 'missing_token';

            return false;
        }

        if(!isset($_SESSION['error'])){
            $new_token = getRandomToken();
            $req = $this->bdd->prepare("UPDATE `user` SET user_password = ?, user_token = ? WHERE user_token = ?");
            $req->execute([$password,$new_token,$userPost['token']]);

            return true;
        }
    }

    public function updateUser(User $user){

        if($user->name != null){
            $req = $this->bdd->prepare("UPDATE user  SET user_name = ? WHERE user_id = ?");
            $req->execute([$user->name,$_SESSION['user']['id']]);
        }

        if($user->mail != null){
            $req = $this->bdd->prepare("UPDATE user  SET user_mail = ? WHERE user_id = ?");
            $req->execute([$user->mail,$_SESSION['user']['id']]);
        }

        if($user->description != null){
            $req = $this->bdd->prepare("UPDATE user  SET user_description = ? WHERE user_id = ?");
            $req->execute([$user->description,$_SESSION['user']['id']]);
        }

        if($user->password != null){
            $req = $this->bdd->prepare("UPDATE user  SET user_password = ? WHERE user_id = ?");
            $req->execute([$user->password,$_SESSION['user']['id']]);
        }

        if($user->image != null){
            $req = $this->bdd->prepare("UPDATE user  SET user_image = ? WHERE user_id = ?");
            $req->execute([$user->image,$_SESSION['user']['id']]);
        }

        $response = array(
            "status" => "success",
            "message" => "Vos informations ont bien été modifiées !",
        );

        echo json_encode($response);
    }
}

?>