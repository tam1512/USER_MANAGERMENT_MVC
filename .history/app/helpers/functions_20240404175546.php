<?php 
   function getNameClass($namespace) {
      if(preg_match('~\\\~', $namespace)) {
         $namespaceArr = explode('\\', $namespace);
         $className = end($namespaceArr);
      } else {
         $className = $namespace;
      }
      return $className;
   }

   function getDateFormat($date, $format) {
      if(!empty($date)) {
         $dataObj = date_create($date);
         return date_format($dataObj, $format);
      }
      return false;s
   }