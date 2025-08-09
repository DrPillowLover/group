<?php
require "../../functions/articles.php";
require "../../functions/http.php";
require "../../functions/DB.php";
global $conn;
$counter = 1;
session_start();
?>
<?php require "../layout/head.php"; ?>
<?php require "../layout/navigation.php"; ?>
<?php require "../layout/header.php"; ?>


    <main class="main-content p-0">
        <div class="card">
            <div class="card-body">
                <div class="table overflow-auto" tabindex="7">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">عنوان جستجو</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl">
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">عنوان</th>
                            <th class="text-center align-middle text-primary">متن</th>
                            <th class="text-center align-middle text-primary" colspan="2">نویسنده</th>
                            <th class="text-center align-middle text-primary">دسته بندی</th>
                            <!--                    <th class="text-center align-middle text-primary">نقش های کاربر</th>-->
                            <!--                    <th class="text-center align-middle text-primary"> وضعیت</th>-->
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $articles = getArticles(); ?>
                        <?php foreach ($articles as $article) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $counter++; ?></td>
                                <td class="text-center align-middle"><?= $article->title ?></td>
                                <td class="text-center align-middle"><?= limit_words($article->body,20) . '...'; ?></td>
                                <td class="text-center align-middle">
                                    <?php
                                    $user = getUserById($article->user_id);
                                    echo $user->name;
                                    ?> </td>
                                <td class="text-center align-middle">
                                    <img src="<?=http('images/').$user->image?>" style="height: 50px; width: 50px; border-radius: 50%; border-color: transparent;">
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $cat = getCatById($article->category_id);
                                    echo $cat->title;
                                    ?> </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="<?= 'edit_article.php?id=' . $article->id ?>">
                                        ویرایش
                                    </a>
                                    <a class="btn btn-outline-danger"
                                       href="<?= 'delete_article.php?id=' . $article->id ?>">
                                        حذف
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <?= substr($article->created_at, 12, 4) . ' / ' . substr($article->created_at, 8, 4) . ' / ' . substr($article->created_at, 0, 8) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <div style="margin: 40px !important;"
                         class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require "../layout/footer.php"; ?>