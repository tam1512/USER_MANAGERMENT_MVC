<div class="col-9">
   <h1>{{$title}}</h1>
   <div class="row">
      <div class="col-12">
         <a href="#" class="btn btn-success"><i class="fa-regular fa-square-plus mr-2"></i>Thêm người dùng</a>
      </div>
      <div class="col-12">
         <form action="" method="get">
            <div class="row">
               <div class="col-3">
                  <select name="status" id="" class="form-control">
                     <option value="0">Tất cả trạng thái</option>
                     <option value="1">Kích hoạt</option>
                     <option value="2">Chưa kích hoạt</option>
                  </select>
               </div>
               <div class="col-3">
                  <select name="group_id" id="" class="form-control">
                     <option value="0">Tất cả nhóm</option>
                  </select>
               </div>
               <div class="col-4">
                  <input type="text" class="form-control" placeholder="Từ khóa..." />
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
         <tr>
            <td><input type="checkbox" name="" id=""></td>
            <td>Tôn Thành Tâm</td>
            <td>tamtt1512@gmail.com</td>
            <td>Admin</td>
            <td><p class="badge badge-success">Kích hoạt</p></td>
            <td>04/04/2024 16:46:00</td>
            <td><a href="#" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
         </tr>
         <tr>
            <td><input type="checkbox" name="" id=""></td>
            <td>Tôn Thành Tâm</td>
            <td>tamtt1512@gmail.com</td>
            <td>Admin</td>
            <td><p class="badge badge-success">Kích hoạt</p></td>
            <td>04/04/2024 16:46:00</td>
            <td><a href="#" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
         </tr>
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