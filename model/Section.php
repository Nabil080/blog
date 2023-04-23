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

    public function getSectionByArticleId($articleId){
        $req = $this->bdd->prepare("SELECT * FROM section WHERE article_id = ?");
        $req->execute([$articleId]);
        $section_data = $req->fetchAll(PDO::FETCH_ASSOC);

        $sections = [];
        foreach ($section_data as $key){
            $section = new Section;
            $section->id = $key['section_id'];
            $section->title = $key['section_title'];
            $section->body = $key['section_body'];
            $section->image = $key['section_image'];
            $section->article = $key['article_id'];

            $sections[] = $section;            
        }

        return $sections;
    }

    public function insertSection(Section $section){
        $req = $this->bdd->prepare("INSERT INTO section
        (section_title,section_body,section_image,article_id)
        VALUES (?,?,?,?)");
        $req->execute([$section->title,$section->body,$section->image,$section->article]);
    }
}





?>