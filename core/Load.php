<?php 
namespace App\Core;
class Load {
   public static function model($model) {
      $path = _WEB_PATH_ROOT.'\app\models\\'.$model.'.php';
      if(file_exists($path)) {
         require_once $path;

         $nameClass = 'App\Models\\'.$model;
         if(class_exists($nameClass)) {
            $model = new $nameClass();
            return $model;
         }

      }
      return false;
   }

   public static function render($view, $data = []) {
      extract($data);
      $path = _WEB_PATH_ROOT."\app\\views\\".$view.".php";
      if(file_exists($path)) {
         require_once($path);
      }
   }
}

?>