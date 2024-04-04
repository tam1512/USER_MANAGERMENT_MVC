<?php
namespace App\Core;
class Response {
   public function redirect($uri = '') {
      if(preg_match('~~^http|https~', $uri)) {
         $url = $uri;
      } else {
         $url = _WEB_HOST_ROOT.'/'.$uri;
      }
      header('Location: '.$url);
      exit();
   }
}