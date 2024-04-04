<?php 
namespace App\Core;
class DB {
   public $db = null;

   public function __construct() {
      $this->db = new Database();
   }
}