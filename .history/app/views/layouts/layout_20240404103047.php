<?php
   $this->render('blocks\clients\header', $header_content);
   $this->render('blocks\clients\sidebar');
   $this->render($content, $sub_content);
   $this->render('blocks\clients\footer', $footer_content);
   ?>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="{{_WEB_HOST_ROOT}}/public/assets/clients/js/app.js"></script>
</body>
</html>