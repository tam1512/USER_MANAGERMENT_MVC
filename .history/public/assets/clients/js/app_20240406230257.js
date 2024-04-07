$(document).ready(function() {
   let checkAllUser = $('#checkAllUser');
   if(checkAllUser) {
      let listCheckItemUsers = $('.check-item-user');
      let count = 0;
      checkAllUser.click((e) => {
         let status = e.target.checked;
         listCheckItemUsers.each(function() {
            $(this)[0].checked = status;
         })
         if(status) {
            count = listCheckItemUsers.length;
         } else {
            count = 0;
         }
         renderDeleteBtn(count);
      })
   
      listCheckItemUsers.click((e) => {
         let status = e.target.checked;
         if(status) {
            count++;
         } else {
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
            btn.children('span').contents(count);
         } else {
            btn.addClass('disabled');
         }
      }
   }

   
})