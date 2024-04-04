<?php 
namespace App\Core;
class Routes {
   private $__routeKey;
   public function handleRoutes($url) {
      global $routes;
      unset($routes['default_controller']);
      $urlHandle = trim($url, '/');
      if(!empty($routes)) {
         foreach($routes as $key=>$value) {
            if(preg_match('~^'.$key.'$~is', $urlHandle)) {
               $urlHandle = preg_replace('~^'.$key.'$~is', $value, $urlHandle);
               $this->__routeKey = $key;
            }
         }
      }
      return $urlHandle;
   }

   public function getRouteKey() {
      return $this->__routeKey;
   }
}