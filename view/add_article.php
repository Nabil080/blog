<?php 
// include('include/html.html');
// include('include/nav.html'); 
?>

<form action="" method="post">

    <label>Nom de l'article</label>
    <input type="text" name="name" placeholder="nom de l'article">
    <label>Intro de l'article</label>
    <input type="text" name="intro" placeholder="intro de l'article">
    <label>Citation de l'article</label>
    <input type="text" name="quote">
    <label>Image de l'article</label>
    <input type="file" name="image">
    <label>Catégorie de l'article (un max)
    <select id="dd" name="category">
        <option value="1">Catégorie 1</option>
        <option value="1">Catégorie 2</option>
        <option value="1">Catégorie 3</option>
    </select>
    <label>Tags de l'article (Plusieurs possibles)
    <select id="dd" name="tag[]" multiple>
        <option value="1">Tag 1</option>
        <option value="2">Tag 2</option>
        <option value="3">Tag 3</option>
    </select>
    <button type="submit" name="article">submit</button>

</form>

<?php
if(isset($_POST['article'])){
    $article = new Article;
    if($article->createToInsert($_POST)){
        $articleRepo = new ArticleRepository;
        // $articleRepo->insertArticle($article);
        var_dump($article);
    }
}

// var_dump($_POST);
$articleRepository = new ArticleRepository;
$articles = $articleRepository->getArticles();
var_dump($articles)
?>

<form action="" method="post">
    <select name="article">
        <option value=""></option>
    </select>

</form>

<script>

const multiSelectWithoutCtrl = ( elemSelector ) => {
    let options = [].slice.call(document.querySelectorAll(`${elemSelector} option`));
    options.forEach(function (element) {
        element.addEventListener("mousedown",
            function (e) {
                e.preventDefault();
                element.parentElement.focus();
                this.selected = !this.selected;
                return false;
            }, false );
    });
}
    multiSelectWithoutCtrl('#dd')
    </script>





<?php // include('include/footer.html') ; ?>