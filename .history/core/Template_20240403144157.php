<?php
namespace App\Core;

class Template {
   private $__content;
   public function run($content, $data=[]) {
      extract($data);
      $this->__content = $content;
      if(!empty($this->__content)) {
         $this->useNamespace();
         $this->printEntities();
         $this->printRaw();
         $this->printArr();
         $this->ifCondition();   
         $this->beforePHP();   
         $this->afterPHP();   
         $this->foreachLoop();   
         $this->forLoop();   
         $this->whileLoop();   
         echo $this->__content;
         eval(' ?>'.$this->__content.'<?php ');
      }
   }
   private function printEntities() {
      $pattern = '~{\s*{\s*(.+?)\s*}\s*}~';
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php echo htmlentities($1); ?>', $this->__content);
      }
   }

   private function printRaw() {
      $pattern = '~{\s*\!\s*(.+?)\s*\!\s*}~';
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php echo $1; ?>', $this->__content);
      }
   }

   private function ifCondition() {
      //if
      $pattern = ('~@if\s*\((.+)\)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php if ($1): ?>', $this->__content);
      }
      //elseif
      $pattern = ('~@elseif\s*\((.+)\)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php elseif ($1): ?>', $this->__content);
      }

      //else
      $pattern = ('~(@else)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php else: ?>', $this->__content);
      }

      //endif
      $pattern = ('~(@endif)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php endif; ?>', $this->__content);
      }
   }

   private function useNamespace() {
      $pattern = ('~@use\s*\((.+)\)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php use $1; ?>', $this->__content);
      }
   }

   private function beforePHP() {
      $pattern = ('~(@php)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,'<?php ', $this->__content);
      }
   }

   private function afterPHP() {
      $pattern = ('~(@endphp)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' ?>', $this->__content);
      }
   }

   private function whileLoop() {
      $pattern = ('~@while\s*\((.+)\)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' <?php while($1): ?>', $this->__content);
      }

      $pattern = ('~(@endwhile)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' <?php endwhile; ?>', $this->__content);
      }
   }
   private function forLoop() {
      $pattern = ('~@for\s*\((.+)\)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' <?php for($1): ?>', $this->__content);
      }

      $pattern = ('~(@endfor)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' <?php endfor; ?>', $this->__content);
      }
   }
   private function foreachLoop() {
      $pattern = ('~@foreach\s*\((.+)\)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' <?php foreach($1): ?>', $this->__content);
      }

      $pattern = ('~(@endforeach)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' <?php endforeach; ?>', $this->__content);
      }
   }

   private function printArr() {
      $pattern = ('~@array\s*\((.+)\)~');
      preg_match_all($pattern, $this->__content, $matches);
      if(!empty($matches[1])) {
         $this->__content = preg_replace($pattern,' <?php echo "<pre>"; print_r($1); echo "</pre>"; ?>', $this->__content);
      }
   }
}