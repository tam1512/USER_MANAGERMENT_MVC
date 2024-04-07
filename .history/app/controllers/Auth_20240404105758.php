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
         'title' => 'Đăng nhập hệ thống',
         'content' => 'auth/login',
         'sub_content' => [
            'title' => 'Đăng nhập hệ thống'
         ]
      ];
      $this->render('layouts/auth', $this->data);
   }
   public function register() {
      $this->data = [
         'title' => 'Đăng ký tài khoản',
         'content' => 'auth/register',
         'sub_content' => [
            'title' => 'Đăng ký tài khoản'
         ]
      ];
      $this->render('layouts/auth', $this->data);
   }
}