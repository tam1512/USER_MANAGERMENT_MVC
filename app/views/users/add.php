@use (App\Core\htmlHelper)
<div class="container-fluid py-5">
   {!!empty($message) ? '<div class="alert alert-danger">'.$message.'</div>' : false!}
   @php
   htmlHelper::openForm('post', _WEB_HOST_ROOT.'/home/post_user');
   htmlHelper::input('<div class="form-group"><label for="fullname">Fullname</label>', form_error('fullname', '<span class = "text-danger"><i>', '</i></span>').'</div>', 'text', 'fullname', old('fullname'), 'form-control', 'fullname', 'Fullname...');
   htmlHelper::input('<div class="form-group"><label for="email">Email</label>', form_error('email', '<span class = "text-danger"><i>', '</i></span>').'</div>', 'text', 'email', old('email'), 'form-control', 'email', 'Email...');
   htmlHelper::input('<div class="form-group"><label for="age">Age</label>', form_error('age', '<span class = "text-danger"><i>', '</i></span>').'</div>', 'text', 'age', old('age'), 'form-control', 'age', 'Age...');
   htmlHelper::input('<div class="form-group"><label for="password">Password</label>', form_error('password', '<span class = "text-danger"><i>', '</i></span>').'</div>', 'password', 'password', '', 'form-control', 'password', 'Password...');
   htmlHelper::input('<div class="form-group"><label for="confirm_password">Confirm_password</label>', form_error('confirm_password', '<span class = "text-danger"><i>', '</i></span>').'</div>', 'password', 'confirm_password', '', 'form-control', 'confirm_password', 'Confirm_password...');
   htmlHelper::button(type:'submit', class:'btn btn-primary', content: 'Submit');
   htmlHelper::closeForm();
   @endphp
</div>