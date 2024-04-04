<?php
namespace App\Core;
abstract class View {  
   static $dataShare = [];
   static function share($data) {
      self::$dataShare = $data;
   }
}