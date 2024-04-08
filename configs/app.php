<?php 
use App\Core\AppServiceProvider;
use App\Core\htmlHelper;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
$config['app'] = [
   'services' => [
      htmlHelper::class
   ],
   'routeMiddleware' => [
      /* /* => all trang
         nguoi-dung/* => tất cả trang từ con của nguoi-dung và nguoi-dung
         nguoi-dung => chỉ nguoi-dung
      */
      // '/*' => AuthMiddleware::class,
      'dang-nhap' => GuestMiddleware::class,
      'dang-ky' => GuestMiddleware::class,
      'dang-xuat' => AuthMiddleware::class,
      '/*' => AuthMiddleware::class,
   ],
   'globalMiddleware' => [
      // ParamsMiddleware::class
   ],
   'boot' => [
      AppServiceProvider::class
   ],
   'userOnPage' => 6,
   'limitPage' => 4
   ];