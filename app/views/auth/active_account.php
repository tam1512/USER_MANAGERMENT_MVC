@use(App\Core\Mail)
@php
$linkActive = _WEB_HOST_ROOT.'/kich-hoat/'.$data['active_token'];
$to = $data['email'];
$fullname = $data['fullname'];
$subject = "$fullname hãy kích hoạt tài khoản";
$content = <<<EOT
   <p>Chào $fullname</p>
   <p>Cảm ơn bạn đã đăng ký tài khoản trên website của chúng tôi</p>
   <p>Để tiếp tục sử dụng. Vui lòng click vào link dưới đây để kích hoạt tài khoản</p>
   <p>$linkActive</p>
   <p>Trân trọng!!</p>
EOT;

Mail::sendMail($to, $subject, $content);
@endphp

<div class="container-fluid row justify-content-center py-3">
   <div class="col-7">
      <div class="alert alert-{{$msg_type}} text-center">
      <p>{{$message}}</p>
      <a href="{{_WEB_HOST_ROOT.'/kich-hoat-tai-khoan'}}">Gửi lại email kích hoạt</a>
      </div>
   </div>
</div>