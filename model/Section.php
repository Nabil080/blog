<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Section{
    public $id;
    public $title;
    public $body;
    public $image;
    public $article;

    public function createToInsert(array $sectionForm):bool{

        $this->title = $sectionForm['section_title'];
        $this->body = $sectionForm['section_text'];
        $this->image = $sectionForm['section_image'];
        $this->article = $sectionForm['article_id'];

        return true;
    }
}

class SectionRepository extends ConnectBdd{
    
    public function __construct(){
        parent::__construct();
    }

    public function insertSection(Section $section){
        $req = $this->bdd->prepare("INSERT INTO section
        (section_title,section_body,section_image,article_id)
        VALUES (?,?,?,?)");
        $req->execute([$section->title,$section->body,$section->image,$section->article]);
    }
}





?>