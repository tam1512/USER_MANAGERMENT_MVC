$(document).ready(function() {
   let checkAllUser = $('#checkAllUser');
   let listCheckItemUsers = $('.check-item-user');
   checkAllUser.click((e) => {
   let status = e.target.checked;
   listCheckItemUsers.each(function() {
      $(this)[0].checked = status;
   })
   })
})