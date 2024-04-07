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
      $filter = [];

      if(!empty($body)) {
         extract($body);;
         if(!empty($status)) {
            if($status == 'active') {
               $filter['status'] = 1;
            } else if($status == 'inactive') {
               $filter['status'] = 0;
            }
         }

         if(!empty($group_id)) {
            $filter['group_id'] = $group_id;
         }

         if(!empty($keyword)) {
            $filter['keyword'] = $keyword;
         }
      }
      $listUsers = $this->model->getUsers($filter)['data'];
      $links = $this->model->getUsers($filter)['link'];
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