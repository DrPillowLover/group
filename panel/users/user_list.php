<?php
require "../../functions/users.php";
require "../../functions/http.php";
require "../../functions/DB.php";
global $conn;
$counter = 1;
?>
<?php require "../layout/head.php"; ?>
<?php require "../layout/navigation.php"; ?>
<?php require "../layout/header.php"; ?>


    <main class="main-content p-0">
        <div class="card">
            <div class="card-body">
                <div class="table overflow-auto" tabindex="8">
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
                            <th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">نام و نام خانوادگی</th>
                            <th class="text-center align-middle text-primary">ایمیل</th>
                            <!--                    <th class="text-center align-middle text-primary">نقش های کاربر</th>-->
                            <!--                    <th class="text-center align-middle text-primary"> وضعیت</th>-->
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $users = getUsersList(); ?>
                            <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="text-center align-middle"><?= $counter++; ?></td>
                            <td class="text-center align-middle">
                                <figure class="avatar">
                                    <img src="../../images/avatar.jpg" class="rounded-circle" alt="image">
                                </figure>
                            </td>
                            <td class="text-center align-middle"><?= $user->name ?></td>
                            <td class="text-center align-middle"><?= $user->email ?></td>
                            <!--                    <td class="text-center align-middle">-->
                            <!--                        <a class="btn btn-outline-info" href="#">-->
                            <!--                            نقش های کاربر-->
                            <!--                        </a>-->
                            <!--                    </td>-->
                            <!--                    <td class="text-center align-middle">-->
                            <!--                        <span class="cursor-pointer badge badge-success">فعال</span>-->
                            <!--                    </td>-->
                            <td class="text-center align-middle">
                                <a class="btn btn-outline-info" href="<?='edit_user.php?id='.$user->id ?>">
                                    ویرایش
                                </a>
                                <a class="btn btn-outline-danger" href="<?='delete_user.php?id='.$user->id ?>">
                                    حذف
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <?= substr($user->created_at , 12 , 4) . ' / ' . substr($user->created_at , 8 , 4). ' / ' . substr($user->created_at ,0,8) ?>
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