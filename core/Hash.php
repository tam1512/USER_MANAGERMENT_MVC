<?php 
namespace App\Core;
class Hash {
   public static function make($password) {
      global $config;

      $algo = [
         'default' => PASSWORD_DEFAULT,
         'bcrypt' => PASSWORD_BCRYPT,
         'argon2i' => PASSWORD_ARGON2I,
         'argon2id' => PASSWORD_ARGON2ID
      ];

      if(!empty($config['hash'])) {
         $configHash = $config['hash'];
         $type = $configHash['type'] ?? null;

         if(!empty($algo[$type])) {
            return password_hash($password, $algo[$type]);
         }

      }
      return false;
   }

   public static function check($password, $hash) {
      return password_verify($password, $hash);
   }
}