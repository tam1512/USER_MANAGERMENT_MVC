<?php
   $this->render('blocks\clients\header', $header_content);
?>
   <main class="py-3">
      <div class="row">
         <div class="col-3">
            <?php
            $this->render('blocks\clients\sidebar');
            ?>
         </div>
         <div class="col-9">
            <?php
            $this->render($content, $sub_content);
            ?>
         </div>
      </div>
   </main>
      
   <?php
      $this->render('blocks\clients\footer', $footer_content);
   ?>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="{{_WEB_HOST_ROOT}}/public/assets/clients/js/app.js"></script>
</body>
</html>