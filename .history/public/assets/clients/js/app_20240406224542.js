$(document).ready(function() {
   let checkAllUser = $('#checkAllUser');
   let listCheckItemUsers = $('.check-item-user');
   checkAllUser.click((e) => {
   let status = e.target.checked;
   listCheckItemUsers.each(function() {
      console.log($(this));
      $(this)[0].checked = status;
   })
   })
})