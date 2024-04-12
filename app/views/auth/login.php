@use (App\Core\htmlHelper)
<div class="py-3">
   @php
   htmlHelper::openForm('post', _WEB_HOST_ROOT.'/auth/handleLogin');
   @endphp
      <div class="row justify-content-center flex-column align-items-center">
         @if(!empty($message_active) && !empty($msg_type_active))
         <div class="alert alert-{{$msg_type_active}} text-center col-7">
            <p>{!$message_active!}</p>
            <a href="">Gửi lại email kích hoạt</a>
         </div>
         @endif
         <div class="col-5">
            <h1 class="text-center text-uppercase">{{$title}}</h1>
            @php
            htmlHelper::input('<div class="form-group"><label for="email">Email</label>', form_error('email', '<span class="text-danger">', '</span>').'</div>', 'text', 'email', old('email'), 'form-control', 'email', 'Email...');
            htmlHelper::input('<div class="form-group"><label for="password">Mật khẩu</label>', form_error('password', '<span class="text-danger">', '</span>').'</div>', 'password', 'password', '', 'form-control', 'password', 'Mật khẩu...');
            htmlHelper::button('<div class="d-grid">', '</div>', 'submit', 'btn btn-block btn-primary', '', 'Đăng nhập')
            @endphp
            <hr>
            <div class="text-center">
               <a href="{{_WEB_HOST_ROOT}}/dang-ky">Đăng ký</a>
            </div>
            <br>
            <div class="text-center">
               <a href="{{_WEB_HOST_ROOT}}/quen-mat-khau">Quên mật khẩu</a>
            </div>
         </div>
      </div>
      @php
      htmlHelper::closeForm()
      @endphp
</div>