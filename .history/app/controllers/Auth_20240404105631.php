<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, View};
class Auth extends Controller {
   private $model, $data = [];
   public function __construct() {
      $this->model = $this->model("Auth");
   }
   public function login() {
      $this->data = [
         'title' => 'Trang chủ',
         'content' => 'auth/login',
         'sub_content' => [
            'title' => 'Trang chủ'
         ]
      ];
      $this->render('layouts/layout', $this->data);
   }
}