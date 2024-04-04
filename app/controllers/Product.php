<?php 
namespace App\Controllers;
use App\Core\Controller;
class Product extends Controller{
   public $model;
   public $data = [];

   public function __construct() {
      $this->model = $this->model('Product');
   }
   public function index() {
      $data = $this->model->getList();
      $this->data['sub_content']['listProducts'] = $data;

      $this->data['content'] = 'products\list';
      $this->data['title'] = 'Danh sách sản phẩm';
      $this->render('layouts\client_layout', $this->data);
   }

   public function detail($id=0) {
      $data = $this->model->detail($id);
      $this->data['sub_content']['info'] = $data;
      $this->data['content'] = 'products\detail';
      $this->data['title'] = 'Chi tiết sản phẩm';
      $this->render('layouts\client_layout', $this->data);
   }
}