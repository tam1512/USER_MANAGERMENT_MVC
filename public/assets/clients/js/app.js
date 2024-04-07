$(document).ready(function() {
   let checkAllUser = $('#checkAllUser');
   if(checkAllUser) {
      let listCheckItemUsers = $('.check-item-user');
      let count = 0;
      let ids = [];
      checkAllUser.click((e) => {
         let status = e.target.checked;
         listCheckItemUsers.each(function() {
            $(this)[0].checked = status;
            ids.push($(this).val());
         })
         if(status) {
            count = listCheckItemUsers.length;
         } else {
            ids = [];
            count = 0;
         }
         renderDeleteBtn(count);
      })
   
      listCheckItemUsers.click((e) => {
         let status = e.target.checked;
         if(status) {
            ids.push(e.target.value);
            count++;
         } else {
            if(ids.includes(e.target.value)) {
               ids.splice(ids.indexOf(e.target.value), 1);
            }
            count--;
         }
         if(count === listCheckItemUsers.length) {
            checkAllUser[0].checked = true;
         } else {
            checkAllUser[0].checked = false;
         }
         renderDeleteBtn(count);
      })

      function renderDeleteBtn(count) {
         let btn = $('.btn-delete-multi-user');
         if(count > 0) {
            btn.removeClass('disabled');
            btn.children('span').text(count);
         } else {
            btn.addClass('disabled');
            btn.children('span').text(count);
         }
      }

      let btn = $('.btn-delete-multi-user');
      if(btn) {
         btn.click(e => {
            e.preventDefault();
            if(!btn.hasClass('disabled')) {
               //use sweetalert2
               const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger mr-2"
                  },
                  buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                  title: "Bạn chắc chắn muốn xóa?",
                  text: "Hành động sẽ không thể khôi phục!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Xác nhận xóa",
                  cancelButtonText: "Hủy hành động",
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {
                     $.ajax({
                        url: `${root}/nguoi-dung/xoa`,
                        method: 'post',
                        data: {ids},
                        success: function(data) {
                           if(data == 'true') {
                              swalWithBootstrapButtons.fire({
                                title: "Đã xóa thành công!",
                                text: "Các người dùng được chọn đã được xóa khỏi hệ thống",
                                icon: "success"
                              }).then((result) => {
                                 if(result.isConfirmed) {
                                    location.reload();
                                 }
                              });
                           } else {
                              swalWithBootstrapButtons.fire({
                                 title: "Không thể xóa!",
                                 text: "Lỗi hệ thống. Vui lòng thử lại sau",
                                 icon: "warning"
                               });
                           }
                        }
                     })
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire({
                      title: "Đã hủy hành động",
                      text: "Các người dùng tạm thời an toàn khỏi bạn :)",
                      icon: "error"
                    });
                  }
                });
            }
         })
      }
   }
})