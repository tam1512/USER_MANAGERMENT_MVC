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
               var_dump(utf8_encode($value));
               echo '</br>';
               var_dump('tâm');
               $listUsers = $listUsers->where('u.fullname', 'like', '%'.trim($value).'%');
            } else {
               $listUsers = $listUsers->where($key, '=', trim($value));
            }
         }
      }

      $listUsers = $listUsers->get();
      
      return $listUsers;
   }
}