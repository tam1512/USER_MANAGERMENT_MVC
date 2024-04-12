<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, Hash, Mail};
class Auth extends Controller {
   private $model, $data = [];
   private $modelUser;
   public function __construct() {
      $this->model = $this->model("Auth");
      $this->modelUser = $this->model("User");
   }
   public function login() {
      $this->data = [
         'title' => 'Đăng nhập hệ thống',
         'content' => 'auth/login',
         'message' => Session::flash('message'),
         'msg_type' => Session::flash('msg_type'),
         'sub_content' => [
            'title' => 'Đăng nhập hệ thống',
         ]
      ];
      $this->render('layouts/auth', $this->data);
   }

   public function handleLogin() {
      $request = new Request();
      $response = new Response();
      if($request->isPost()) {
         $rules = [
            'email' => 'required|email|callback_check_email|callback_check_status',
            'password' => 'required|callback_check_pass'
         ];

         $messages = [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.callback_check_email' => 'Tài khoản không tồn tại trong hệ thống',
            'email.callback_check_status' => 'Email này chưa được kích hoạt',
            'password.required' => 'Mật khẩu không được để trống',
            'password.callback_check_pass' => 'Mật khẩu sai'
         ];

         $request->rules($rules);
         $request->messages($messages);

         if(!$request->validate()) {
            Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            Session::flash('msg_type', 'warning');
            $response->redirect('dang-nhap');
         } else {
            $email = $request->getFields()['email'];
            $user = $this->modelUser->getUser($email, 'email');
            $this->modelUser->updateUser(['session_id' => Session::id()], $user['id']);
            Session::data('user_login', $user['id']);
            Session::flash('message', 'Đăng nhập thành công');
            Session::flash('msg_type', 'success');
            $response->redirect('nguoi-dung');
         }
      } else {
         Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
         Session::flash('msg_type', 'warning');
         $response->redirect('dang-nhap');
      }
   }

   public function check_email($email) {
      return $this->model->check_email($email);
   }
   public function check_status($email) {
      return $this->model->check_status($email);
   }
   public function check_pass($pass) {
      return $this->model->check_pass($pass);
   }
   public function register() {
      $this->data = [
         'title' => 'Đăng ký tài khoản',
         'content' => 'auth/register',
         'message' => Session::flash('message'),
         'msg_type' => Session::flash('msg_type'),
         'sub_content' => [
            'title' => 'Đăng ký tài khoản'
         ]
      ];
      $this->render('layouts/auth', $this->data);
   }

   public function handleRegister() {
      $request = new Request();
      $response = new Response();
      if($request->isPost()) {
         $rules = [
            'fullname' => 'required|min:5|max:100',
            'email' => 'required|email|unique:users:email',
            'password' => 'required|min:3',
            'confirm_password' => 'required|match:password'
         ];

         $messages = [
            'fullname.required' => 'Họ tên không được để trống',
            'fullname.min' => 'Họ tên phải có tối thiểu 5 ký tự',
            'fullname.max' => 'Độ dài không được vượt quá 100 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại. Hãy nhập email khác',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có tối thiểu 3 ký tự',
            'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
            'confirm_password.match' => 'Mật khẩu không trùng khớp'
         ];

         $request->rules($rules);
         $request->messages($messages);

         if(!$request->validate()) {
            Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            Session::flash('msg_type', 'warning');
            $response->redirect('dang-ky');
         } else {
            $data = $request->getFields();
            $data['password'] = Hash::make($data['password']);
            unset($data['confirm_password']);
            
            $activeToken = md5(uniqid());
            $data['active_token'] = $activeToken;
            $status = $this->modelUser->addUser($data);
            if($status) {
               $id = $this->modelUser->getLastUserId();
               Session::data('user_active', $id);

               Session::flash('message', 'Đăng ký thành công');
               Session::flash('msg_type', 'success');
               $response->redirect('kich-hoat-tai-khoan');
            } else {
               Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
               Session::flash('msg_type', 'warning');
               $response->redirect('dang-ky');
            }
         }
      }
   }

   public function active_account() {
      $id = Session::data('user_active');
      $user = $this->modelUser->getUser($id);
      if($user && $user['status'] == 0) {
         $this->data = [
            'title' => 'Kích hoạt tài khoản',
            'content' => 'auth/active_account',
            'message' => Session::flash('message'),
            'msg_type' => Session::flash('msg_type'),
            'sub_content' => [
               'message' => 'Vui lòng kiểm tra email để kích hoạt tài khoản',
               'msg_type' => 'info',
               'data' => $user
            ]
         ];
     
         $this->render('layouts/auth', $this->data);
      } else {
         $response = new Response();
         Session::delete('user_active');
         Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
         Session::flash('msg_type', 'warning');
         $response->redirect('dang-ky');
      }
   }

   public function active($activeToken) {
      $response = new Response();
      $user = $this->modelUser->getUser($activeToken, 'active_token');
      if($user && $user['status'] == 0) {
         $status = $this->modelUser->updateUser(['status' => 1, 'active_token'=>NULL], $user['id']);
         if($status) {
            Session::delete('user_active');
            Session::flash('message', 'Kích hoạt tài khoản thành công');
            Session::flash('msg_type', 'success');
            $response->redirect('dang-nhap');
         } else {
            Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            Session::flash('msg_type', 'warning');
            $response->redirect('dang-ky');
         }
      } else {
         Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
         Session::flash('msg_type', 'warning');
         $response->redirect('dang-ky');
      }
   }

   public function logout() {
      Session::delete('user_login');
      Session::flash('message', 'Đăng xuất thành công');
      Session::flash('msg_type', 'success');
      (new Response)->redirect('dang-nhap');
   }

   public function forgot() {
      /**
       * 1. Hiện form nhập email
       * 2. Kiểm tra email hợp lệ
       * 3. Gửi forgot token đến email
       * 4. Người dùng click link có forgot token
       * 5. Kiểm tra token hợp lệ và còn hạn
       * 5. Nhập mk mới và nhập lại mk mới
       * 6. Chuyển đến trang đăng nhập và gửi email đổi mk thành công
       */
      $this->data = [
         'title' => 'Quên mật khẩu',
         'content' => 'auth/forgot',
         'message' => Session::flash('message'),
         'msg_type' => Session::flash('msg_type'),
         'sub_content' => [
            'title' => 'Quên mật khẩu'
         ]
      ];
      $this->render('layouts/auth', $this->data);
   }

   public function handleForgot() {
      $request = new Request();
      $response = new Response();
      if($request->isPost()) {
         $data = $request->getFields();
         $email = $data['email'];
         $rules = [
            'email' => 'required|email|callback_check_email|callback_check_status'
         ];
         $messages = [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Định dạng email không hợp lệ',
            'email.callback_check_email' => 'Email này chưa được đăng ký tài khoản',
            'email.callback_check_status' => 'Email này chưa được kích hoạt',
         ];

         $request->rules($rules);
         $request->messages($messages);

         if($request->validate()) {
            $forgotToken = md5(uniqid());
            $status = $this->modelUser->updateUser(['reset_token' => $forgotToken], $email, 'email');
            if($status) {
               $data = $this->modelUser->getUser($email, 'email');
               $linkForgot = _WEB_HOST_ROOT.'/dat-lai-mat-khau/'.$forgotToken;
               $to = $email;
               $fullname = $data['fullname'];
               $subject = "$fullname hãy đặt lại mật khẩu của bạn!";
               $content = <<<EOT
                  <p>Chào $fullname</p>
                  <p>Cảm ơn bạn đã xử dụng chức năng quên mật khẩu trên website của chúng tôi</p>
                  <p>Để tiếp tục sử dụng. Vui lòng click vào link dưới đây để đặt lại mật khẩu</p>
                  <p>$linkForgot</p>
                  <p>Trân trọng!!</p>
               EOT;

               Mail::sendMail($to, $subject, $content);

               Session::flash('message', 'Thành công!! Bạn vui lòng kiểm tra email để đặt lại mật khẩu của mình');
               Session::flash('msg_type', 'success');
               $response->redirect('quen-mat-khau');
            } else {
               Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
               Session::flash('msg_type', 'warning');
               $response->redirect('quen-mat-khau');
            }
         } else {
            Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            Session::flash('msg_type', 'warning');
            $response->redirect('quen-mat-khau');
         }
      } else {
         Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
         Session::flash('msg_type', 'warning');
         $response->redirect('dang-nhap');
      }
   }

   public function reset_password($token) {
      $checkToken = $this->db->table('users')->where('reset_token', '=', $token)->count();
      $this->data = [
         'title' => 'Đặt lại mật khẩu',
         'content' => 'auth/reset_password',
         'message' => Session::flash('message'),
         'msg_type' => Session::flash('msg_type'),
         'sub_content' => [
            'title' => 'Đặt lại mật khẩu'
         ]
      ];
      if($checkToken > 0) {
         $this->data['sub_content']['token'] = $token;
      }
      $this->render('layouts/auth', $this->data);
   }

   public function handleResetPassword($token) {
      $response = new Response();
      $request = new Request();
      if(!empty($token)) {
         if($request->isPost()) {
            $user = $this->modelUser->getUser($token, 'reset_token');
            if(!empty($user) && $user['status'] == 1) {
               $data = $request->getFields();
               $rules = [
                  'password' => 'required|min:3',
                  'confirm_password' => 'required|match:password'
               ];
               $messages = [
                  'password.required' => 'Mật khẩu mới không được để trống',
                  'password.min' => 'Mật khẩu phải có tối thiểu 3 ký tự',
                  'confirm_password.required' => 'Nhập lại mật khẩu mới không được để trống',
                  'confirm_password.match' => 'Mật khẩu không trùng khớp'
               ];

               $request->rules($rules);
               $request->messages($messages);

               if($request->validate()) {
                  
                  $status = $this->modelUser->updateUser(['password' => Hash::make($data['password']), 'reset_token' => NULL], $user   ['id']);

                  if($status) {
                     Session::flash('message', 'Đặt lại mật khẩu thành công');
                     Session::flash('msg_type', 'success');
                     $response->redirect('dang-nhap');
                  } else {
                     Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
                     Session::flash('msg_type', 'warning');
                     $response->redirect('dang-nhap');
                  }
               } else {
                  Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
                  Session::flash('msg_type', 'warning');
                  $response->redirect('dat-lai-mat-khau/'.$token);
               }
            } else {
               Session::flash('message', 'Link đặt lại mật khẩu sai hoặc tài khoản chưa được kích hoạt');
               Session::flash('msg_type', 'warning');
               $response->redirect('dang-nhap');
            }
         }
      } else {
         Session::flash('message', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
         Session::flash('msg_type', 'warning');
         $response->redirect('dang-nhap');
      }
   }
}