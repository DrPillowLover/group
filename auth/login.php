<?php
require "../functions/users.php";?>
<?php require "../functions/DB.php";
require "../functions/http.php";
global $conn;
$error = "";

?>

<?php
if (isset($_POST["login"])) {
    if (  checkLoginEmpty($_POST['email'] , $_POST['password']) ) {
        if (login($_POST['email'], $_POST['password'])) {
            header('location:../panel/index.php');
        }else{
            $error = "نام کاربری یا رمز عبور اشتباه است";
        }
    }else{
        $error = "لطفا تمامی فیلدها را تکمیل کنید";
    }
}
?>

<html dir="rtl" lang="fa-IR">
<head>
    <title>ورود</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , maximum-scale=1">
    <link href=<?php echo http('assets/Css/Main.css'); ?> rel="stylesheet" />
    <link href=<?php echo http('assets/Css/Style.css'); ?>  rel="stylesheet" />
</head>
<body class="rtl bg-greengrad min-h">
    <section class="container maxw">
        <div class="card login  mx-md-5 mt-5 justify-content-center shadow-none">
            <div class="row">
    
                <div class="col-lg-6">
                    <div class="card-body p-4 text-center">
                            <a href="#"><img src=<?php echo http('assets/Img/logo-main.png'); ?> alt="logo" class="pt-2 pb-4"></a>
                        <?php if($error !== ''){echo "<p style='color: red; margin-bottom: 2rem'>{$error}</p>"; } ?>


                        <form action="#" method="post">
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control" placeholder="نام کاربری">
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="password" id="password" class="form-control" placeholder="کلمه عبور">
                            </div>
                            <button type="submit" name="login" id="login" class="btn btn-block py-2 btn-success radius10 my-3">ورود</button>
                    
                            <p>هنوز ثبت نام نکرده اید ؟ <a href="./register.php" class="text-drkprimary">عضویت در سایت</a></p>
                           </form>
         
                    </div>
                </div>
                <div class="col-lg-6 m-auto">
                    <img src=<?php echo http('assets/Img/login.jpg'); ?> class='img-fluid d-lg-block d-none' />
                </div>
               </div>
        </div>
    </section>
</body>

</html>