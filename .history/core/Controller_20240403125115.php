<?php 
namespace App\Core;
class Controller {
   public $db = null;
   public function model($model) {
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

   public function render($view, $data = []) {
      if(!empty(View::$dataShare)) {
         $data = array_merge($data, View::$dataShare);
      }
      $contentView = null;
      $path = _WEB_PATH_ROOT."\app\\views\\".$view.".php";
      if(preg_match('~^layout~', $view)) {
         if(file_exists($path)) {
            extract($data);
            require_once($path);
         }
      } else {
         if(file_exists($path)) {
            $contentView = file_get_contents($path);
         }
         $template = new Template();
         $template->run($contentView, $data);
      }
   }
}

?>