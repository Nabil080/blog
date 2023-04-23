<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Tag{
    public $id;
    public $name;
    
    public function createToInsert(array $categoryForm):bool{

        $this->name = $categoryForm['name'];

        return true;
    }
}

class TagRepository extends ConnectBdd{

    public function __construct(){
        parent::__construct();
    }


    public function getTagByArticleId($articleId){
        $req = $this->bdd->prepare("SELECT tag_id FROM article_tag WHERE article_id = ?");
        $req->execute([$articleId]);
        $article_tags = $req->fetchAll(PDO::FETCH_ASSOC);

        $tags = [];
        foreach($article_tags as $article_tag){
            $req = $this->bdd->prepare("SELECT * FROM tag WHERE tag_id = ?");
            $req->execute([$article_tag['tag_id']]);
            $tag_data = $req->fetch();
            $tag = new Tag;

            $tag->id = $tag_data['tag_id'];
            $tag->name = $tag_data['tag_name'];
            
            $tags[] = $tag;
        }

        return $tags;
    }


    public function getAllTags(){
        $req = $this->bdd->prepare("SELECT * FROM tag");
        $req->execute();
        $data_tags = $req->fetchAll(PDO::FETCH_ASSOC);
        $tags = [];

        foreach($data_tags as $data_tag){
            $tag = new tag;
            $tag->id = $data_tag['tag_id'];
            $tag->name = $data_tag['tag_name'];

            $tags[] = $tag;
        }

        return $tags;
    }


}





?>