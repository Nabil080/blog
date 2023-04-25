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
<?php $userRepo = new UserRepository; $users = $userRepo->getUsers();?>

<table class="w-[80%] mx-[10%] text-center border-2 border-black">
    <div class="w-fit mx-auto text-xl">Utilisateurs</div>
        <tr class="mb-4 divide-gray-500 divide-x-2 bg-blue-300 ">
            <th>Utilisateur</th>
            <th>ID</th>
            <th>Mail</th>
            <th>Etat</th>
            <th>Image</th>
            <th>Description</th>
        </tr>

        <?php
            foreach ($users as $user) { isset($color) ? ' ' : 'bg-blue-200' ?>
            <tr id="<?=$user->id?>" class="space-x-4 divide-gray-500 divide-x-2 <?= isset($color) ? ' ' : 'bg-blue-200'?>">
                        <td><?= $user->name ?></td>
                        <td><?= $user->id ?></td>
                        <td><?= $user->mail?></td>
                        <td><?= $user->active ?></td>
                        <td class="flex justify-center"><img width="60px" src="upload/<?= $user->image ?>"></td>
                        <td class="relative"><?= $user->description ?><span class="absolute top-[40%] -right-8"><i onclick="deleteUser(<?=$user->id?>)"class="cursor-pointer fa-solid fa-trash" style="color:red"></i></span></td>
            </tr>
            <?php $color = isset($color) ? null : 'bg-blue-200' ;}?>
</table>

<script>

function deleteUser(id){
    console.log(JSON.stringify({id: id}));
    const user = document.getElementById(id);

    fetch('?action=admin&admin=delete_user',{
        method: 'POST',
        body: JSON.stringify({id: id})
    })
    .then(response => response.json())
    .then(data => {
        user.style.display = 'none';
    })
}

</script>


</body>
</html>