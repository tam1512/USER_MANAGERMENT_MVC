<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, View};
class Home extends Controller {
   private $model, $data = [];
   public function __construct() {
      $this->model = $this->model("Home");
   }
   public function index() {
      $this->data = [
         'header_content' => [
            'title' => 'Trang chủ'
         ],
         'footer_content' => [
            'copyright' => 'Copyright &copy; 2024 by Unicode Academy'
         ],
         'content' => 'user/index',
         'sub_content' => [
            'title' => 'Trang chủ'
         ]
      ];
      
      echo '<pre>';
      print_r($_SERVER);
      echo '</pre>';
      $this->render('layouts/layout', $this->data);
   }
}