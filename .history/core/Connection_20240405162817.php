<?php
namespace App\Core;
use \PDO;
use \Exception;
use App\App;
class Connection {
   private static $conn;
   

   private function __construct($config_data) {
      try {
         if (class_exists('PDO')) {
            $dsn = $config_data['dbdriver'] . ':dbname=' . $config_data['db'] . ';host=' . $config_data['host'];
      
            $options = [
               PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Đẩy lỗi vào ngoại lệ truy vấn
            ];

               self::$conn = new PDO($dsn, $config_data['user'], $config_data['pass'], $options);
         }
      } catch (Exception $e) {
         App::$app->loadError('database', ['message' => $e->getMessage()]);
         exit();
      }
   }


   public static function getInstance($config_data) {
      if(self::$conn == null) {
         new Connection($config_data);
      }
      return self::$conn;
   }
}