<?php
require "../../functions/categories.php";
require "../../functions/http.php";
require "../../functions/DB.php";
$error = '';
$success = '';
if (isset($_POST['submit'])) {

    if( checkEditEmpty($_POST['title']) ){


            if (checkUniqueCat($_POST['title'])) {

                createNewCat($_POST['title']);

                $success = "دسته بندی جدید با موفقیت ثبت شد";
//                header("location:../index.php");
            }else{
                $error = 'عنوان وارد شده تکراری است';
            }

    }else{
        $error = "لطفا تمامی فیلدها را تکمیل کنید";
    }
}
?>
<?php require "../layout/head.php"; ?>
<?php require "../layout/navigation.php"; ?>
<?php require "../layout/header.php"; ?>

<div class="card">
    <div class="card-body">
        <div class="container">
            <h4 class="card-title">ایجاد کاربر</h4>
            <?php if($error != ''){echo "<p style='color: red;'>{$error}</p>";} ?>
            <?php if($success != ''){echo "<p style='color: green;'>{$success}</p>";} ?>

            <form method="POST" action="#" enctype="multipart/form-data">
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">عنوان</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left"  dir="rtl" name="title">
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

