<?php
require "../../functions/users.php";
require "../../functions/http.php";
require "../../functions/DB.php";
$error = '';
if (isset($_POST['submit'])) {
    if( checkRegisterEmpty($_POST['name'] , $_POST['email'] , $_POST['password'] , $_POST['confirm_password']) ){
        if (checkPassword($_POST['password'], $_POST['confirm_password'])) {
            if (checkUniqueUser($_POST['email'])) {
                if (!empty($_FILES['image'])){

                    $filename = $_FILES["image"]["tmp_name"];
                    $target_dir = "../../images/";
                    $uniquesavename = time() . uniqid(rand());
                    $destFile = $target_dir . $uniquesavename . '.jpg';
                    move_uploaded_file($filename,  $destFile);


//                    move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $_FILES['image']['name']);
                    $image = $uniquesavename.'.jpg';
                }
                createNewUser($_POST['name'], $_POST['email'], $_POST['password'], $image);

                $success = "کاربر جدید با موفقیت ثبت شد";
                header("location:user_list.php");
            }else{
                $error = 'ایمیل وارد شده تکراری است';
            }
        }else{
            $error = "در وارد کردن رمز عبور خود دقت فرمایید";
        }
    }else{
        $error = "لطفا تمامی فیلدها را تکمیل کنید";
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
            <h4 class="card-title">ایجاد کاربر</h4>
            <?php if($error != ''){echo "<p style='color: red;'>{$error}</p>";} ?>
            <form method="POST" action="#" enctype="multipart/form-data">
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left"  dir="rtl" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">ایمیل</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left" dir="rtl" name="email" >
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">رمز عبور</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left" dir="rtl" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">تکرار رمز عبور</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left" dir="rtl" name="confirm_password">
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

