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