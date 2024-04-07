<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, View};
class User extends Controller {
   private $model, $data = [];
   public function __construct() {
      $this->model = $this->model("User");
   }
   public function index() {
      // $listUser = $this->model->db->table('users')->get();
      // echo '<pre>';
      // print_r($listUser);
      // echo '</pre>';
      var_dump($this->model);
      $this->data = [
         'header_content' => [
            'title' => 'Quản lý người dùng'
         ],
         'footer_content' => [
            'copyright' => 'Copyright &copy; 2024 by Unicode Academy'
         ],
         'content' => 'user/index',
         'sub_content' => [
            'title' => 'Quản lý người dùng'
         ]
      ];
      $this->render('layouts/layout', $this->data);
   }
}