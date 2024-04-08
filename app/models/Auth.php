<?php
namespace App\Models;
use App\Core\{Model, Hash};
class Auth extends Model {
   private $__email = '';
   function tableFill() {
      return 'users';
   }

   function fieldFill() {
      return 'email, password';
   }

   function primaryKey() {
      return 'id';
   }

   public function check_email($email) {
      $this->__email = $email;
      return $this->db->table($this->tableFill())->where('email', '=', $email)->count();
   }

   public function check_pass($pass) {
      $acc = $this->db->table($this->tableFill())->where('email', '=', $this->__email)->first();
      if(!empty($acc) && Hash::check(trim($pass), $acc['password'])) {
         return true;
      }
      return false;
   }

   public function check_status($email) {
      $user = $this->db->table($this->tableFill())->where('email', '=', $email)->first();
      if($user) {
         return $user['status'];
      }
      return false;
   }

   public function addUser($data) {
      return $this->db->table($this->tableFill())->insert($data);
   }
}