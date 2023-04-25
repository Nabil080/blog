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
<?php $commentRepo = new CommentRepository; $comments = $commentRepo->getComments();?>
<a href="?action=admin&admin=crud">Accueil</a>

<table class="w-[80%] mx-[10%] text-center border-2 border-black">
    <div class="w-fit mx-auto text-xl">Commentaires</div>
        <tr class="mb-4 divide-gray-500 divide-x-2 bg-blue-300 ">
            <th>ID</th>
            <th>Date</th>
            <th>Comment</th>
            <th>Article</th>
            <th>Utilisateur</th>
            <th>Signalements</th>
        </tr>

        <?php
            foreach ($comments as $comment) { isset($color) ? ' ' : 'bg-blue-200' ?>
            <tr id="<?=$comment->id?>" class="space-x-4 divide-gray-500 divide-x-2 <?= isset($color) ? ' ' : 'bg-blue-200'?>">
                        <td><?= $comment->id ?></td>
                        <td><?= $comment->date ?></td>
                        <td><?= $comment->message ?></td>
                        <td><?= $comment->article->id ?></td>
                        <td><?= $comment->user->id ?></td>
                        <td class="relative"><?= $comment->reports ?><span class="absolute top-[10%] -right-8"><i onclick="deleteComment(<?=$comment->id?>)"class="cursor-pointer fa-solid fa-trash" style="color:red"></i></span></td>
            </tr>
            <?php $color = isset($color) ? null : 'bg-blue-200' ;}?>
</table>

<script>

function deleteComment(id){
    console.log(JSON.stringify({id: id}));
    const Comment = document.getElementById(id);

    fetch('?action=admin&admin=delete_comment',{
        method: 'POST',
        body: JSON.stringify({id: id})
    })
    .then(response => response.json())
    .then(data => {
        Comment.style.display = 'none';
    })
}

</script>


</body>
</html>