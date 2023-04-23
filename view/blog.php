<?php include('include/html.html'); ?>

<?php include('include/nav.html'); ?>

<?php 
$pageNumber= isset($_GET['page']) ? intval($_GET['page']) : 1 ;
$limit = 6;
$initialPage = ($pageNumber-1)*$limit;
$limitRequest = $initialPage.",".$limit;

$articleRepository = new ArticleRepository;
$articlesCount = $articleRepository->getArticles();

$pageCount = ceil(count($articlesCount)/$limit);

$articles = $articleRepository->getArticles($limitRequest);
// var_dump($articles);

?>
    <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Blog</h2>
              <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Blog</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 posts-list">
        <?php foreach($articles as $article){?>
          <div class="col-xl-4 col-md-6">
            <article>

              <div class="post-img">
                <img src="upload/<?=$article->image?>" alt="" class="img-fluid">
              </div>

              <p class="post-category"><?=$article->category->name?></p>

              <h2 class="title">
                <a href="?action=blog_article&article=<?=$article->id?>"><?=$article->name?></a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="upload/<?=$article->user->image?>" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author-list"><?=$article->user->name?></p>
                  <p class="post-date">
                    <time datetime="2022-01-01"><?=formatDate($article->date)?></time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->
        <?php } ?>
        </div><!-- End blog posts list -->

        <div class="blog-pagination">
          <ul class="justify-content-center">
            <?php for($i=1;$i<=$pageCount;$i++){ ?>
              <li class="<?php echo $i == $pageNumber ? " active " : " "; ?>"><a href="?action=blog&page=<?=$i?>"><?=$i?></a></li>
              <?php } ?>
          </ul>
        </div><!-- End blog pagination -->

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include('include/footer.html') ; ?>

