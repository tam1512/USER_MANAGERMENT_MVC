<?php 
namespace App\Core;
abstract class Model extends Database{
   protected $db;
   public function __construct() {
      $this->db = new Database();
   }

   abstract function tableFill();
   abstract function fieldFill();
   abstract function primaryKey();

   function all($condition = '') {
      $table = $this->tableFill();
      $field = $this->fieldFill();
      if(empty($field)) {
         $field = '*';
      }
      if(empty($condition)) {
         $query = "SELECT $field FROM $table";
      } else {
         $query = "SELECT $field FROM $table WHERE $condition";
      }

      $data = $this->db->getRaw($query);

      return $data;
   }

   function find($id) {
      $table = $this->tableFill();
      $field = $this->fieldFill();
      $primaryKey = $this->primaryKey();
      if(empty($field)) {
         $field = '*';
      }
      $query = "SELECT $field FROM $table WHERE $primaryKey = $id";

      $data = $this->db->firstRaw($query);

      return $data;
   }
}