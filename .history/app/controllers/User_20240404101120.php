<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, View};
class User extends Controller {
   private $model, $data = [];
   public function __construct() {
      $this->model = $this->model("User");
   }
   public function index() {
      $this->data = [
         'title' => 'Quản lý người dùng',
         'copyright' => 'Copyright &copy; 2024 by Unicode Academy',
         'content' => 'user/index',
         'sub_content' => [
            'title' => 'Quản lý người dùng'
         ]
      ];
      $this->render('layouts/layout', $this->data);
   }
}