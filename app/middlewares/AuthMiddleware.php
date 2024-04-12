<?php
namespace App\Middlewares;
use App\Core\{Middlewares, Session, Response, View, Load};
use App\App;
class AuthMiddleware extends Middlewares {
   
   public function handle() {
    $response = new Response();
     $path = trim(App::$app->getUrl(), '/');
     $exclude = [
      'dang-nhap',
      'dang-ky',
      'auth/*',
      'kich-hoat-tai-khoan',
      'kich-hoat/*',
      'quen-mat-khau',
      'dat-lai-mat-khau/*'
     ];

     $auth = $this->checkAuth();
     View::share($auth);

     $isPass = false;
     foreach($exclude as $item) {
      if(preg_match('~/\*~', $item)) {
        $item = rtrim($item, '\*');
        if(preg_match('~'.$item.'~', $path)) {
          $isPass = true;
        }
      } else {
        if($path == $item) {
          $isPass = true;
        }
      }
     }

     if(!$isPass && empty(Session::data('user_login'))) {
      $response->redirect('dang-nhap');
     }
   }

   function checkAuth() {
    $auth = [];

    $id = Session::data('user_login') ?? '';
    if($id) {
      $userModel = Load::model('user');
      $user = $userModel->getUser($id);
      if($user && $user['status'] && $user['session_id'] == Session::id()) {
        $auth = $user;
      } else {
        Session::delete('user_login');
      }
    }

    return $auth;
   }
}