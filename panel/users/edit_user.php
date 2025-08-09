<?php
require "../../functions/users.php";
require "../../functions/DB.php";
require "../../functions/http.php";

$error = '';
$getID = $_GET['id'];
$user_data = getUserById($getID);


if (isset($_POST['submit'])) {
    if (checkEditEmpty($_POST['name'], $_POST['password'], $_POST['confirm_password'])) {
        if (checkPassword($_POST['password'], $_POST['confirm_password'])) {
            if ( !empty($_FILES['image']) ){
                $filename = $_FILES["image"]["tmp_name"];
                $target_dir = "../../images/";
                $uniqueSaveName = time() . uniqid(rand());
                $destFile = $target_dir . $uniqueSaveName . '.jpg';
                move_uploaded_file($filename,  $destFile);
                $image = $uniqueSaveName.'.jpg';
            }
            updateUser($getID , $_POST['name'] , $_POST['password'] , $image);

            $success = "کاربر جدید با موفقیت ثبت شد";
            header("location:user_list.php");
        }else{
            $error = 'رمز عبور و تکرار آن مغایرت دارند';
        }
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
            <h4 class="card-title">ایجاد کاربر</h4>
            <?php if($error != ''){echo "<p style='color: red;'>{$error}</p>";} ?>
            <form method="POST" action="#" enctype="multipart/form-data">
                <div class="d-flex align-items-center form-group row">
                    <p class="col-sm-2 col-form-label">تصویر کاربر</p>
                    <div class=" mx-5">
                        <img src="<?='../../images/'.$user_data->image ?>" alt="<?='Profile image for '.$user_data->name ?>" class="" style="border-radius: 50px; width: 100px; height: 100px;">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left"  dir="rtl" name="name" value="<?=$user_data->name ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">ایمیل</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-left" dir="rtl" name="email" disabled value="<?=$user_data->email ?>">
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
                    <input name="image" type="file" class="form-control-file col-sm-10" id="file" value="<?=$user_data->password ?>">
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

