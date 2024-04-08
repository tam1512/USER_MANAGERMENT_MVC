<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $title ?></title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container-fluid">
      <?php $this->render($content, $sub_content) ?>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      let msg = "<?php echo !empty($message) ? $message : ''?>"
      let msgType = "<?php echo !empty($msg_type) ? $msg_type : ''?>"

      if(msg && msgType) {
         Swal.fire({
            title: "Thông báo!!",
            text: msg,
            icon: msgType
         })
      }

   </script>
</body>
</html>