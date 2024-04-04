<?php
namespace App\Models;
use App\Core\Model;
class Home extends Model{
   private $table = 'products';

   function tableFill() {
      return 'users';
   }

   function fieldFill() {
      return 'id, fullname';
   }

   function primaryKey() {
      return 'id';
   }
   public function index() {
      $data = [
         'fullname' => 'Thanh Tam',
         'email' => 'thanh.tam@gmail.com',
         'password' => '123456789'
      ];
      return $this->db->table('users')->count();
   }
   public function getList() {
      $data = [
         'sp1',
         'sp2',
         'sp3',
         'sp4',
      ];
      return $data;
   }
}