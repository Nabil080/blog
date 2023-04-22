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
        $articleRepo->insertArticle($article);
        var_dump($article);
    }
}

$articleRepository = new ArticleRepository;
$articles = $articleRepository->getArticles();
?>

<form action="" method="post">

    <select name="article_id">
        <?php foreach($articles as $article){ ?>
            <option value="<?=$article->id?>"><?=$article->name?></option>
        <?php } ?>
    </select>
    <label>Titre de la section</label>
    <input type="text" name="section_title" >
    <label>Texte de la section</label>
    <input type="text" name="section_text">
    <label>Image de la section</label>
    <input type="file" name="section_image">
    <button type ="submit" name="section">submit</button>
</form>

<?php

if(isset($_POST['section'])){
    $section = new Section;
    if($section->createToInsert($_POST)){
        $sectionRepo = new SectionRepository;
        $sectionRepo->insertSection($section);
        var_dump($section);
    }
}


?>


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