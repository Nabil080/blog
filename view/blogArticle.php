<?php include('include/html.html'); ?>

<?php include('include/nav.html'); ?>

<?php 
$articleId = isset($_GET['article']) ? intval($_GET['article']) : 1;
$articleRepo = new ArticleRepository;
$article = $articleRepo->getArticle($articleId);

$words = explode(" ",$article->intro);
$count_words = count($words);
$half_intro = $count_words / 2;
?>

    <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Blog Details</h2>
              <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Blog Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">

            <article class="blog-details">

              <div class="post-img">
                <img src="upload/<?=$article->image?>" alt="" class="img-fluid">
              </div>

              <h2 class="title"><?=$article->name?></h2>

              <div class="meta-top">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html"><?=$article->user->name?></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01"><?=formatDate($article->date)?></time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html"><?=count($article->comment)?> comments</a></li>
                </ul>
              </div><!-- End meta top -->

              <div class="content">
                <p>
                <?php for($i=0;$i<$half_intro;$i++){echo $words[$i]." ";}?>
                </p>
                
                <?php if($article->quote){ ?>
                <blockquote>
                  <p>
                  <?=$article->quote?>
                  </p>
                </blockquote>
                <?php } ?>

                <p>
                <?php for($i=$half_intro;$i<$count_words;$i++){echo $words[$i]." ";} ?>
                </p>

                <?php if($article->section){
                  foreach($article->section as $section){?>
                    <h3><?=$section->title?></h3>
                  <p>
                    <?=$section->body?>
                  </p>
                    <?php if(isset($section->image)){ ?>
                    <img src="upload/<?=$section->image?>" class="img-fluid" alt="">
                  <?php }
                }
                } ?>

              </div><!-- End post content -->

              <div class="meta-bottom">
                <i class="bi bi-folder"></i>
                <ul class="cats">
                  <li><a href="#"><?=$article->category->name?></a></li>
                </ul>

                <i class="bi bi-tags"></i>
                <?php if($article->tag){ ?>
                <ul class="tags">
                  <?php foreach($article->tag as $tag){ ?>
                    <li><a href="#"><?=$tag->name?></a></li>
                  <?php } ?>
                </ul>
                <?php } ?>
              </div><!-- End meta bottom -->

            </article><!-- End blog post -->

            <div class="post-author d-flex align-items-center">
              <img src="upload/<?=$article->user->image?>" class="rounded-circle flex-shrink-0" alt="">
              <div>
                <h4><?=$article->user->name?></h4>
                <div class="social-links">
                  <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                  <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                </div>
                <p>
                  <?=$article->user->description?>
                </p>
              </div>
            </div><!-- End post author -->

            <div id="comments" class="comments">
            <h4 class="comments-count"><?=count($article->comment)?> comments</h4>
            


              <?php foreach($article->comment as $comment){ ?>
                <div id="message_<?=$comment->id?>" style="color:orange"></div>
                <div id="comment_<?=$comment->id?>" class="comment relative" style="transition:display 2000ms">
                <!-- boutons gestion commentaire -->
                  <div style="position:absolute;top:8px;right:8px;display:flex;">
                        <div id="update_<?=$comment->id?>" onclick="updateCom(<?=$comment->id?>)" style="padding-inline:8px;cursor:pointer;"><i class="fa-solid fa-pen-to-square"></i></div>
                        <div id="delete_<?=$comment->id?>" onclick="deleteCom(<?=$comment->id?>)" style="padding-inline:8px;cursor:pointer;"><i class="fa-solid fa-trash"></i></div>
                        <div id="report_<?=$comment->id?>" onclick="reportCom(<?=$comment->id?>)" style="padding-inline:8px;cursor:pointer;"><i class="fa-solid fa-exclamation"></i></div>
                  </div>
                  <div class="d-flex">
                    <div class="comment-img"><img src="upload/<?=$comment->user->image?>" alt=""></div>
                    <div>
                      <h5><a href=""><?=$comment->user->name?></a> <a id="reply_<?=$comment->id?>" onclick="reply('<?=$comment->id?>')" style="cursor:pointer;" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01"><?=formatDate($comment->date)?></time>
                      <p id ="comment_message_<?=$comment->id?>">
                        <?=$comment->message?>
                      </p>
                      <form id="update_message_<?=$comment->id?>" style="display:none">
                        <textarea name="new_comment"></textarea>
                        <input type="text" value="<?=$comment->id?>" name="commentId" style="display:none">
                        <button type="submit">Modifier</button>
                      </form>
                    </div>
                  </div>
                    <form id="replyForm<?=$comment->id?>" style="display:none">
                      <input type="text" name="comment" style="display:none" value="<?=$comment->id?>">
                      <textarea name="reply"></textarea>
                      <button type="submit" name="submit">Répondre</button>
                    </form>
                    <div id="new_reply_<?=$comment->id?>" class="comment comment-reply" style="display:none">
                      <div class="d-flex">
                        <div class="comment-img">
                          <img id="new_image_<?=$comment->id?>" src="" alt="">
                        </div>
                        <div>
                          <h5><a id="new_user_<?=$comment->id?>" href=""><!--pseudo--></a> <a class="reply"><i class="bi bi-reply-fill"></i>Reply</a></h5>
                          <time id="new_date_<?=$comment->id?>" datetime="2020-01-01"><!--date --></time>
                          <p id="new_message_<?=$comment->id?>">
                            <!-- contenu de la réponse -->
                          </p>
                        </div>
                      </div>
                    </div>
                  <?php foreach($comment->reply as $reply){?>
                  <div id="comment_reply_<?=$reply->id?>" class="comment comment-reply">
                  <div class="d-flex">
                    <div class="comment-img"><img src="upload/<?=$reply->user->image?>" alt=""></div>
                    <div>
                      <h5><a href=""><?=$reply->user->name?></a> <a class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01"><?=formatDate($reply->date)?></time>
                      <p>
                      <?=$reply->message?></p>
                    </div>
                  </div>
                  </div><!-- End comment #1 -->
                  <?php } ?>
                </div>
                <?php } ?>
                <div id="new_comments"></div>

              <div class="reply-form">

                <h4>Leave a comment</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <form id="comment-form">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" class="form-control" disabled value="<?=$_SESSION['user']['name']?>"  placeholder="Your Name*">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="text" class="form-control" disabled value="<?=$_SESSION['user']['mail']?>" placeholder="Your Email*">
                    </div>
                    <input style="display:none;" name="article" value="<?=$article->id?>">
                    <input style="display:none;" name="user" value="<?=$_SESSION['user']['id']?>">
                    </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                  </div>
                  <p id="message" style="color:orange;"></p>
                  <button id="sub-com" type="submit" class="btn btn-primary">Post Comment</button>
                </form>

                <script>

                function deleteCom(commentId){
                  console.log(commentId);

                  fetch('?action=delete_com',{
                  method: "POST",
                  // headers: {'Content-Type': 'application/json'},
                  body: JSON.stringify({comment: commentId}),
                })
                .then(function(response) {
                  return response.text();
                })
                .then(function(data) {
                  data = JSON.parse(data);

                  if(data.status === 'success'){
                    const commentDiv = document.getElementById("comment_"+commentId);
                    commentDiv.style.display = "none";
                    const messageDiv = document.getElementById("message_"+commentId);
                    messageDiv.innerText = data.message
                  }
                });
                }

                function updateCom(commentId){
                  const commentDiv = document.getElementById("comment_"+commentId);
                  const commentMessage = document.getElementById("comment_message_"+commentId);
                  const updateForm = document.getElementById("update_message_"+commentId);

                  if(updateForm.style.display == "block"){
                    commentMessage.style.display = "block";
                    updateForm.style.display = "none";
                  }else{
                    commentMessage.style.display = "none";
                    updateForm.style.display = "block";
                  }


                  updateForm.addEventListener("submit", function(event){
                      event.preventDefault();


                      // * TRAITEMENT FETCH
                      const formData = new FormData(updateForm);
                      fetch('?action=update_com',{
                        method: "POST",
                        body: formData,
                      })
                      .then(response => response.json())
                      .then(data => {

                          if(data.status === 'success'){
                            commentMessage.innerText = data.comment;
                            updateForm.style.display = "none";
                            commentMessage.style.display = "block";
                          }
                          
                          const messageDiv = document.getElementById("message_"+commentId);
                          messageDiv.innerText = data.message

                      })
                  })

                }

                function reportCom(commentId){
                console.log(commentId);

                fetch('?action=report_com',{
                  method: "POST",
                  // headers: {'Content-Type': 'application/json'},
                  body: JSON.stringify({comment: commentId}),
                })
                .then(function(response) {
                  return response.text();
                })
                .then(function(data) {
                  data = JSON.parse(data);
                  console.log(data);
                  if(data.status === 'success'){
                    const messageDiv = document.getElementById("message_"+commentId);
                    messageDiv.innerText = data.message
                  }
                });
              }



                function reply(commentId){
                  // console.log(commentId);
                  const replyForm = document.getElementById("replyForm"+commentId);
                  // console.log(replyForm);
                  if(replyForm.style.display == "none"){
                    replyForm.style.display = "block";
                  }else{
                    replyForm.style.display = "none"
                  }

                  replyForm.addEventListener('submit', function(event){
                    event.preventDefault();
                    // * TRAITEMENT AJAX ICI BAS

                    const formData = new FormData(replyForm);
                    fetch('index.php?action=reply_php',{
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                      // * TRAITEMENT AFFICHAGE REPONSE ICI BAS
                      console.log(data);
                      if(data.status === 'success'){

                        const replyDiv = document.querySelector("#new_reply_"+commentId);
                        replyDiv.style.display = "block";
                        const image = document.querySelector("#new_image_"+commentId);
                        image.src = data.image;
                        const name = document.querySelector("#new_user_"+commentId);
                        name.innerHTML = data.name;
                        const message = document.querySelector("#new_message_"+commentId);
                        message.innerHTML = data.comment;
                        const date = document.querySelector("#new_date_"+commentId);
                        date.innerHTML = data.date;
                      }
                    })
                    .catch(error => console.error(error));
                  })

                }

                      // TODO : TRAITEMENT AJAX COMMENTAIRE
                      const myForm = document.querySelector("#comment-form")
                      myForm.addEventListener('submit',function(event){
                        event.preventDefault();

                        const formData = new FormData(myForm);
                        fetch('index.php?action=comment_php',{
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                          const message = document.querySelector('#message');
                          message.innerText = data.message;

                          if(data.status == "success"){
                                  // Get the #comments div
                                  const commentsDiv = document.getElementById("new_comments");

                                  // Create the outer div element
                                  const commentDiv = document.createElement("div");
                                  commentDiv.className = "comment";

                                  // Create the d-flex div element
                                  const dFlexDiv = document.createElement("div");
                                  dFlexDiv.className = "d-flex";

                                  // Create the comment-img div element and its child img element
                                  const commentImgDiv = document.createElement("div");
                                  commentImgDiv.className = "comment-img";
                                  const img = document.createElement("img");
                                  img.src = data.image;
                                  img.alt = "";
                                  commentImgDiv.appendChild(img);

                                  // Create the h5 element and its child a and reply elements
                                  const h5 = document.createElement("h5");
                                  const a1 = document.createElement("a");
                                  a1.href = "";
                                  a1.textContent = data.name;
                                  const a2 = document.createElement("a");
                                  a2.href = "#";
                                  a2.className = "reply";
                                  const i = document.createElement("i");
                                  i.className = "bi bi-reply-fill";
                                  a2.appendChild(i);
                                  a2.appendChild(document.createTextNode(" Reply"));
                                  h5.appendChild(a1);
                                  h5.appendChild(document.createTextNode(" "));
                                  h5.appendChild(a2);


                                  // Create the wrapper div for h5, time, and p elements
                                  const wrapperDiv = document.createElement("div");

                                  // Create the time element
                                  const time = document.createElement("time");
                                  time.dateTime = data.date;
                                  time.textContent = data.date;

                                  // Create the p element and set its text content
                                  const p = document.createElement("p");
                                  p.textContent = data.comment;

                                  // Add the elements to the DOM
                                  commentDiv.appendChild(dFlexDiv);
                                  dFlexDiv.appendChild(commentImgDiv);
                                  dFlexDiv.appendChild(wrapperDiv);
                                    wrapperDiv.appendChild(h5);
                                    wrapperDiv.appendChild(time);
                                    wrapperDiv.appendChild(p);
                                  commentsDiv.parentNode.insertBefore(commentDiv, commentsDiv.nextSibling);
                                  
                                  const submitButton = document.querySelector("#sub-com");
                                  submitButton.disabled = true;
                                }
                        })
                      })



              </script>

              </div>

            </div><!-- End blog comments -->

          </div>

          <div class="col-lg-4">

            <div class="sidebar">

              <div class="sidebar-item search-form">
                <h3 class="sidebar-title">Search</h3>
                <form action="" class="mt-3">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Categories</h3>
                <ul class="mt-3">
                  <?php 
                    $categoriesRepo = new CategoryRepository;
                    $categories = $categoriesRepo->getAllCategories(); 
                    foreach($categories as $category){ $count = $categoriesRepo->countCategoryArticle($category);?>
                  <li><a href="#"><?=$category->name?> <span><?=$count?></span></a></li>
                  <?php } ?>
                </ul>
              </div><!-- End sidebar categories-->

              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Recent Posts</h3>

                <div class="mt-3">
                    <?php  $articles = $articleRepo->getArticles(5); 
                    foreach($articles as $article){?>
                  <div class="post-item">
                    <img src="upload/<?=$article->image?>" alt="" width="80px" height="60px">
                    <div>
                      <h4><a href="?action=blog_article&article=<?=$article->id?>"><?=$article->name?></a></h4>
                      <time datetime="2020-01-01"><?=formatDate($article->date)?></time>
                    </div>
                  </div>
                  <?php } ?>

                </div>

              </div><!-- End sidebar recent posts-->

              <div class="sidebar-item tags">
                <h3 class="sidebar-title">Tags</h3>
                
                <ul class="mt-3">
                <?php 
                  $tagsRepo = new TagRepository;
                  $tags = $tagsRepo->getAllTags(); 
                  foreach($tags as $tag){?>
                  <li>
                    <a href="#"><?=$tag->name?></a>
                  </li>
                  <?php } ?>
                </ul>
              </div><!-- End sidebar tags-->

            </div><!-- End Blog Sidebar -->

          </div>
        </div>

      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

<?php include('include/footer.html'); ?>

