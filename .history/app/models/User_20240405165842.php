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
               var_dump($value);
               echo '</br>';
               $charset = mb_detect_encoding($value);
               echo $charset;
               echo '</br>';
               mb_convert_encoding($value, 'UTF-8', 'ASCII');
               echo '</br>';
               var_dump($value);
               echo '</br>';
               var_dump('tâm');
               echo '</br>';
               $charset = mb_detect_encoding('tâm');
               echo $charset;
               echo '</br>';
               $charset = mb_internal_encoding();
               echo $charset;
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