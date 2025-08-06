<?php
$getID = $_GET['id'];
require "./functions/DB.php";
require "./functions/http.php";
require "./functions/index.php";
require "./functions/comments.php";
$article = getArticleById($getID);
$error = "";
$success = '';
$isSubmitted = false;
global $isSubmitted;
//var_dump($_SESSION);
//echo '<br>';
$token = sha1(rand(1, 1000));
//var_dump($token);
//echo '<br>';
$_SESSION['token'] = $token;
//var_dump($_SESSION);
//echo '<br>';
?>
<?php
if (isset($_POST['commentSubmit']) && !$isSubmitted) {
//    if (isset($_POST['token']) && $_POST['token'] == $token) {
//        $error = 'salam';
//    }else{
        if (checkLogin()) {
            if (checkCommentEmpty($_POST['comment'])) {

                submitComment($_POST['comment']);
                $success = 'نظر شما با موفقیت ثبت شد';
            } else {
                $error = 'لطفا ابتدا نظر خود را یادداشت فرمایید';
            }
        } else {
            $error = 'لطفا ابتدا وارد حساب کاربری خود شوید';
        }
//    }
}
?>
<html dir="rtl" lang="fa-IR">
<head>

    <title>جزئیات وبلاگ</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , maximum-scale=1">
    <link href="<?= http('assets/Css/Main.css') ?>" rel="stylesheet"/>
    <link href="<?= http('assets/Css/Menu-demo1.css') ?>" rel="stylesheet"/>
    <link href="<?= http('assets/Css/Style.css') ?>" rel="stylesheet"/>
</head>
<body class="rtl blog_details">
<div class="main_wrap">
    <div class="of-site-mask"></div>

    <div class="off-canvas-wrap ">
        <div class="close-off-canvas-wrap">
            <a href="#" id="of-close-off-canvas">
                <i class="fal fa-times"></i>
            </a>
        </div>
        <div class="off-canvas-inner">
            <div id="of-mobile-nav" class="mobile-menu-wrap">
                <ul class="mobile-menu">
                    <li class="current-menu-item">
                        <a href="Index_demo1.html">صفحه اصلی</a>
                    </li>
                    <li>
                        <a href="blog_sample.php">مقالات</a>
                    </li>
                    <li><a href="aboutus.html" target="_blank">درباره ما</a></li>
                    <li><a href="ContactUs.html" target="_blank">تماس با ما</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!---------------------------------------Start of Header--------------------------------------->
    <header class="main_header wide_header">
        <div class="header_container">
            <div class="menu_wrapper menu_sticky">
                <div class="container p_relative h86">
                    <div id="navigation" class="of-drop-down of-main-menu" role="navigation">
                        <ul class="menu">
                            <li>
                                <a href="Index_demo1.html" class="current">
                                    <img src="assets/Img/logo-main.png"/>
                                </a>
                            </li>
                            <li>
                                <a href="Index_demo1.html">صفحه اصلی</a>
                            </li>
                            <li><a href="blog_sample.php" target="_blank">مقالات</a></li>
                            <li><a href="aboutus.html" target="_blank">درباره ما</a></li>
                            <li><a href="ContactUs.html" target="_blank">تماس با ما</a></li>

                        </ul>
                    </div>
                    <div class="m_search pt-xl-3 pt-1"><i class="fal fa-search"></i></div>
                    <div class="is-show mobile-nav-button">
                        <a id="of-trigger" class="icon-wrap  mt-2" href="#"> <i class="fal fa-bars"></i>فهرست</a>
                    </div>
                    <form class="search_wrap mt-lg-0" id="ajax-form-search" method="get" action="">

                        <input type="text" id="search-form-text" class="search-field" value="" name="s"
                               placeholder="کلید واژه مورد نظر ...">
                        <button><i class="fal fa-search"></i></button>

                        <input type="hidden" name="post_type" value="product">
                        <div id="ajax-search-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!---------------------------------------End of Header--------------------------------------->


    <!---------------------------------------Start of BreadCrumb--------------------------------------->
    <div class="clearfix"></div>
    <section class="container mt-4 mb-2">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb radius15 shadow-sm">
                    <ul>
                        <li><a href="#">خانه / </a></li>
                        <li><a href="#" class="current">جزئیات وبلاگ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!---------------------------------------End of BreadCrumb--------------------------------------->


    <!---------------------------------------Start of Side_Nav--------------------------------------->
    <section class="container mb-4">
        <div class="row">
            <div class="col-xl-3 order-xl-0 order-1 mb-3">

                <!---------------------------------------Start of Categories--------------------------------------->
                <div class="card pcountry cati  p-3 mb-3">
                    <div class="d-flex flex-row justify-content-between bg-light py-2 px-4 my-2 bright radius15">
                        <h2>دسته بندی ها</h2>
                        <a href="#">- بیشتر -</a>
                    </div>

                    <ul class="list-unstyled">
                        <?php $cats = getCats(); ?>
                        <?php foreach ($cats as $cat) : ?>
                            <li>
                                <a href="#">
                                    <img src="assets/Img/cati/img_4.jpg" class="ml-2"/>
                                    <span><?= $cat->title ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!---------------------------------------End of Categories--------------------------------------->


                <!---------------------------------------Start of Last_Articles--------------------------------------->
                <div class="card thumb-post p-3 mb-3">
                    <h2 class="bg-light py-2 px-4 mt-2 mb-4 bright radius15">آخرین مطالب</h2>
                    <ul class="fa12">
                        <?php $lastArticles = getArticlesForNav(); ?>
                        <?php foreach ($lastArticles as $lastArticle) : ?>
                            <li>
                                <!--                        assets/Img/blog-post1.jpg-->
                                <div class="d-flex flex-row">
                                    <a href="#"><img src="<?= http('images/') . $lastArticle->image ?>"/></a>
                                    <div class="m-2">
                                        <p>
                                            <a href="single.php?id=<?= $lastArticle->id ?>"><?= $lastArticle->title ?></a>
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
                <!---------------------------------------End of Last_Articles--------------------------------------->
            </div>
            <!---------------------------------------End of Side_Nav--------------------------------------->


            <!---------------------------------------Start of Main_Article--------------------------------------->
            <div class="col-xl-9  order-xl-1 order-0 mb-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="text-primary">نمایش جزئیات</h2>
                    </div>
                    <div class="card-body p-sm-4">
                        <div class="item mb-4">

                            <div class="row">
                                <div class="col-lg-12 mb-3 text-justify ">
                                    <a href="#" class="mb-3"><h2><?= $article->title ?></h2></a>
                                    <img src="<?= http('images/') . $article->image ?>" alt=""
                                         class="img-fluid my-4 blogimg radius15"/>
                                    <pre class="mt-5" style="line-height: 2.5; font-size: 14px"><?php print_r(explode('#' , $article->keywords)) ?></pre>
                                    <p class="mt-5" style="line-height: 2.5; font-size: 14px"><?= $article->body ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!---------------------------------------Start of Comments--------------------------------------->
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-primary">نظرات کاربران</h2>
                    </div>
                    <div class="card-body p-sm-4">


                        <div class="comment mb-4">
                            <?php $comments = getComments($_GET['id']); ?>
                            <?php foreach ($comments as $comment) : ?>
                                <?php $user = getUserByIdCOM($comment->user_id) ?>
                                <div class="row border-bottom mb-4">
                                    <div class="col-lg-3 mb-3 text-justify d-flex align-items-center justify-content-start">
                                        <img src="<?= http('images/') . $user->image ?>"
                                             style="width:80px;height:80px; border-radius: 50%"
                                             alt="" class="mx-2">
                                        <p style="font-size: 14px; font-weight: 500"><?= $user->name ?></p>
                                    </div>
                                    <div class="col-lg-9 mb-3 text-justify d-flex align-items-center justify-content-center">
                                        <p class="mb-3"><?= $comment->text ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="comment my-4 pt-4 border rounded">
                            <div class="row px-2">
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="alert h1 col-lg-12 mb-3 alert-danger alert-dismissible" role="alert">' . $error . '</div>';
                                }
                                if (!empty($success)) {
                                    echo '<div class="alert h1 col-lg-12 mb-3 alert-success alert-dismissible" role="alert">' . $success . '</div>';
                                }
                                ?>
                                <div class="col-lg-3 mb-3 text-justify d-flex align-items-start justify-content-start">
                                    <p class="h1">
                                        ثبت نظرات
                                    </p>
                                </div>
                                <div class="col-lg-9 mb-3 text-justify d-flex align-items-center justify-content-start">
                                    <form class="w-100 d-flex flex-column align-items-end justify-content-center"
                                          action="#" method="post">
                                        <textarea class="form-control" rows="5" name="comment"></textarea>
                                        <input name="token" type="hidden" value="<?=$token?>"/>
                                        <button type="submit" name="commentSubmit" class="btn btn-primary mt-3">ثبت
                                            نظرات
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!---------------------------------------End of Comments--------------------------------------->
            </div>
            <!---------------------------------------End of Main_Article--------------------------------------->
        </div>
    </section>


    <!--------------------------------------- Footer --------------------------------------->
    <footer class="fdemo3 pt-4 pb-2">
        <div class="container footer-wrap">
            <div class="row py-3">
                <div class="col-lg-4 col-md-6  col-sm-12 mb-4 order-lg-0 order-3">
                    <div class="pl-md-4 mb-2 text-right">

                        <p>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                        </p>
                        <ul class="standard_social_links mt-2 float-right">

                            <li class="round-btn btn-facebook">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                            </li>

                            <li class="round-btn btn-instagram">
                                <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                            </li>
                            <li class="round-btn btn-whatsapp">
                                <a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>

                            </li>
                            <li class="round-btn btn-telegram">
                                <a href="#"><i class="fab fa-telegram-plane" aria-hidden="true"></i></a>
                            </li>

                        </ul>

                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6 mb-4 order-lg-1 order-0">
                    <h3>لینک های سریع</h3>
                    <ul class="footer-category">
                        <li>
                            <a href="Index_demo1.html"><i class="fal fa-angle-left ml-2"></i>صفحه اصلی</a>
                        </li>
                        <li>
                            <a href="Service.html"><i class="fal fa-angle-left ml-2"></i>مقالات</a>
                        </li>
                        <li>
                            <a href="aboutus.html"><i class="fal fa-angle-left ml-2"></i>درباره ما</a>
                        </li>
                        <li>
                            <a href="ContactUs.html"><i class="fal fa-angle-left ml-2"></i>تماس با ما</a>
                        </li>
                    </ul>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-12 px-md-3 mb-4 order-lg-3  order-4">
                    <h3>عضویت در خبرنامه</h3>
                    <p> ثبت نام کنید و آخرین نکات را از طریق ایمیل دریافت کنید ، جهت ثبت نام فقط کافی ست که آدرس ایمیل
                        را در کادر زیر وارد نمایید</p>
                    <form class="newsletter p_relative mt-3">
                        <input type="text" placeholder="آدرس ایمیل">
                        <button class="newsletter_submit_btn" type="submit"><i class="fab fa-telegram-plane"></i>
                        </button>
                    </form>
                </div>
            </div>


        </div>

    </footer>
</div>

<script src="assets/Js/jquery.min.js"></script>
<script src="assets/Js/bootstrap.min.js"></script>
<script src="assets/Js/my-script.js"></script>
<script src="assets/Js/custom.js"></script>


</body>

</html>