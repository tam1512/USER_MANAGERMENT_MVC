@use (App\Core\htmlHelper)
<div class="py-3">
   @php
   htmlHelper::openForm('post', _WEB_HOST_ROOT.'/auth/handleRegister');
   @endphp
      <div class="row justify-content-center">
         <div class="col-10 col-lg-5 col-md-6 col-sm-10">
            <h1 class="text-center text-uppercase">{{$title}}</h1>
            @php
            htmlHelper::input('<div class="form-group"><label for="fullname">Họ tên</label>', form_error('fullname', '<span class="text-danger">', '</span>').'</div>', 'text', 'fullname', old('fullname'), 'form-control', 'fullname', 'Họ tên...');
            htmlHelper::input('<div class="form-group"><label for="email">Email</label>', form_error('email', '<span class="text-danger">', '</span>').'</div>', 'text', 'email', old('email'), 'form-control', 'email', 'Email...');
            htmlHelper::input('<div class="form-group"><label for="password">Mật khẩu</label>', form_error('password', '<span class="text-danger">', '</span>').'</div>', 'password', 'password', '', 'form-control', 'password', 'Mật khẩu...');
            htmlHelper::input('<div class="form-group"><label for="confirm_password">Nhập lại mật khẩu</label>', form_error('confirm_password', '<span class="text-danger">', '</span>').'</div>', 'password', 'confirm_password', '', 'form-control', 'confirm_password', 'Nhập lại mật khẩu...');
            htmlHelper::button('<div class="d-grid">', '</div>', 'submit', 'btn btn-block btn-primary', '', 'Đăng ký')
            @endphp
            <hr>
            <div class="text-center">
               <a href="{{_WEB_HOST_ROOT}}/dang-nhap">Đăng nhập</a>
            </div>
         </div>
      </div>
      @php
      htmlHelper::closeForm()
      @endphp