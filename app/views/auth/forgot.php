@use (App\Core\htmlHelper)
<div class="py-3">
   @php
   htmlHelper::openForm('post', _WEB_HOST_ROOT.'/auth/handleForgot');
   @endphp
      <div class="row justify-content-center flex-column align-items-center">
         <div class="col-5">
            <h1 class="text-center text-uppercase">{{$title}}</h1>
            @php
            htmlHelper::input('<div class="form-group"><label for="email">Email</label>', form_error('email', '<span class="text-danger">', '</span>').'</div>', 'text', 'email', old('email'), 'form-control', 'email', 'Email...');
            htmlHelper::button('<div class="d-grid">', '</div>', 'submit', 'btn btn-block btn-primary', '', 'Xác nhận')
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
</div>