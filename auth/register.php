<?php require_once '../functions/users.php'; ?>
<?php //require_once "../functions/DB.php";
//        global $conn;
        $error = "";
        $success = "";
        ?>

<?php
if (isset($_POST['register'])) {
    if( checkRegisterEmpty($_POST['name'] , $_POST['email'] , $_POST['password'] , $_POST['confirm_password']) ){
        if (checkPassword($_POST['password'], $_POST['confirm_password'])) {
            if (checkUniqueUser($_POST['email'])) {
                createNewUser($_POST['name'], $_POST['email'], $_POST['password']);
                $success = "کاربر جدید با موفقیت ثبت شد";
                header("location:login.php");
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

<html dir="rtl" lang="fa-IR">
<head>
    <title>عضویت</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , maximum-scale=1">
    <link href=<?php echo http('assets/Css/Main.css'); ?> rel="stylesheet"/>
    <link href=<?php echo http('assets/Css/Style.css'); ?>  rel="stylesheet"/>
</head>
<body class="rtl bg-greengrad min-h">
<section class="container maxw">
    <div class="card login  mx-md-5 mt-5 justify-content-center shadow-none">
        <div class="row">

            <div class="col-lg-6">
                <div class="card-body p-4 text-center">
                    <a href="#"><img src=<?php echo http('assets/Img/logo-main.png'); ?> alt="logo"
                                     class="pt-2 pb-4"></a>
                    <?php if($error !== ''){echo "<p style='color: red; margin-bottom: 2rem'>{$error}</p>"; } ?>
                    <?php if($success !== ''){echo "<p style='color: green; margin-bottom: 2rem'>{$success}</p>"; } ?>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="نام کاربری">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="mail" class="form-control" placeholder="آدرس ایمیل">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control"
                                   placeholder="کلمه عبور">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                   placeholder="تکرار کلمه عبور">
                        </div>
                        <button type="submit" name="register" id="submit"
                                class="btn btn-block btn-success py-2 radius10 mb-4">عضویت
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 m-auto">
                <img src=<?php echo http('assets/Img/login.jpg'); ?> class="img-fluid d-lg-block d-none" />
            </div>
        </div>
    </div>
</section>
</body>

</html>