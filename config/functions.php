<?php

function getRandomToken():string
{
    $token = uniqid(rand());

    return $token;
}

function securizeString(string $string)
{

    if(!isset($string) OR empty($string) OR strlen($string) < 3){
        if(strlen($string) < 3){
            $response = array(
                "status" => "failure",
                "message" => "Le nom est trop court"
            );
            echo json_encode($response);
        }else{

            $response = array(
                "status" => "failure",
                "message" => "Le nom est invalide"
            );

            echo json_encode($response);
        }
        return false;
    }else{
        $safe_string = filter_var(trim($string), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        return $safe_string;
    }
}

function securizeMail(string $mail)
{
    if(!isset($mail) OR empty($mail) OR !filter_var($mail, FILTER_VALIDATE_EMAIL)){

        $response = array(
            "status" => "failure",
            "message" => "Email invalide"
        );
        echo json_encode($response);
        return false;
    }else{
        $safe_mail = filter_var(trim($mail), FILTER_SANITIZE_EMAIL);

        return $safe_mail;
    }
}
function securizePassword(string $password, string $confirm_password)
{
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{6,}$/';

    if(isset($password) AND preg_match($pattern, $password) && $confirm_password == $password){
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        return $hashed_password;
    }else{
        if($confirm_password != $password){

            $response = array(
                "status" => "failure",
                "message" => "Les mots de passes ne correspondent pas"
            );
            echo json_encode($response);

            return false;
        }

        if(!preg_match($pattern, $password)){

            $response = array(
                "status" => "failure",
                "message" => "Mot de passe invalide ! (Une majuscule, un chiffre et un charactère spécial minimum)"
            );
            echo json_encode($response);

            return false;
        }
    }

}

function securizeImage(array $filesImage){

    if(!empty($filesImage))
        {
        $path = 'upload/';
        $nameFile = $filesImage['name'];
        $typeFile = $filesImage['type'];
        $tmpFile = $filesImage['tmp_name'];
        $errorFile = $filesImage['error'];
        $sizeFile = $filesImage['size'];

        $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
        $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

        $extension = explode('.', $nameFile);

        $max_size =1000000;

        if(in_array($typeFile, $type))
        {
            if(count($extension) <=2 && in_array(strtolower(end($extension)), $extensions))
            {
                if($sizeFile <= $max_size && $errorFile == 0)
                {
                    if(move_uploaded_file($tmpFile, $path.$image = uniqid() . '.' . end($extension)) )
                    {
                        $response = array(
                            "status" => "",
                            "message" => "L'image a bien été upload'"
                        );
                        echo json_encode($response);

                        return $image;
                    }
                    else
                    {
                        $response = array(
                            "status" => "failure",
                            "message" => "Echec de l'upload de l'image"
                        );
                        echo json_encode($response);

                        return false;
                    }
                }
                else
                {
                    $response = array(
                        "status" => "failure",
                        "message" => "Le poids de l'image est trop élevé"
                    );
                    echo json_encode($response);

                    return false;
                }
            }
            else
            {
                $response = array(
                    "status" => "failure",
                    "message" => "Merci d'upload une image !"
                );
                echo json_encode($response);

                return false;
            }
        }
        else
        {
            $response = array(
                "status" => "failure",
                "message" => "Type non autorisé !"
            );
            echo json_encode($response);

            return false;
        }
    }else{

        $response = array(
            "status" => "failure",
            "message" => "Le fichier est vide !"
        );
        echo json_encode($response);

        return false;
    }
        
}

function formatDate($date){
    $DateTime = new DateTime($date);
    $formatted_date = $DateTime->format('d M, Y');

    return $formatted_date;
}

function securizeComment(string $comment)
{

    if(!isset($comment) OR empty($comment) OR strlen($comment) < 3){
        if(strlen($comment) < 3){
            $response = array(
                "status" => "failure",
                "message" => "Le commentaire est trop court"
            );
            echo json_encode($response);
        }else{

            $response = array(
                "status" => "failure",
                "message" => "Le commentaire est invalide !"
            );

            echo json_encode($response);
        }
        return false;
    }else{
        $safe_comment = trim($comment);

        return $safe_comment;
    }
}


// function contactAjax(){
//     /**
//  * Requires the "PHP Email Form" library
// * The "PHP Email Form" library is available only in the pro version of the template
// * The library should be uploaded to: vendor/php-email-form/php-email-form.php
// * For more info and help: https://bootstrapmade.com/php-email-form/
// */

// // Replace contact@example.com with your real receiving email address
// $receiving_email_address = 'contact@example.com';

// if( file_exists($php_email_form = 'assets/vendor/php-email-form/php-email-form.php' )) {
//     include( $php_email_form );
// } else {
//     die( 'Unable to load the "PHP Email Form" Library!');
// }

// $contact = new PHP_Email_Form;
// $contact->ajax = true;

// $contact->to = $receiving_email_address;
// $contact->from_name = $_POST['name'];
// $contact->from_email = $_POST['email'];
// $contact->subject = $_POST['subject'];

// // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
// /*
// $contact->smtp = array(
//     'host' => 'example.com',
//     'username' => 'example',
//     'password' => 'pass',
//     'port' => '587'
// );
// */

// $contact->add_message( $_POST['name'], 'From');
// $contact->add_message( $_POST['email'], 'Email');
// $contact->add_message( $_POST['message'], 'Message', 10);

// echo $contact->send();
// }

?>