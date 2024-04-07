<?php 
use App\Core\AppServiceProvider;
use App\Core\htmlHelper;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\ParamsMiddleware;
$config['app'] = [
   'services' => [
      htmlHelper::class
   ],
   'routeMiddleware' => [
      'san-pham' => AuthMiddleware::class
   ],
   'globalMiddleware' => [
      ParamsMiddleware::class
   ],
   'boot' => [
      AppServiceProvider::class
   ]
   ];