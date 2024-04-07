<div class="py-3">
   <form action="" method="post">
      <div class="row justify-content-center">
         <div class="col-5">
            <h1 class="text-center text-uppercase">{{$title}}</h1>
            <div class="form-group">
               <label for="fullname">Họ tên</label>
               <input type="text" class="form-control" id="fullname" placeholder="Họ tên...">
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input type="text" class="form-control" id="email" placeholder="Email...">
            </div>
            <div class="form-group">
               <label for="password">Mật khẩu</label>
               <input type="password" class="form-control" id="password" placeholder="Mật khẩu...">
            </div>
            <div class="form-group">
               <label for="confirm_password">Nhập lại mật khẩu</label>
               <input type="confirm_password" class="form-control" id="confirm_password" placeholder="Nhập lại mật khẩu...">
            </div>
            <div class="d-grid">
               <button type="submit" class="btn btn-block btn-primary">Đăng nhập</button>
            </div>
            <hr>
            <div class="text-center">
               <a href="{{_WEB_HOST_ROOT}}/auth/register">Đăng ký</a>
            </div>
         </div>
      </div>
   </form>
</div>