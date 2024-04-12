@use (App\Core\htmlHelper)
<div class="py-3">
   @if(!empty($token))
   @php
   htmlHelper::openForm('post', _WEB_HOST_ROOT.'/auth/handleResetPassword/'.$token);
   @endphp
      <div class="row justify-content-center flex-column align-items-center">
         <div class="col-5">
            <h1 class="text-center text-uppercase">{{$title}}</h1>
            @php
            htmlHelper::input('<div class="form-group"><label for="password">Mật khẩu mới</label>', form_error('password', '<span class="text-danger">', '</span>').'</div>', 'password', 'password', '', 'form-control', 'password', 'Mật khẩu mới...');
            htmlHelper::input('<div class="form-group"><label for="confirm_password">Nhập lại mật khẩu mới</label>', form_error('confirm_password', '<span class="text-danger">', '</span>').'</div>', 'password', 'confirm_password', '', 'form-control', 'confirm_password', 'Nhập lại mật khẩu mới...');
            htmlHelper::button('<div class="d-grid">', '</div>', 'submit', 'btn btn-block btn-primary', '', 'Đặt lại mật khẩu')
            @endphp
            <hr>
            <div class="text-center">
               <a href="{{_WEB_HOST_ROOT}}/dang-nhap">Đăng nhập</a>
            </div>
            <br>
            <div class="text-center">
               <a href="{{_WEB_HOST_ROOT}}/dang-ky">Đăng ký</a>
            </div>
         </div>
      </div>
   @php
   htmlHelper::closeForm()
   @endphp
   @else
   <div class="container-fluid row justify-content-center py-3">
   <div class="col-7">
      <div class="alert alert-danger text-center">
      <p>Liên kết không hợp lệ hoặc đã hết hạn</p>
      <a href="{{_WEB_HOST_ROOT.'/dang-nhap'}}">Quay lại đăng nhập</a>
      </div>
   </div>
</div>
   @endif
</div>