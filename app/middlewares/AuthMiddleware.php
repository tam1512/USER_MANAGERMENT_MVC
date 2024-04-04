<?php
namespace App\Middlewares;
use App\Core\{Middlewares, Session, Response};

class AuthMiddleware extends Middlewares {
   
   public function handle() {
      if(empty(Session::data('login_admin'))) {
         $response = new Response();
         $response->redirect('trang-chu');
      }
   }
}