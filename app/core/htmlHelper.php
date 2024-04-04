<?php
namespace App\Core;
class htmlHelper {
   static function openForm($method='get', $action ='') {
      echo '<form method="'.$method.'" action="'.$action.'">';
   }
   static function closeForm() {
      echo '</form>';
   }

   static function input($before='', $after='', $type='text', $name, $value='', $class='', $id='', $placeholder='') {
      echo $before.'<input type="'.$type.'" class="'.$class.'" id="'.$id.'" name="'.$name.'" value ="'.$value.'" placeholder="'.$placeholder.'">'.$after;
   }

   static function button($before="", $after='', $type='button', $class='', $id='', $content, $name='') {
      echo $before.'<button type="'.$type.'" class="'.$class.'" id="'.$id.'" name="'.$name.'">'.$content.'</button>'.$after;
   }
}