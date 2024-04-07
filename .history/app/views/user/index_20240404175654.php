<div class="col-9">
   <h1>{{$title}}</h1>
   <hr>
   <div class="row mb-3">
      <div class="col-12 mb-3">
         <a href="#" class="btn btn-success"><i class="fa-regular fa-square-plus mr-2"></i>Thêm người dùng</a>
      </div>
      <div class="col-12">
         <form action="" method="get">
            <div class="row">
               <div class="col-3">
                  <select name="status" id="" class="form-control">
                     <option value="all">Tất cả trạng thái</option>
                     <option value="active">Kích hoạt</option>
                     <option value="inactive">Chưa kích hoạt</option>
                  </select>
               </div>
               <div class="col-3">
                  <select name="group_id" id="" class="form-control">
                     <option value="0">Tất cả nhóm</option>
                     @if(!empty($listGroups))
                        @foreach ($listGroups as $group)
                           <option value="{{$group['id']}}">{{$group['name']}}</option>
                        @endforeach
                     @endif
                  </select>
               </div>
               <div class="col-4">
                  <input type="text" class="form-control" name="keyword" placeholder="Từ khóa..." />
               </div>
               <div class="col-2">
                  <button type="submit" class="btn btn-info btn-block">Tìm kiếm</button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <table class="table table-bordered table-responsive">
      <thead>
         <tr>
            <th><input type="checkbox" name="chooseUser" id="checkAllUser"></th>
            <th width="50%">Tên</th>
            <th width="50%">Email</th>
            <th>Nhóm</th>
            <th>Trạng thái</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
         </tr>
      </thead>
      <tbody>
         @if(!empty($listUsers))
            @foreach($listUsers as $user)
               <tr>
                  <td><input type="checkbox" name="" id=""></td>
                  <td>{{$user["fullname"]}}</td>
                  <td>{{$user["email"]}}</td>
                  <td>
                     @foreach($listGroups as $item)
                        @if($item['id'] == $user['group_id'])
                           {{$item['name']}}
                        @endif
                     @endforeach
                  </td>
                  <td>{!$user['status'] == 1 ? '<p class="badge badge-success">Kích hoạt</p>' : '<p class="badge badge-danger">Chưa kích hoạt</p>'!}</td>
                  <td>{{getDateFormat($user['created_at'], 'd/m/Y')}}<br>{{getDateFormat($user['created_at'], 'h:i:s')}}</td>
                  <td><a href="#" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
                  <td><a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
               </tr>
            @endforeach
         @endif
      </tbody>
   </table>
   <div class="row">
      <div class="col-6">
         <button type="button" class="btn btn-danger disabled">Xóa đã chọn (0)</button>
      </div>
      <div class="col-6">
         <nav aria-label="Page navigation" class="d-flex justify-content-end">
            <ul class="pagination">
               <li class="page-item"><a class="page-link" href="#">Trước</a></li>
               <li class="page-item"><a class="page-link" href="#">1</a></li>
               <li class="page-item"><a class="page-link" href="#">2</a></li>
               <li class="page-item"><a class="page-link" href="#">3</a></li>
               <li class="page-item"><a class="page-link" href="#">Sau</a></li>
            </ul>
         </nav>
      </div>
   </div>
</div>