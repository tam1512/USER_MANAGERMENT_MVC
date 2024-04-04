<?php
namespace App\Models;
use App\Core\Model;
class Product extends Model{
   private $__table = 'products';
   function tableFill() {
      return 'users';
   }

   function fieldFill() {
      return 'id, fullname';
   }

   function primaryKey() {
      return 'id';
   }
   public function getList() {
      $data = $this->all();
      return $data;
   }
   public function detail($id) {
      $data = $this->find(1);
      return $data;
   }
}