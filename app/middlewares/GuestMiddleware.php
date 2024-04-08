<?php
namespace App\Middlewares;
use App\Core\{Middlewares, Session, Response};
use App\App;

class GuestMiddleware extends Middlewares {

   public function handle() {
      $path = trim(App::$app->getUrl(), '/');
      $include = [
         'dang-nhap',
         'dang-ky'
      ];
      if(in_array($path, $include) && Session::data('user_login')) {
         $response = new Response();
         $response->redirect('');
      }
   }
}