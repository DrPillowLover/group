
<body class="small-navigation">

<div class="navigation">
    <div class="navigation-icon-menu">
        <ul>
            <li data-toggle="tooltip" title="کاربران">
                <a href="#users" title=" کاربران">
                    <i class="icon ti-user"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="دسته بندی">
                <a href="#categories" title=" دسته بندی">
                    <i class="icon ti-book"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="مقالات">
                <a href="#articles" title="مقالات">
                    <i class="icon ti-write"></i>
                </a>
            </li>
        </ul>
        <ul>
            <li data-toggle="tooltip" title="ویرایش پروفایل">
                <a href="#" class="go-to-page">
                    <i class="icon ti-settings"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="خروج">
                <a href="<?= http('auth/logout.php') ?>" class="go-to-page">
                    <i class="icon ti-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="navigation-menu-body">
        <ul id="users">
            <li>
                <a href="#">کاربران</a>
                <ul>
                    <li><a href="<?= http('panel/users/create_user.php'); ?>">ایجاد کاربر</a></li>
                    <li><a href="<?= http('panel/users/user_list.php'); ?>">لیست کاربران</a></li>
                </ul>
            </li>
        </ul>
        <ul id="categories">
            <li>
                <a href="#">دسته بندی</a>
                <ul>
                    <li><a href="<?= http('panel/categories/create_category.php'); ?>">دسته بندی جدید</a></li>
                    <li><a href="<?= http('panel/categories/category_list.php'); ?>">لیست دسته بندی</a></li>
                </ul>
            </li>
        </ul>
        <ul id="articles">
            <li>
                <a href="#">مقالات</a>
                <ul>
                    <li><a href="<?= http('panel/articles/create_article.php'); ?>">مقاله جدید</a></li>
                    <li><a href="<?= http('panel/articles/article_list.php'); ?>">لیست مقالات</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end::navigation -->