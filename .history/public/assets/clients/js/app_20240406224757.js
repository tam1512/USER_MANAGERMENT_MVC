$(document).ready(function() {
   let checkAllUser = $('#checkAllUser');
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
   })

   listCheckItemUsers.click((e) => {
      console.log(e.target.checked);
   })
})