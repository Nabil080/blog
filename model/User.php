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


    public function createToInsert(array $userPost):bool{

        var_dump($userPost);
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

                $response = array(
                    "status" => "failure",
                    "message" => "E-mail lié a aucun compte"
                );
                echo json_encode($response);

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
            (user_name, user_mail, user_password, user_image, user_token, user_active, role_id)
        VALUES
            (?,?,?,?,?,?,?)");
        $req->execute(
            [$user->name, $user->mail, $user->password, $user->image, $user->token, $user->active, $user->role]);

    // send mail to $user->mail, "Vérifiez votre compte: "http://localhost/sltromain/index.php?action=validate_mail&token=".<?= $user->token? >"
    }

    public function getUserByID(string $id){
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

            return $user;
        }else{

            return [];

        }
    }

    public function validateMail($token){
        $req = $this->bdd->prepare("UPDATE `user` SET user_active = 1 WHERE `user_token` = ?");
        $req->execute([$token]);
        header('Location: index.php');
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
            $req = $this->bdd->prepare("UPDATE `user` SET user_password = ? WHERE user_token = ?");
            $req->execute([$password, $userPost['token']]);

            return true;
        }
    }
}

?>