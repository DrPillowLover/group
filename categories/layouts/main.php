<?php $cat_ID = getCat(); ?>
<section class="container mb-4">
    <div class="row">
        <div class="col-xl-3 order-xl-0 order-1 mb-4">


            <!---------------------------------------------Start of Side-Nav--------------------------------------------->


            <!---------------------------------------------Start of Categories--------------------------------------------->

            <div class="card pcountry cati p-3 mb-3">
                <div class="d-flex flex-row justify-content-between bg-light py-2 px-4 my-2 bright radius15">
                    <h2>دسته بندی ها</h2>
                    <a href="#">- بیشتر -</a>
                </div>
                <ul class="list-unstyled">
                    <?php $cats = getCats(); ?>
                    <?php foreach ($cats as $cat) : ?>
                        <li class="d-flex justify-content-between align-items-center">
                            <a href="index.php?category=<?= $cat->id ?>" target="_blank">
                                <img src="<?= http('assets/Img/cati/img_4.jpg') ?> " class="ml-2"/>
                                <span><?= $cat->title ?></span>
                            </a>
                            <span><?= countArticles($cat->id) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!---------------------------------------------End of Categories--------------------------------------------->






            <!---------------------------------------------Start of Last Articles--------------------------------------------->

            <div class="card thumb-post p-3 mb-3">
                <h2 class="bg-light py-2 px-4 mt-2 mb-4 bright radius15">آخرین مطالب</h2>
                <ul class="fa12">
                    <?php $articles = getArticlesForNav(); ?>
                    <?php foreach ($articles as $article) : ?>
                        <li>
                            <!--                        assets/Img/blog-post1.jpg-->
                            <div class="d-flex flex-row">
                                <a href="#"><img src="<?= http('images/') . $article->image ?>"/></a>
                                <div class="m-2">
                                    <p>
                                        <a href="single.php?id=<?= $article->id ?>"><?= $article->title ?></a>
                                    </p>
                                    <span>
                                    <?=
                                    substr($article->created_at, 12, 4) . ' / ' . substr($article->created_at, 8, 4) . ' / ' . substr($article->created_at, 0, 8)
                                    ?>
                                </span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!---------------------------------------------End of Last Articles--------------------------------------------->
        </div>
        <!---------------------------------------------End of Side-Nav--------------------------------------------->


        <div class="col-xl-9  order-xl-1 order-0 mb-4">

            <div class="row">
                <?php $arts = getArticlesByCat(); ?>
                <?php foreach ($arts as $art) : ?>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="card" style="height:430px;">
                            <a href="single.php?id=<?= $art->id ?>">
                                <img class="card-img-top" src="<?= http('images/') . $art->image ?>"
                                     alt="<?= $art->title ?>" style="height: 200px">
                            </a>
                            <div class="card-body">
                                <h2 class="IRANSans_Bold">
                                    <a href="../single.php?id=<?= $art->id ?>"><?= $art->title ?></a>
                                </h2>
                                <span class="text-primary fa12 IRANSans_Medium">
                                    <a href="../single.php?id=<?= $art->id ?>"><?= getCatTitle($art->category_id) ?></a>
                                </span>
                                <p>
                                    <?= limit_words($art->body, 25) . '...' ?>
                                </p>
                                <div class="mt-2 text-center">
                                    <a href="../single.php?id=<?= $art->id ?>" class="card-link text-primary">ادامه
                                        مطلب</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>


            <div class="row mt-3">
                <div class="col-12 text-center mx-auto">
                    <ul class="pagination  justify-content-center">

                        <li class="page-item"><a class="page-link" href="index.php?category=<?= $cat_ID ?>">«</a></li>

                        <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $numberOfTotalPages = numberOfPages();
                        ?>


                        <?php for ($i = 1; $i <= $numberOfTotalPages; $i++) : ?>

                            <?php if ($i > $page + 2 || $i < $page - 2) { ?>
                                <li class="page-item">
                                    <a class="page-link d-none"
                                       href="index.php?category=<?= $cat_ID ?>&page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php } else { ?>

                                <li class="page-item">
                                    <a class="page-link"
                                       href="index.php?category=<?= $cat_ID ?>&page=<?= $i ?>"><?= $i ?></a>
                                </li>

                            <?php } ?>
                        <?php endfor; ?>
                        <li class="page-item"><a class="page-link"
                                                 href="index.php?category=<?= $cat_ID ?>&page=<?= $numberOfTotalPages ?>">»</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>