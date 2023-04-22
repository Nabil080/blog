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
    <select name="category">
        <option value="1">Catégorie 1</option>
        <option value="1">Catégorie 2</option>
        <option value="1">Catégorie 3</option>
    </select>
    <label>Tags de l'article (Plusieurs possibles)
    <select name="tag" multiple>
        <option value="1">Tag 1</option>
        <option value="2">Tag 2</option>
        <option value="3">Tag 3</option>
    </select>
    <button type="submit" name="submit">submit</button>
</form>

<?php
if(isset($_POST['submit'])){
    $article = new Article;
    if($article->createToInsert($_POST)){
        $articleRepo = new ArticleRepository;
        $articleRepo->insertArticle($article);
    }
}

?>






<?php // include('include/footer.html') ; ?>