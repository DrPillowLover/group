<?php
$search = $_GET['search'];
$_GET['search'] = null;
require "functions/DB.php";
require "functions/http.php";
global $conn;
require "functions/search.php";
require "layouts/head.php";
require "layouts/header.php";
require "layouts/breadcrumb.php";
require "layouts/sideNav.php";
?>
<!-------------------------------------------------Start Of Main Part------------------------------------------------->

<div class="col-xl-9  order-xl-1 order-0 mb-4">
    <div class="row">
        <?php $results = getSearchResults($search); ?>
        <?php if (!$results){ ?>
            <div class="w-100 text-center ">
                <p class="alert alert-danger h1 p-3">متاسفانه محتوای مدنظر شما یافت نشد</p>
            </div>
        <?php }else{ ?>

        <?php foreach ($results as $result) : ?>

            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card" style="height:430px;">
                    <a href="single.php?id=<?= $result->id ?>">
                        <img class="card-img-top" src="<?=http('images/') . $result->image ?>"
                             alt="<?= $result->title ?>" style="height: 200px">
                    </a>
                    <div class="card-body">
                        <h2 class="IRANSans_Bold">
                            <a href="single.php?id=<?= $result->id ?>"><?= $result->title ?></a>
                        </h2>
                        <span class="text-primary fa12 IRANSans_Medium">
                                    <a href="single.php?id=<?= $result->id ?>"><?= getCatTitle($result->category_id) ?></a>
                                </span>
                        <p>
                            <?= limit_words($result->body, 25) . '...' ?>
                        </p>
                        <div class="mt-2 text-center">
                            <a href="single.php?id=<?= $result->id ?>" class="card-link text-primary">ادامه
                                مطلب</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

    <!-------------------------------------------------Start Of Pagination------------------------------------------------->

    <div class="row mt-3">
        <div class="col-12 text-center mx-auto">
            <ul class="pagination  justify-content-center">

                <li class="page-item"><a class="page-link" href="index.php?search=<?= $_GET['search'] ?>">«</a></li>

                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $numberOfTotalPages = numberOfPages($search);
                ?>


                <?php for ($i = 1; $i <= $numberOfTotalPages; $i++) : ?>

                    <?php if ($i > $page + 2 || $i < $page - 2) { ?>
                        <li class="page-item">
                            <a class="page-link d-none" href="#"><?= $i ?></a>
                        </li>
                    <?php } else { ?>

                        <li class="page-item">
                            <a class="page-link"
                               href="index.php?page=<?= $i ?>&search=<?= $_GET['search'] ?>"><?= $i ?></a>
                        </li>

                    <?php } ?>
                <?php endfor; ?>
                <li class="page-item"><a class="page-link"
                                         href="index.php?page=<?= $numberOfTotalPages ?>&search=<?= $_GET['search'] ?>">»</a>
                </li>
            </ul>
        </div>
    </div>
    <!-------------------------------------------------End Of Pagination------------------------------------------------->
    <?php } ?>
</div>
<!-------------------------------------------------End Of Main Part------------------------------------------------->
<?php
require "layouts/footer.php";
require "layouts/scripts.php";
?>