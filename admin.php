<?php

    if(isset($_GET['admin']) && !empty($_GET['admin'])){
                switch($_GET['admin']){
                    case 'crud':
                        crud();
                        break;
                    case'crud_article':
                        crudArticle();
                        break;
                    case'delete_article':
                        deleteArticle();
                        break;
                    case'crud_user':
                        crudUser();
                        break;
                    case'delete_user':
                        deleteUser();
                        break;
                    case'add_section':
                        addSection();
                        break;
                    default:
                        homepage();
                        break;
                }
    }else{
        homepage();
    }
?>