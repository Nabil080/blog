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

        $this->name = $articleForm['name'];
        $this->intro = $articleForm['intro'];
        $this->quote = $articleForm['quote'];
        $this->image = $articleForm['image'];
        $this->category = $articleForm['category'];
        $this->user = $_SESSION['user']['id'] ;
        $this->tag = isset($articleForm['tag']) ?  $articleForm['tag'] : null;
        // $this->section = $articleForm['section'];
        
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

        // foreach($article->tag as $key){
        //     $tag = new Tag;
        //     insertArticleTag($key,$this->bdd->lastInsertId())
        // }
        
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
        $article->tag[] = 1;

        $req = $this->bdd->prepare("SELECT * FROM user WHERE user_id = ?");
        $req->execute([$data['user_id']]);
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $key){
            $user = new User;
            $user->id = $key['user_id'];
            $user->name = $key['user_name'];
            $user->image = $key['user_image'];

            $article->user = $user;
        }

        $req = $this->bdd->prepare("SELECT * FROM section WHERE article_id = ?");
        $req->execute([$id]);
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $key){
            $section = new Section;
            $section->id = $key['section_id'];
            $section->title = $key['section_title'];
            $section->body = $key['section_body'];
            $section->image = $key['section_image'];
            $section->article = $key['article_id'];

            $article->section[] = $section;
        }

        return $article;
    }

    public function getArticles(){
        $req = $this->bdd->prepare("SELECT * FROM article");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $articles = [];
        foreach($data as $key){
            $article = new Article;
            $article->id = $key['article_id'];
            $article->name = $key['article_name'];
            $article->date = $key['article_date'];
            $article->intro = $key['article_intro'];
            $article->quote = $key['article_quote'];
            $article->image = $key['article_image'];
            $article->category = $key['category_id'];
            $article->user = $key['user_id'];
            $article->tag[] = 1;


            $req = $this->bdd->prepare("SELECT * FROM section");
            $req->execute([]);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key){
                if($key['article_id'] == $article->id){
                    $section = new Section;
                    $section->id = $key['section_id'];
                    $section->title = $key['section_title'];
                    $section->body = $key['section_body'];
                    $section->image = $key['section_image'];
                    $section->article = $key['article_id'];
                }

                $article->section[] = $section;
            }


            $articles[]= $article;
        }

        return $articles;
    }
}



?>