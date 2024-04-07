<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, View};
class User extends Controller {
   private $model, $data = [];
   public function __construct() {
      $this->model = $this->model("User");
   }
   public function index() {
      $listUsers = $this->db->table('users as u')->select('u.id, u.fullname, u.email, g.name as nameGroup, u.status, u.created_at')->join('groups as g', 'g.id = u.group_id')->get();
      $listGroups = $this->db->table('groups')->select('id, name')->get();
      $this->data = [
         'header_content' => [
            'title' => 'Quản lý người dùng'
         ],
         'footer_content' => [
            'copyright' => 'Copyright &copy; 2024 by Unicode Academy'
         ],
         'content' => 'user/index',
         'sub_content' => [
            'title' => 'Quản lý người dùng',
            'listUsers' => $listUsers,
            'listGroups' => $listGroups,
         ]
      ];
      $this->render('layouts/layout', $this->data);
   }
}