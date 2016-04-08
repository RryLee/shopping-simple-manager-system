<?php

/************************************
* Home Page
************************************/
require ROOT . '/app/routes/home.php';
/************************************
* Auth Pages
************************************/
require ROOT . '/app/routes/auth/login.php';
require ROOT . '/app/routes/auth/logout.php';

/************************************
* Dashboard
************************************/
require ROOT . '/app/routes/admin/dashboard.php';
/************************************
* Admin Info
************************************/
require ROOT . '/app/routes/admin/info.php';
/************************************
* Admin User
************************************/
require ROOT . '/app/routes/admin/users/index.php';
require ROOT . '/app/routes/admin/users/create.php';
require ROOT . '/app/routes/admin/users/edit.php';
require ROOT . '/app/routes/admin/users/update.php';
require ROOT . '/app/routes/admin/users/destory.php';
/************************************
* Admin Category
************************************/
require ROOT . '/app/routes/admin/categories/index.php';
require ROOT . '/app/routes/admin/categories/create.php';
require ROOT . '/app/routes/admin/categories/edit.php';
require ROOT . '/app/routes/admin/categories/update.php';
require ROOT . '/app/routes/admin/categories/destory.php';
/************************************
* Admin Supplier
************************************/
require ROOT . '/app/routes/admin/suppliers/index.php';
require ROOT . '/app/routes/admin/suppliers/create.php';
require ROOT . '/app/routes/admin/suppliers/edit.php';
require ROOT . '/app/routes/admin/suppliers/update.php';
require ROOT . '/app/routes/admin/suppliers/destory.php';
/************************************
* Admin Goods
************************************/
require ROOT . '/app/routes/admin/goods/index.php';
require ROOT . '/app/routes/admin/goods/create.php';
require ROOT . '/app/routes/admin/goods/edit.php';
require ROOT . '/app/routes/admin/goods/update.php';
require ROOT . '/app/routes/admin/goods/destory.php';
