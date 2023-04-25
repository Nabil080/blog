<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<?php $articleRepo = new ArticleRepository; $articles = $articleRepo->getArticles();?>
<a href="?action=admin&admin=crud">Accueil</a>

<table class="w-[90%] mx-auto text-center border-2 border-black">
    <div class="w-fit mx-auto text-xl">Articles</div>
        <tr class="mb-4 divide-gray-500 divide-x-2 bg-blue-300 ">
            <th>Titre</th>
            <th>ID</th>
            <th>Date</th>
            <th>Intro</th>
            <th>Quote</th>
            <th>Image</th>
            <th>Categorie</th>
            <th>Tags</th>
        </tr>

        <?php
            foreach ($articles as $article) {
                $tags = [];
                foreach($article->tag as $tag){
                    $tags[] = $tag->name;
                }
                $tags = implode(", ",$tags)?>
            <tr id="<?=$article->id?>" class="space-x-4 divide-gray-500 divide-x-2 <?= isset($color) ? ' ' : 'bg-blue-200'?>">
                        <td><?= $article->name ?></td>
                        <td><?= $article->id ?></td>
                        <td><?= formatDate($article->date)?></td>
                        <td><?= $article->intro ?></td>
                        <td><?= $article->quote ?></td>
                        <td class="flex justify-center"><img width="1000px" src="upload/<?= $article->image ?>"></td>
                        <td><?= $article->category->name ?></td>
                        <td class="relative"><?= $tags?><span class="absolute top-[40%] -right-8"><i onclick="deleteArticle(<?=$article->id?>)"class="cursor-pointer fa-solid fa-trash" style="color:red"></i></span></td>
            </tr>
            <?php $color = isset($color) ? null : 'bg-blue-200' ;}?>
</table>
</body>
</html>

<script>

function deleteArticle(id){
    console.log(JSON.stringify({id: id}));
    const article = document.getElementById(id);

    fetch('?action=admin&admin=delete_article',{
        method: 'POST',
        body: JSON.stringify({id: id})
    })
    .then(response => response.json())
    .then(data => {
        article.style.display = 'none';
    })
}

</script>








<form enctype="multipart/form-data" action="?action=admin&admin=add_article" method="post">

    <label>Nom de l'article</label>
    <input type="text" name="name" placeholder="nom de l'article">
    <label>Intro de l'article</label>
    <textarea rows="6" name="intro" placeholder="intro de l'article"></textarea>
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


<form enctype="multipart/form-data" action="?action=admin&admin=add_section" method="post">
    <?php
    $articleRepository = new ArticleRepository;
    $articles = $articleRepository->getArticles();
    ?>
    <select name="article_id">
        <?php foreach($articles as $article){ ?>
            <option value="<?=$article->id?>"><?=$article->name?></option>
        <?php } ?>
    </select>
    <label>Titre de la section</label>
    <input type="text" name="section_title" >
    <label>Texte de la section</label>
    <textarea rows="6" type="text" name="section_text"></textarea>
    <label>Image de la section</label>
    <input type="file" name="section_image">
    <button type ="submit" name="section">submit</button>
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


