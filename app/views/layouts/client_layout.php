<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $title ?></title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT ?>/public/assets/clients/css/style.css">
</head>
<body>
   <?php 
      $this->render('blocks\clients\header');

      $this->render($content, $sub_content);

      $this->render('blocks\clients\footer');
   ?>
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo _WEB_HOST_ROOT ?>/public/assets/clients/js/app.js"></script>
</body>
</html>