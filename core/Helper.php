<?php
use App\core\Session;
$errors = Session::flash('errors');
$old = Session::flash('old');

if(!function_exists('form_error')) {
   function form_error($fieldName, $before='', $after='') {
      global $errors;
      if(!empty($errors[$fieldName])) {
         return $before.'<i>'.$errors[$fieldName].'</i>'.$after;
      }
      return false;
   }
}

if(!function_exists('old')) {
   function old($fieldName, $default = '') {
      global $old;
      if(!empty($old[$fieldName])) {
         return $old[$fieldName];
      }
      return $default;
   }
}