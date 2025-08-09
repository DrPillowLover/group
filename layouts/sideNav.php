<section class="container mb-4">
    <div class="row">
        <!-------------------------------------------------Start Of Side-Nav------------------------------------------------->

        <!-------------------------------------------------Start Of Categories------------------------------------------------->
        <div class="col-xl-3 order-xl-0 order-1 mb-4">
            <div class="card pcountry cati p-3 mb-3">
                <div class="d-flex flex-row justify-content-between bg-light py-2 px-4 my-2 bright radius15">
                    <h2>دسته بندی ها</h2>
                    <a href="#">- بیشتر -</a>
                </div>
                <ul class="list-unstyled">
                    <?php $cats = getCats(); ?>
                    <?php foreach ($cats as $cat) : ?>
                        <li class="d-flex justify-content-between align-items-center">
                            <a href="<?=http('categories.php?category='.$cat->id)?>">
                                <img src="<?=http('assets/Img/cati/img_4.jpg')?>" class="ml-2"/>
                                <span><?= $cat->title ?></span>
                            </a>
                            <span><?= countArticles($cat->id) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-------------------------------------------------End Of Categories------------------------------------------------->


            <!-------------------------------------------------Start Of Last Articles------------------------------------------------->
            <div class="card thumb-post p-3 mb-3">
                <h2 class="bg-light py-2 px-4 mt-2 mb-4 bright radius15">آخرین مطالب</h2>
                <ul class="fa12">
                    <?php $lastArticles = getArticlesForNav(); ?>
                    <?php foreach ($lastArticles as $lastArticle) : ?>
                        <li>
                            <div class="d-flex flex-row">
                                <a href="#"><img src="<?= http('images/') . $lastArticle->image ?>"/></a>
                                <div class="m-2">
                                    <p>
                                        <a href="<?=http('single.php?id='.$lastArticle->id)?>"><?= $lastArticle->title ?></a>
                                    </p>
                                    <span>
                                    <?=
                                    substr($lastArticle->created_at, 12, 4) . ' / ' . substr($lastArticle->created_at, 8, 4) . ' / ' . substr($lastArticle->created_at, 0, 8)
                                    ?>
                                </span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-------------------------------------------------End Of Last Articles------------------------------------------------->
        </div>
        <!-------------------------------------------------End Of Side-Nav------------------------------------------------->