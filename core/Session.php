<?php
namespace App\Core;
use App\App;
class Session {
   public static function data($key='', $value='') {
      $sessionKey = self::isInvalid();

      if(!empty($sessionKey)) {
         if(!empty($key)) {
            if(!empty($value)) {
               $_SESSION[$sessionKey][$key] = $value;
               return true;
            } else {
               if(isset($_SESSION[$sessionKey][$key]))
               return $_SESSION[$sessionKey][$key];
            }
         } else {
            if(isset($_SESSION[$sessionKey]))
            return $_SESSION[$sessionKey];
         }
      }
      return false;
   }

   public static function delete($key='') {
      $sessionKey = self::isInvalid();
      if(!empty($sessionKey)) {
         if(!empty($key)) {
            unset($_SESSION[$sessionKey][$key]);
            return true;
         } else {
            unset($_SESSION[$sessionKey]);
            return true;
         }
      }
      return false;
   }

//tạo => tương tự data, gọi => tự động xóa 
   public static function flash($key='', $value='') {
      $flashData = self::data($key, $value);
      if(empty($value)) {
         self::delete($key);
         return $flashData;
      }
   }

   static public function showErrors($message) {
      $data = ['message' => $message];
      App::$app->loadError('exception', $data);
      die();
   }

   static public function isInvalid() {
      global $config;
      if(!empty($config['session'])) {
         $sessionConfig = $config['session'];
         if(!empty($sessionConfig['session_key'])) {
            $sessionKey = $sessionConfig['session_key'];
            return $sessionKey;
         } else {
            self::showErrors('Thiếu cấu hình session_key. Vui lòng kiểm tra file configs/session.php');
         }
      } else {
         self::showErrors('Thiếu cấu hình session_key. Vui lòng kiểm tra file configs/session.php');
      }
      return false;
   }

   static public function id() {
      return session_id();
   }
}