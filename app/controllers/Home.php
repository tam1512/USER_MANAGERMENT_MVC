<?php
   namespace App\Controllers;
   use App\Core\{Controller, Request, Response, Session, View};
   class Home extends Controller{
      public $model;
      public $data = [];
      public function __construct() {
         $this->model = $this->model('Home');
      }
      public function index() {
         // $this->data['sub_content']['message'] = Session::flash('message');
         // $this->data['content'] = 'users\add';
         // $this->data['title'] = 'Thêm người dùng';
         // $this->render('layouts\client_layout', $this->data);
         $this->data['title'] = 'title';
         $this->data['fullname'] = 'fullname';
         $this->data['products'] = [
            'item1',
            'item2',
            'item3',
            'item4',
            'item5',
         ];


         $this->render('products/list', $this->data);
      }

      public function get_category() {
         $this->render('category/form');
      }
      public function post_category() {
         $request = new Request();
         $response = new Response();

         // $response->redirect('home/get_category');
         
         $data = $request->getFields();
         echo '<pre>';
         print_r($data);
         echo '</pre>';

         $this->render('category/form');
      }

      public function get_user() {
         $this->data['sub_content']['message'] = Session::flash('message');
         $this->data['content'] = 'users\add';
         $this->data['title'] = 'Thêm người dùng';
         $this->render('layouts\client_layout', $this->data);
      }

      public function post_user() {
         $request = new Request();
         if($request->isPost()) {
            $rules = [
               'fullname' => 'required|min:5|max:60',
               'email' => 'required|email|min:6|unique:users:email:id=1',
               'age' => 'required|callback_check_age',
               'password' => 'required|min:3',
               'confirm_password' => 'required|match:password'
            ];
            $messages = [
               'fullname.required' => 'Họ tên không được để trống',
               'fullname.min' => 'Họ tên ít nhất phải có 5 ký tự',
               'fullname.max' => 'Họ tên tối đa 60 ký tự',
               'email.required' => 'Email không được để trống',
               'email.email' => 'Email không hợp lệ',
               'email.min' => 'Email ít nhất phải có 6 ký tự',
               'email.unique' => 'Email đã tồn tại',
               'age.required' => 'Tuổi không được để trống',
               'age.callback_check_age' => 'Tuổi không được nhỏ hơn 20',
               'password.required' => 'Mật khẩu không được để trống',
               'password.min' => 'Độ dài mật khẩu phải trên 2 ký tự',
               'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
               'confirm_password.match' => 'Mật khẩu không trùng khớp'
            ];
            $request->rules($rules);
            $request->messages($messages);
            
            $this->data['sub_content'] = [];
            
            if(!$request->validate()) {
               Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            }
         } 
         $response = new Response();
         $response->redirect('home/get_user');
      }

      public function check_age($age) {
         if($age >= 20) {
            return true;
         }
         return false;
      }
   }

?>