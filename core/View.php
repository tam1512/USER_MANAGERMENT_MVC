<?php
namespace App\Core;
abstract class View {  
   public static $dataShare = [];
   static function share($data) {
      self::$dataShare = $data;
   }
}