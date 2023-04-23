<?php
    
    if(isset($_GET['action']) && !empty($_GET['action'])){
        if($_GET['action'] != 'admin'){
            switch($_GET['action']){
                case 'logout':
                    logout();
                    break;
                case'profile':
                    profile();
                    break;
                case'blog':
                    blog();
                    break;
                case'blog_article':
                    blogArticle();
                    break;
                case'comment_php':
                    comment();
                    break;
                default:
                    homepage();
                    break;
            }
        }elseif($_SESSION['user']['role'] == 1){
            require('admin.php');
        }else{
            homepage();
        }
    }else{
        homepage();
    }

?>