<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Category{
    public $id;
    public $name;
    
    public function createToInsert(array $categoryForm):bool{

        $this->name = $categoryForm['name'];

        return true;
    }
}

class CategoryRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }

    public function getAllCategories(){
        $req = $this->bdd->prepare("SELECT * FROM category");
        $req->execute();
        $data_categories = $req->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];

        foreach($data_categories as $data_category){
            $category = new Category;
            $category->id = $data_category['category_id'];
            $category->name = $data_category['category_name'];

            $categories[] = $category;
        }

        return $categories;
    }

    public function countCategoryArticle(Category $category){
        $req = $this->bdd->prepare("SELECT * FROM article WHERE category_id = ?");
        $req->execute([$category->id]);
        $data_article = $req->fetchAll(PDO::FETCH_ASSOC);

        $categoryArticleCount = count($data_article);

        return $categoryArticleCount;
    }
}



?>