<?php
namespace App\Models;
use App\Core\Model;
class User extends Model {
   function tableFill() {
      return 'users';
   }

   function fieldFill() {
      return '*';
   }

   function primaryKey() {
      return 'id';
   }

   public function getUsers($filter=[]) {
      $listUsers = $this->db->table('users as u')->select('u.id, u.fullname, u.email, g.name as nameGroup, u.status, u.created_at')->join('groups as g', 'g.id = u.group_id');

      if(!empty($filter)) {
         foreach($filter as $key=>$value) {
            if($key == 'keyword') {
               $listUsers = $listUsers->where('u.fullname', 'like', '%'.trim($value).'%');
            } else {
               $listUsers = $listUsers->where($key, '=', trim($value));
            }
         }
      }

      $listUsers = $listUsers->get();
      echo 'userModel';
      echo '<pre>';
      print_r($this->db->getRaw("SELECT u.id, u.fullname, u.email, g.name as nameGroup, u.status, u.created_at FROM users as u INNER JOIN groups as g ON g.id = u.group_id WHERE status = '1' AND group_id = '1' AND u.fullname like '%tâm%' ;
      "));
      echo '</pre>';
      
      return $listUsers;
   }
}