<?php include('include/html.html'); ?>

<?php include ('include/nav.html');?>

<?php 
$userId = $_SESSION['user']['id'];
$userRepo = new UserRepository;
$user = $userRepo->getUserById($userId);
$role = $user->role != 1 ? "Utilisateur" : "Administrateur";

$articleRepo = new ArticleRepository; 
$articles = $articleRepo->getUserArticles($_SESSION['user']['id']); 
?>

<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="assets/img/blog/base_profile.png"
                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
              <h5><?=$user->name?></h5>
              <p><?=$role?></p>
              <i style="cursor:pointer" class="far fa-edit mb-5" onclick="switchToForm()"></i>
            </div>
            <div class="col-md-8">
            <form id="modifyForm">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?=$user->mail?></p>
                    <input style="display:none" type="email" name="mail" value="<?=$user->mail?>">
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Pseudo</h6>
                    <p id="user-name" class="text-muted"><?=$user->name?></p>
                    <input style="display:none" type="text" name="name" value="<?=$user->name?>">
                  </div>


<div class="col-6 mb-3">
                    <h6>Mot de passe</h6>
                    <p id="user-password" class="text-muted">******></p>
                    <input style="display:none" type="password" name="password" value="">
                  </div>


                </div>
                <h6>Informations rédacteur</h6>
                <hr class="mt-0 mb-4">
                <div class="">
                    <h6>Description</h6>
                    <p class="text-muted"><?=$user->description?></p>
                    <input style="display:none" type="text" name="description" value="<?=$user->description?>">
                    <button style="display:none" type="submit" name="submit">Modifier</button>
                </div>
                <div id="error-message" style="display:none;color:orange;"></div>
                <div class="">
                    <h6>Articles postés</h6>
                    <div class="mt-3">
                    <?php foreach($articles as $article){?>
                  <div class="post-item">
                    <img src="assets/img/blog/<?=$article->image?>" alt="" width="50px">
                    <div>
                      <h5><a href="?action=blog_article&article=<?=$article->id?>"><?=$article->name?></a></h5>
                      <time datetime="2020-01-01"><?=formatDate($article->date)?></time>
                    </div>
                  </div>
                  <?php } ?>
                    </div>
                </div>
                <!-- <div class="d-flex justify-content-start">
                  <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                </div> -->
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>

const myForm = document.querySelector("#modifyForm");
const formText = myForm.querySelectorAll("p");
const formInputs = myForm.querySelectorAll("input");
const formButton = myForm.querySelector("button");

myForm.addEventListener("submit", function(event){
    event.preventDefault();

    const formData = new FormData(myForm);
    fetch('index.php?action=profile_php',{
        method:'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        switchToForm();
        const errorMessage = myForm.querySelector("#error-message");
        errorMessage.style.display = "block";
        errorMessage.innerText = data.message ;
        console.log("salut");
        console.log(data);
    })
    .catch(error => console.error(error));
});




function switchToForm(){

    for (let i = 0; i < formText.length; i++) {
        if (formText[i].style.display === "none") {
        formText[i].style.display = "block";
        } else {
        formText[i].style.display = "none";
        }
    }

    for (let i = 0; i < formInputs.length; i++) {
        if (formInputs[i].style.display === "none") {
        formInputs[i].style.display = "block";
        } else {
        formInputs[i].style.display = "none";
        }
    }

    if(formButton.style.display === "none"){
        formButton.style.display = "block";
    }else{
        formButton.style.display = "none";
    }
}

</script>


<?php include('include/footer.html');?>