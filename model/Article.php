<?php
require_once('config/ConnectBdd.php');
require_once('config/functions.php');

class Article{
    public $id;
    public $name;
    public $date;
    public $intro;
    public $quote;
    public $image;
    public $category;
    public $user;
    public $tag;
    public $section;
    public $comment;

    public function createToInsert(array $articleForm):bool{


        $this->id = "";
        $this->name = $articleForm['name'];
        $this->date = "";
        $this->intro = $articleForm['intro'];
        $this->quote = $articleForm['quote'];
        $this->image = $articleForm['image'];
        $this->category = $articleForm['category'];
        $this->user = $_SESSION['user']['id'] ;
        $this->tag = $articleForm['tag'];
        
        return true;
    }
}

class ArticleRepository extends ConnectBdd{
    public function __construct(){
        parent::__construct();
    }

    public function insertArticle(Article $article){
        $req = $this->bdd->prepare("INSERT INTO article
        (article_name,article_intro,article_quote,article_image,category_id,user_id)
        VALUES (?,?,?,?,?,?)");
        $req->execute([$article->name,$article->intro,$article->quote,$article->image,$article->category,$article->user]);
    }

    public function getArticle($id){
        $req = $this->bdd->prepare("SELECT * FROM article WHERE article_id = ?");
        $req->execute([$id]);
        $data = $req->fetch();
        $article = new Article;
        $article->id = $data['article_id'];
        $article->name = $data['article_name'];
        $article->date = $data['article_date'];
        $article->intro = $data['article_intro'];
        $article->quote = $data['article_quote'];
        $article->image = $data['article_image'];
        $article->category = $data['category_id'];
        $article->user = $data['user_id'];

        $req = $this->bdd->prepare("SELECT * FROM article_tag WHERE article_id = ?");
        $req->execute([$id]);
        $data = $req->fetchAll();
        foreach ($data as $key){
            $article->tag[] = $key['tag_id'];
        }

        return $article;
    }
}



?>