$(document).ready(function() {
   let checkAllUser = $('#checkAllUser');
   let listCheckItemUsers = $('.check-item-user');
   checkAllUser.click((e) => {
      let status = e.target.checked;
      console.log(status);
      if(status) {
         listCheckItemUsers.each(item => {
            item.checked;
         })
      }
   })
})