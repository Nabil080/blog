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

    public function getArticle($articleId){
        
        $article = new Article;
        $req = $this->bdd->prepare("SELECT * FROM article WHERE article_id = ?");
        $req->execute([$articleId]);
        $article_data = $req->fetch();
        
        $article->id = $article_data['article_id'];
        $article->name = $article_data['article_name'];
        $article->date = $article_data['article_date'];
        $article->intro = $article_data['article_intro'];
        $article->quote = $article_data['article_quote'];
        $article->image = $article_data['article_image'];

        $user = new User ();
        $userRepo = new UserRepository;
        $user = $userRepo->getUserByID($article_data['user_id']);
        $article->user = $user;


        $category = new Category();
        $categoryRepo = new CategoryRepository;
        $category = $categoryRepo->getCategoryById($article_data['category_id']);
        $article->category = $category;

        $section = new Section();
        $sectionRepo = new SectionRepository;
        $section = $sectionRepo->getSectionByArticleId($articleId);
        $article->section = $section;


        $comment = new Comment();
        $commentRepo = new CommentRepository;
        $comment = $commentRepo->getCommentByArticleId($articleId);
        $article->comment = $comment;

        
        $tag = new Tag();
        $tagRepo = new TagRepository;
        $tag = $tagRepo->getTagByArticleId($articleId);
        $article->tag = $tag;


        return $article;
    }

    public function getArticles($limitRequest = null){
        $limit = $limitRequest == null ? "" : "LIMIT ".$limitRequest;
        
        $req = $this->bdd->prepare("SELECT * FROM article $limit");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $articles = [];
        foreach($data as $key){
            $article = new Article;
            $articleRepo = new ArticleRepository;
            $article = $articleRepo->getArticle($key['article_id']);

            $articles[]= $article;
        }

        
        return $articles;
    }

    public function getLatestArticles($limit){
        $req = $this->bdd->prepare("SELECT * FROM article ORDER BY article_id DESC LIMIT $limit");
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

            $articles[] = $article;
        }

        return $articles;
    }
}



?>