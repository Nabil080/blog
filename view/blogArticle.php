<?php include('include/html.html'); ?>

<?php include('include/nav.html'); ?>

<?php 
$articleRepo = new ArticleRepository;
$article = $articleRepo->getArticle(2);
// var_dump($article);

// $count_intro = str_word_count($article->intro);
// var_dump($count_intro);
// $split_intro = str_split($article->intro,$count_intro / 2);
// var_dump($split_intro);
// TODO: REFLEXIVITE SPLIT
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
                <img src="assets/img/blog/<?=$article->image?>" alt="" class="img-fluid">
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
                
                <?php if(isset($article->quote)){ ?>
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
                    <img src="assets/img/blog/<?=$section->image?>" class="img-fluid" alt="">
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
              <?php if (isset($article->user->image)){ ?>
              <img src="assets/img/blog/<?=$article->user->image?>" class="rounded-circle flex-shrink-0" alt="">
              <?php }else{ ?>
              <img src="https://www.civictheatre.ie/wp-content/uploads/2016/05/blank-profile-picture-973460_960_720.png" class="rounded-circle flex-shrink-0" alt="">
                <?php } ?>
              <div>
                <h4><?=$article->user->name?></h4>
                <div class="social-links">
                  <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                  <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                </div>
                <p>
                  description de l'utilisateur
                </p>
              </div>
            </div><!-- End post author -->

            <div class="comments">

              <h4 class="comments-count"><?=count($article->comment)?> comments</h4>
              <?php foreach($article->comment as $comment){ ?>
                <div id="comment-<?=$comment->id?>" class="comment">
                  <div class="d-flex">
                    <?php if(isset($comment->user->image)){ ?>
                    <div class="comment-img"><img src="assets/img/blog/<?=$comment->user->image?>" alt=""></div>
                    <?php }else{?>
                      <div class="comment-img"><img src="https://www.civictheatre.ie/wp-content/uploads/2016/05/blank-profile-picture-973460_960_720.png" alt=""></div>
                    <?php } ?>
                    <div>
                      <h5><a href=""><?=$comment->user->name?></a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01"><?=formatDate($comment->date)?></time>
                      <p>
                        <?=$comment->message?>
                      </p>
                    </div>
                  </div>
                      
                  <?php foreach($comment->reply as $reply){?>
                  <div id="comment-reply-<?=$reply->id?>" class="comment comment-reply">
                  <div class="d-flex">
                  <?php if(isset($reply->user->image)){ ?>
                    <div class="comment-img"><img src="assets/img/blog/<?=$reply->user->image?>" alt=""></div>
                    <?php }else{?>
                      <div class="comment-img"><img src="https://www.civictheatre.ie/wp-content/uploads/2016/05/blank-profile-picture-973460_960_720.png" alt=""></div>
                    <?php } ?>
                    <div>
                      <h5><a href=""><?=$reply->user->name?></a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01"><?=formatDate($reply->date)?></time>
                      <p>
                      <?=$reply->message?>
                        </p>
                    </div>
                  </div>
                  </div><!-- End comment #1 -->
                  <?php } ?>
                </div>
                <?php } ?>


              <div class="reply-form">

                <h4>Leave a Reply</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <form action="">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" class="form-control" disabled value="<?=$_SESSION['user']['name']?>"  placeholder="Your Name*">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="text" class="form-control" disabled value="<?=$_SESSION['user']['mail']?>" placeholder="Your Email*">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>

                </form>

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
                    <?php  $articles = $articleRepo->getLatestArticles(5); 
                    foreach($articles as $article){?>
                  <div class="post-item">
                    <img src="assets/img/blog/<?=$article->image?>" alt="">
                    <div>
                      <h4><a href="blog-details.html"><?=$article->name?></a></h4>
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

