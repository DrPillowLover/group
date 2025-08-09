<?php
require "../../functions/articles.php";
require "../../functions/DB.php";
require "../../functions/http.php";

$error = '';
$getID = $_GET['id'];
$article = getArticleById($getID);


if (isset($_POST['submit'])) {

    if (checkEditEmpty($_POST['title'] , $_POST['body'] , $_FILES['image'])) {

        $filename = $_FILES["image"]["tmp_name"];
        $target_dir = "../../images/";
        $uniqueSaveName = time() . uniqid(rand());
        $destFile = $target_dir . $uniqueSaveName . '.jpg';
        move_uploaded_file($filename,  $destFile);
        $image = $uniqueSaveName.'.jpg';

        updateArticle($_POST['title'] , $_POST['body'] , $image , $_POST['category'] , $getID);

        $success = "کاربر جدید با موفقیت ثبت شد";
        header("location:article_list.php");


    } else {
        $error = "پر کردن همه فیلدها ضروری است";
    }
}
?>


<?php require "../layout/head.php"; ?>
<?php require "../layout/navigation.php"; ?>
<?php require "../layout/header.php"; ?>
<!--require "main.php";-->

<div class="card">
    <div class="card-body">
        <div class="container">
            <h4 class="card-title">ویرایش کاربر</h4>
            <?php if ($error != '') {
                echo "<p style='color: red;'>{$error}</p>";
            } ?>
            <form method="POST" action="#" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left" dir="rtl" name="title"
                               value="<?= $article->title ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">متن مقاله</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="body" rows="5"><?=$article->body?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">دسته بندی</label>
                    <div class="col-sm-10">
                        <select class="form-select w-100 h-100" dir="rtl" name="category">
                            <option selected>دسته بندی مدنظر خود را وارد کنید ...</option>
                            <?php $cats = getCatsList(); ?>
                            <?php foreach ($cats as $cat): ?>

                                <option value="<?=$cat->id ?>" <?php if ($article->category_id == $cat->id){echo 'selected';} ?>><?= $cat->title ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                    <input name="image" type="file" class="form-control-file col-sm-10" id="file">
                </div>
                <div class="form-group row">
                    <button type="submit" name="submit" class="btn btn-success btn-uppercase">
                        <i class="ti-check-box m-r-5"></i> ذخیره
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

<?php require "../layout/footer.php"; ?>

