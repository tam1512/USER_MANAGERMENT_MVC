<?php
namespace App\Middlewares;
use App\Core\{Middlewares, Response};
use App\App;
class ParamsMiddleware extends Middlewares {
   public function handle() {
      // if(!empty($_SERVER['QUERY_STRING'])) {
      //    $response = new Response();
      //    $response->redirect(trim(App::$app->getUrl(), '/'));
      // }
   }
}