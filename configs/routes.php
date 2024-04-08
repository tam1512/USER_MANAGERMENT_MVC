<?php 
$routes['default_controller'] = 'home';
$routes['/'] = 'home';
$routes['trang-chu'] = 'home';
$routes['nguoi-dung'] = 'user';
$routes['nguoi-dung/xoa'] = 'user/deletes';
$routes['nguoi-dung/them-nguoi-dung'] = 'user/add';
$routes['nguoi-dung/chinh-sua/(.+)'] = 'user/edit/$1';
$routes['nguoi-dung/xoa-nguoi-dung/(.+)'] = 'user/delete/$1';
$routes['dang-nhap'] = 'auth/login';
$routes['dang-ky'] = 'auth/register';
$routes['dang-xuat'] = 'auth/logout';
$routes['kich-hoat-tai-khoan'] = 'auth/active_account';
$routes['kich-hoat/(.+)'] = 'auth/active/$1';
