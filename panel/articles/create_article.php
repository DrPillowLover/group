<?php
require "../../functions/articles.php";
require "../../functions/http.php";
require "../../functions/DB.php";
global $conn;
$error = '';
$success = '';

$cats = getCatsList();
if (isset($_POST['submit'])) {
   if ( checkArticleEmpty( $_POST['title'], $_POST['body'], $_POST['category'] )){

       $filename = $_FILES["image"]["tmp_name"];
       $target_dir = "../../images/";
       $uniqueSaveName = time() . uniqid(rand());
       $destFile = $target_dir . $uniqueSaveName . '.jpg';
       move_uploaded_file($filename,  $destFile);
       $image = $uniqueSaveName.'.jpg';
       createNewArticle($_POST['title'], $_POST['body'], $image, $_POST['keywords'], $_POST['category']);
       $success = 'پست جدید با موفقیت اضافه شد';
   }else{
       $error = 'پر کردن همه فیلدها ضروری است';
   }
}
?>
<?php require "../layout/head.php"; ?>
<?php require "../layout/navigation.php"; ?>
<?php require "../layout/header.php"; ?>

<div class="card">
    <div class="card-body">
        <div class="container">
            <h4 class="card-title">ایجاد مقاله</h4>
            <?php if ($error != '') {
                echo "<p style='color: red;'>{$error}</p>";
            } ?>
            <?php if ($success != '') {
                echo "<p style='color: green;'>{$success}</p>";
            } ?>
            <form method="POST" action="#" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">عنوان مقاله</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-lg text-left" dir="rtl" name="title">
                    </div>
                </div>
                <!--                <div class="form-group row">-->
                <!--                    <label class="col-sm-2 col-form-label">متن مقاله</label>-->
                <!--                    <div class="col-sm-10">-->
                <!--                        <input type="text" class="form-control text-left" dir="rtl" name="body">-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">متن مقاله</label>
                    <div class="col-sm-10">
                        <textarea class="form-control form-control-lg" name="body" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <p>
                            کلمات کلیدی
                        </p>
                    </div>
                    <div class="mb-3 col-sm-10">
                        <input type="text" name="keywords" class="form-control form-control-lg" id="floatingInput" placeholder="مثال: #درخت">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">دسته بندی</label>
                    <div class="col-sm-10">
                        <select class="form-select w-100 h-100" dir="rtl" name="category">
                            <option selected>دسته بندی مدنظر خود را وارد کنید ...</option>
                            <?php foreach ($cats as $cat):  ?>

                            <option value="<?=$cat->id?>"><?= $cat->title ?></option>

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

