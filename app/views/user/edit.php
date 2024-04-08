@use (App\Core\htmlHelper)
<div class="col-9">
   <h1>{{$title}}</h1>
   <hr>
   @php
   htmlHelper::openForm('post', _WEB_HOST_ROOT.'/user/handleEdit/'.$user['id']);
   @endphp
   <div class="row">
      <div class="col-6">
         @php
         htmlHelper::input('<div class="form-group"><label for="fullname">Họ tên</label>', form_error('fullname', '<span class="text-danger">', '</span>').'</div>', 'text', 'fullname', old('fullname', $user['fullname']), 'form-control', 'fullname', 'Họ tên...');
         @endphp
      </div>
      <div class="col-6">
         @php
         htmlHelper::input('<div class="form-group"><label for="email">Email</label>', form_error('email', '<span class="text-danger">', '</span>').'</div>', 'text', 'email', old('email', $user['email']), 'form-control', 'email', 'Email...');
         @endphp
      </div>
      <div class="col-6">
         @php
         htmlHelper::input('<div class="form-group"><label for="password">Mật khẩu</label>', form_error('password', '<span class="text-danger">', '</span>').'</div>', 'password', 'password', '', 'form-control', 'password', 'Mật khẩu...');
         @endphp
      </div>
      <div class="col-6">
         @php
         htmlHelper::input('<div class="form-group"><label for="confirm_password">Nhập lại mật khẩu</label>', form_error('confirm_password', '<span class="text-danger">', '</span>').'</div>', 'password', 'confirm_password', '', 'form-control', 'confirm_password', 'Nhập lại mật khẩu...');
         @endphp
      </div>
      <div class="col-6">
         <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status" class="form-control">
               <option value="1" {{ $user['status'] == 1 ? 'selected' : false}}>Kích hoạt</option>
               <option value="0" {{ $user['status'] == 0 ? 'selected' : false}}>Chưa kích hoạt</option>
            </select>
         </div>
      </div>
      <div class="col-6">
         <div class="form-group">
            <label for="group_id">Nhóm</label>
            <select name="group_id" id="group_id" class="form-control">
               <option value="0">Chọn nhóm</option>
               @if(!empty($listGroups))
                  @foreach($listGroups as $group)
                     <option value="{{$group['id']}}" {{$group['id'] == old('group_id', $user['group_id']) ? 'selected' : false}}>{{$group['name']}}</option>
                  @endforeach
               @endif
            </select>
            {!form_error('group_id', '<span class = "text-danger">', '</span>')!}
         </div>
      </div>
      <div class="col-12">
         <div class="form-group">
         @php
         htmlHelper::button(type:'submit', class:'btn btn-primary', content: 'Lưu');
         @endphp
         </div>
      </div>
   </div>
   @php
   htmlHelper::closeForm();
   @endphp
</div>