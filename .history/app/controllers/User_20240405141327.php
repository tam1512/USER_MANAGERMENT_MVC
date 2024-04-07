<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, View};
class User extends Controller {
   private $model, $data = [];
   public function __construct() {
      $this->model = $this->model("User");
   }
   public function index() {
      $request = new Request();
      $body = $request->getFields();

      $listUsers = $this->db->table('users as u')->select('u.id, u.fullname, u.email, g.name as nameGroup, u.status, u.created_at')->join('groups as g', 'g.id = u.group_id');
      $listGroups = $this->db->table('groups')->select('id, name')->get();

      $filter = [];

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

      if(!empty($body)) {
         if(!empty($body['status'])) {
            if($body['status'] == 'active') {
               $filter['status'] = 1;
            } else if($body['status'] == 'inactive') {
               $filter['status'] = 0;
            }
         }

         if(!empty($body['group_id'])) {
            $filter['group_id'] = $body['group_id'];
         }

         if(!empty($body['keyword'])) {
            $filter['keyword'] = $body['keyword'];
         }
      }

      z_p

      $this->render('layouts/layout', $this->data);
   }
}