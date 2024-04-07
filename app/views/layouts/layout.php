<?php
   $this->render('blocks\clients\header', $header_content);
   $this->render('blocks\clients\sidebar');
   $this->render($content, $sub_content);
   $this->render('blocks\clients\footer', $footer_content);
?>