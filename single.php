<?php
$getID = $_GET['id'];
require "functions/DB.php";
require "functions/http.php";
require "functions/index.php";
require "functions/comments.php";
$article = getArticleById($getID);
global $conn;
$error = "";
$success = '';
?>
<?php
if (isset($_POST['commentSubmit'])) {

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
}
?>
<?php

require "layouts/head.php";
require "layouts/header.php";
require "layouts/breadcrumb.php";
require "layouts/sideNav.php";
?>

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
                                        <input name="token" type="hidden" value="<?= $token ?>"/>
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

<?php
require "layouts/footer.php";
require "layouts/scripts.php";
?>