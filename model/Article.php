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
        $req = $this->bdd->prepare("SELECT * FROM article WHERE article_id = ?");
        $req->execute([$articleId]);
        $article_data = $req->fetch();
        $article = new Article;
        $article->id = $article_data['article_id'];
        $article->name = $article_data['article_name'];
        $article->date = $article_data['article_date'];
        $article->intro = $article_data['article_intro'];
        $article->quote = $article_data['article_quote'];
        $article->image = $article_data['article_image'];
        // $article->category = $data['category_id'];
        // $article->tag[] = 1;

        $req = $this->bdd->prepare("SELECT * FROM user WHERE user_id = ?");
        $req->execute([$article_data['user_id']]);
        $user_data = $req->fetch();
        $user = new User;

        $user->id = $user_data['user_id'];
        $user->name = $user_data['user_name'];
        $user->image = $user_data['user_image'];

        $article->user = $user;

        $req = $this->bdd->prepare("SELECT * FROM category WHERE category_id = ?");
        $req->execute([$article_data['category_id']]);
        $category_data = $req->fetch();
        $category = new Category;

        $category->id = $category_data['category_id'];
        $category->name = $category_data['category_name'];

        $article->category = $category;

        $req = $this->bdd->prepare("SELECT * FROM section WHERE article_id = ?");
        $req->execute([$articleId]);
        $section_data = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($section_data as $key){
            $section = new Section;
            $section->id = $key['section_id'];
            $section->title = $key['section_title'];
            $section->body = $key['section_body'];
            $section->image = $key['section_image'];
            $section->article = $key['article_id'];

            $article->section[] = $section;
        }

        $req = $this->bdd->prepare("SELECT * FROM comment WHERE article_id = ?");
        $req->execute([$articleId]);
        $comment_data = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($comment_data as $key){
            $comment = new Comment;
            $comment->id = $key['comment_id'];
            $comment->date = $key['comment_date'];
            $comment->message = $key['comment_message'];
            $comment->article = $key['article_id'];

            $user = new User ();
            $userRepo = new UserRepository;
            $user = $userRepo->getUserByID($key['user_id']);
            $comment->user = $user;

            $reply = new Reply ();
            $replyRepo = new ReplyRepository;
            $reply = $replyRepo->getRepliesByCommentId($comment->id);
            $comment->reply = $reply;


            $article->comment[] = $comment;
        }

        
        $req = $this->bdd->prepare("SELECT tag_id FROM article_tag WHERE article_id = ?");
        $req->execute([$articleId]);
        $article_tags = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($article_tags as $article_tag){
            $req = $this->bdd->prepare("SELECT * FROM tag WHERE tag_id = ?");
            $req->execute([$article_tag['tag_id']]);
            $tag_data = $req->fetch();
            $tag = new Tag;

            $tag->id = $tag_data['tag_id'];
            $tag->name = $tag_data['tag_name'];
            
            $article->tag[] = $tag;
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

                    $article->section[] = $section;
                }
            }

            $req = $this->bdd->prepare("SELECT * FROM user");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key){
                if($key['user_id'] == $article->user){
                    $user = new User;
                    $user->id = $key['user_id'];
                    $user->name = $key['user_name'];
                    $user->image = $key['user_image'];

                    $article->user = $user;
                }
            }


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