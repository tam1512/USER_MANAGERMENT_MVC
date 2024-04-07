<?php
namespace App\Core;
use App\App;
class Request {
   private $__rules, $__messages, $__errors;
   private $db;
   public function __construct() {
      $this->db = new Database();
   }
   public function getMethod() {
      return strtolower($_SERVER['REQUEST_METHOD']);
   }

   public function isGet() {
      if($this->getMethod() == 'get') {
         return true;
      }
      return false;
   }

   public function isPost() {
      if($this->getMethod() == 'post') {
         return true;
      }
      return false;
   }

   public function getFields() {
      $dataFields = [];
      if($this->isGet()) {
         if(!empty($_GET)) {
            foreach($_GET as $key => $value) {
               if(is_array($value)) {
                  $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
               } else {
                  $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
               }
            }
         }
      }
      if($this->isPost()) {
         if(!empty($_POST)) {
            foreach($_POST as $key => $value) {
               if(is_array($value)) {
                  $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
               } else {
                  $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               }
            }
         }
      }
      return $dataFields;
   }

   public function rules($rules = []) {
      $this->__rules = array_filter($rules);
   }

   public function messages($messages = []) {
      $this->__messages = array_filter($messages);
   }

   public function validate() {
      $isValidate = true;
      $dataFields = $this->getFields();
      if(!empty($this->__rules)) {
         foreach($this->__rules as $fieldName => $rule) {
            $ruleArr = explode('|', $rule);
            foreach($ruleArr as $ruleItem) {
               $ruleItemArr = explode(':', $ruleItem);
               $ruleName = reset($ruleItemArr);
               if(count($ruleItemArr) > 1) {
                  $ruleValue = end($ruleItemArr);
               }

               if($ruleName == 'required') {
                  if(empty(trim($dataFields[$fieldName]))) {
                     $this->setError($fieldName, $ruleName);
                     $isValidate = false;
                  }
               }

               if($ruleName == 'min') {
                  if(strlen($dataFields[$fieldName]) < $ruleValue) {
                     $this->setError($fieldName, $ruleName);
                     $isValidate = false;
                  }
               }

               if($ruleName == 'max') {
                  if(strlen($dataFields[$fieldName]) > $ruleValue) {
                     $this->setError($fieldName, $ruleName);
                     $isValidate = false;
                  }
               }

               if($ruleName == 'email') {
                  $patternEmail = '/^[a-z][\w_\-.]{2,}@[a-z][\w_\-.]*\.[a-z]{2,}$/i';
                  if(!preg_match($patternEmail, $dataFields[$fieldName])) {
                     $this->setError($fieldName, $ruleName);
                     $isValidate = false;
                  }
               }

               if($ruleName == 'match') {
                  if($dataFields[$fieldName] != $dataFields[$ruleValue]) {
                     $this->setError($fieldName, $ruleName);
                     $isValidate = false;
                  }
               }

               if($ruleName == 'unique') {
                  if(count($ruleItemArr) >= 3) {
                     $tableName = $ruleItemArr[1];
                     $fieldCheck = $ruleItemArr[2];
                  }
                  if(count($ruleItemArr) == 3) {
                     $count = $this->db->table($tableName)->select($fieldCheck)->where($fieldCheck, '=', $dataFields[$fieldName])->count();
                     if(!empty($count)) {
                        $this->setError($fieldName,$ruleName);
                        $isValidate = false;
                     }
                  }
                  if(count($ruleItemArr) == 4) {
                     $condition = $ruleItemArr[3];
                     if(preg_match('~.+?=.+?~is', $condition)) {
                        $conditionArr = explode('=', $condition);
                        $count = $this->db->table($tableName)->select($fieldCheck)->where($fieldCheck, '=', $dataFields[$fieldName])->where(reset($conditionArr), '<>', end($conditionArr))->count();
                     if(!empty($count)) {
                        $this->setError($fieldName,$ruleName);
                        $isValidate = false;
                     }
                     }
                  } 
               }

               if(preg_match('~^callback_(.+)~is', $ruleName, $ruleNameArr)) {
                  if(!empty($ruleNameArr[1])) {
                     $methodName = $ruleNameArr[1];
                     $controller = App::$app->getCurrentController();
                     if(method_exists($controller, $methodName)) {
                        $status = call_user_func_array([$controller, $methodName], [$dataFields[$fieldName]]);

                        if(!$status) {
                           $this->setError($fieldName, $ruleName);
                           $isValidate = false;
                        }
                     }
                  }
               }
            }
         }
      }
      Session::flash('errors', $this->error());
      Session::flash('old', $this->getFields());
      return $isValidate;
   }

   public function setError($fieldName, $ruleName) {
      $this->__errors[$fieldName][$ruleName] = $this->__messages[$fieldName.'.'.$ruleName];
   }

   public function error($fieldName = "") {
      if(empty($fieldName)) {
         $errorsArr = [];
         foreach($this->__errors as $key => $error) {
            $errorsArr[$key] = reset($error);
         }
         return $errorsArr;
      }
      if(!empty($this->__errors[$fieldName])) {
         return reset($this->__errors[$fieldName]);
      }
      return false;
   }
}