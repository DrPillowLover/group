<?php
require "../../functions/categories.php";
require "../../functions/DB.php";
require "../../functions/http.php";

$error = '';
$getID = $_GET['id'];
$cat = getCatById($getID);


if (isset($_POST['submit'])) {

    if (checkEditEmpty($_POST['title'])) {


            updateCat($getID , $_POST['title']);

            $success = "کاربر جدید با موفقیت ثبت شد";
            header("location:category_list.php");


    }else {
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
            <?php if($error != ''){echo "<p style='color: red;'>{$error}</p>";} ?>
            <form method="POST" action="#" enctype="multipart/form-data">
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left"  dir="rtl" name="title" value="<?=$cat->title ?>">
                    </div>
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

