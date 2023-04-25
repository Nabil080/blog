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


        if(securizeString($articleForm['name']) == false){

            return false;
        }else{
            $this->name = securizeString($articleForm['name']);
        }

        if(securizeString($articleForm['intro']) == false){

            return false;
        }else{
            $this->intro = securizeString($articleForm['intro']);
        }

        $this->image = securizeImage($_FILES['image']);
        if($this->image == false){
        //    message d'erreurs dans securizeImage

            return false;
        }
        
        if(securizeString($articleForm['quote']) == false){
            $this->quote = securizeString($articleForm['quote']);
            
        }
        
        
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

    public function deleteArticle(Article $article){
        $req = $this->bdd->prepare("DELETE FROM section WHERE article_id = ?");
        $req->execute([$article->id]);

        $req = $this->bdd->prepare("SELECT * FROM comment WHERE article_id = ?");
        $req->execute([$article->id]);
        $data = $req->fetchAll();
        foreach($data as $key){
            $comment = new Comment;
            $commentRepo = new CommentRepository;
            $comment = $commentRepo->getCommentById($key['comment_id']);
            $commentRepo->deleteComment($comment);
        }

        $req = $this->bdd->prepare("DELETE FROM article WHERE article_id = ?");
        $req->execute([$article->id]);

        $response = [
            'status' =>'success',
            'message' => 'Article supprimé'
        ];

        echo json_encode($response);
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

        $req = $this->bdd->prepare("SELECT * FROM article ORDER BY article_id DESC $limit ");
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

    public function getUserArticles($userId){

        $req = $this->bdd->prepare("SELECT * FROM article WHERE user_id = ? ORDER BY article_id");
        $req->execute([$userId]);
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

}



?>