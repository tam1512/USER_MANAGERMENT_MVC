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
      global $config;
      $limit = $config['app']['userOnPage'];
      $limitPaginate = $config['app']['limitPage'];


      $listUsers = $this->db->table('users as u')->select('u.id, u.fullname, u.email, g.name as nameGroup, u.status, u.created_at')->join('groups as g', 'g.id = u.group_id');

      if(!empty($filter)) {
         foreach($filter as $key=>$value) {
            if($key == 'keyword') {
               $listUsers = $listUsers->orWhere(function($query) use ($value) {
                  $query->whereLike('fullname', '%'.trim($value).'%');
                  $query->orWhere('email', 'LIKE', '%'.trim($value).'%');
               });
            } else {
               $listUsers = $listUsers->where($key, '=', trim($value));
            }
         }
      }

      $listUsers = $listUsers->paginate($limit, $limitPaginate);
      return $listUsers;
   }

   public function addUser($data) {
      return $this->db->table($this->tableFill())->insert($data);
   }

   public function getUser($value, $field='id') {
      return $this->db->table($this->tableFill())->where($field, '=', $value)->first();
   }
   public function getUserByEmail($email) {
      return $this->db->table($this->tableFill())->where('email', '=', $email)->first();
   }

   public function updateUser($data, $id) {
      return $this->db->table($this->tableFill())->where('id', '=', $id)->update($data);
   }

   public function getLastUserId() {
      return $this->db->lastId();
   }
}