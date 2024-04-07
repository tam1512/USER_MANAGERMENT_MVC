<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, Hash};
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
      $links = $this->model->getUsers($filter)['links'];
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
            'links' => $links,
            'listGroups' => $listGroups,
            'message' => Session::flash('message'),
            'msg_type' => Session::flash('msg_type')
         ]
      ];


      $this->render('layouts/layout', $this->data);
   }

   public function add() {
      $listGroups = $this->db->table('groups')->select('id, name')->get();
      $this->data = [
         'header_content' => [
            'title' => 'Thêm người dùng'
         ],
         'footer_content' => [
            'copyright' => 'Copyright &copy; 2024 by Unicode Academy'
         ],
         'content' => 'user/add',
         'sub_content' => [
            'title' => 'Thêm người dùng',
            'listGroups' => $listGroups,
            'message' => Session::flash('message')
         ]
      ];

      $this->render('layouts/layout', $this->data);
   }

   public function handleAdd() {
      $request = new Request();
      if($request->isPost()) {
         $rules = [
            'fullname' => 'required|min:5|max:60',
            'email' => 'required|email|min:6|unique:users:email',
            'password' => 'required|min:3',
            'confirm_password' => 'required|match:password',
            'group_id' => 'required'
         ];
         $messages = [
            'fullname.required' => 'Họ tên không được để trống',
            'fullname.min' => 'Họ tên ít nhất phải có 5 ký tự',
            'fullname.max' => 'Họ tên tối đa 60 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.min' => 'Email ít nhất phải có 6 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Độ dài mật khẩu phải trên 2 ký tự',
            'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
            'confirm_password.match' => 'Mật khẩu không trùng khớp',
            'group_id.required' => 'Nhóm không được để trống',
         ];

         $request->rules($rules);
         $request->messages($messages);

         if(!$request->validate()) {
            Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            $response = new Response();
            $response->redirect('nguoi-dung/them-nguoi-dung');
         } else {
            $data = $request->getFields();
            $data['password'] = Hash::make($data['password']);
            unset($data['confirm_password']);
            $status = $this->model->addUser($data);
            if($status) {
               Session::flash('message', 'Thêm người dùng thành công');
               Session::flash('msg_type', 'success');
            } else {
               Session::flash('message', 'Lỗi hệ thống. Vui lòng thử lại sau');
               Session::flash('msg_type', 'danger');
            }
            $response = new Response();
            $response->redirect('nguoi-dung');
         }
      }
   }

   public function deletes() {
      $request = new Request();
      $data = $request->getFields();
      if(!empty($data['ids'])) {
         $ids = $data['ids'];
         $status = null;
         foreach($ids as $id) {
            $status = $this->db->table('users')->where('id', '=', $id)->delete();
            if($status == false) {
               echo "false";
               return;
            }
         }
         echo "true";
         return;
      }
      echo "false";
      return;
   }
}