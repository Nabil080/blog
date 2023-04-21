<?php
    if(isset($_GET['action']) && !empty($_GET['action'])){
        switch($_GET['action']){
            case 'login':
                login();
                break;
            case 'logout':
                logout();
                break;
            case'signup':
                signUp();
                break;
            case'blog':
                blog();
                break;
            case'blogArticle':
                blogArticle();
                break;
            default:
                homepage();
                break;
        }
    }else{
        homepage();
    }
?>