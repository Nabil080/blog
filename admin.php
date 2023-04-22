<?php 

    if(isset($_GET['admin']) && !empty($_GET['admin'])){
                switch($_GET['admin']){
                    case 'add_article':
                        addArticle();
                        break;
                    default:
                        homepage();
                        break;
                }
    }else{
        homepage();
    }
?>