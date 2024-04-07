<?php 
namespace App;
use App\Core\{Routes, DB};
class App {
   private $__controller, $__action, $__params, $__routes, $__db;
   public static $app;

   public function __construct() {
      global $routes;
      if(!empty($routes['default_controller'])) {
         $this->__controller = ucfirst($routes['default_controller']);
      }
      $this->__action = 'index';
      $this->__params = [];
      $this->__routes = new Routes();

      if(class_exists('App\Core\DB')) {
         $dbOject = new DB();
         $this->__db = $dbOject->db;
      }

      self::$app = $this;
      var_dump(self::$app);

      $this->handleUrl();
   }

   public function getUrl() {
      $url = '/';
      if(!empty($_SERVER['PATH_INFO'])) {
         $url = $_SERVER['PATH_INFO'];
      }
      return $url;
   }

   public function handleUrl() {
      $url = $this->getUrl();
      $url = $this->__routes->handleRoutes($url);

      //middleware
      $this->handleRouteMiddleware($this->__routes->getRouteKey());
      $this->handleGlobalMiddleware();

      //share view
      $this->handleAppServiceProvider();      

      $urlArr = explode('/', $url);
      $urlArr = array_filter($urlArr);
      $urlArr = array_values($urlArr);
      
      $urlCheck = '';
      $namespaceCheck='App\Controllers';
      if(!empty($urlArr)) {
         $fileCheck = '';
         foreach($urlArr as $key=>$value) {
            $urlCheck .= $value."/";
            $fileCheck = rtrim($urlCheck, '/');
            $arrCheck = explode('/',$fileCheck);
            $arrCheck[count($arrCheck)-1] = ucfirst($arrCheck[count($arrCheck)-1]);
            $fileCheck = implode('/',$arrCheck);
            if(!empty($urlArr[$key-1])) {
               unset($urlArr[$key-1]);
            }

            if(file_exists('app/controllers/'.$fileCheck.'.php')) {
               $urlCheck = $fileCheck;
               break;
            } else {
               $namespaceCheck .= "\\".ucfirst($value);
            }
         }

         $urlArr = array_values($urlArr);
      }

      if(empty($urlCheck)) {
         $urlCheck = ucfirst($this->__controller);
      }
      if(!empty($urlArr[0])) {
         $this->__controller = ucfirst($urlArr[0]);
         unset($urlArr[0]);
      }
      $pathController = 'app/controllers/'.$urlCheck.'.php';
      if(file_exists($pathController)) {
         require_once($pathController);
         $className = "$namespaceCheck\\".$this->__controller;
         
         if(class_exists($className)) {
            $this->__controller = new $className();
            if(!empty($this->__db)) {
               $this->__controller->db = $this->__db;
            }
         } else {
            $this->loadError();
         }
         
      } else {
         $this->loadError();
      }

      if(!empty($urlArr[1])) {
         $this->__action = $urlArr[1];
         unset($urlArr[1]);
      }

      $urlArr = array_values($urlArr);
      if(!empty($urlArr)) {
         $this->__params = $urlArr;
      }

      if(method_exists($this->__controller, $this->__action)) {
         call_user_func_array(array($this->__controller, $this->__action), $this->__params);
      } else {
         $this->loadError();
      }

   }

   public function loadError($error = '404', $data= []) {
      extract($data);
      require_once ('app/errors/'.$error.'.php');
      die();
   }

   public function getCurrentController() {
      return $this->__controller;
   }

   public function handleRouteMiddleware($routeKey) {
      global $config;
      if(!empty($config['app']['routeMiddleware'])) {
         $routeMiddlewares = $config['app']['routeMiddleware'];
         foreach($routeMiddlewares as $key => $middleware) {
            $className = getNameClass($middleware);
            $path = 'app/middlewares/'.$className.'.php';
            if($key == $routeKey && file_exists($path)) {
               $middlewareObject = new $middleware();
               if(!empty($this->__db)) {
                  $middlewareObject->db = $this->__db;
               }
               $middlewareObject->handle();
               break;
            }
         }
      }
   }

   public function handleGlobalMiddleware() {
      global $config;
      if(!empty($config['app']['globalMiddleware'])) {
         $globalMiddlewares = $config['app']['globalMiddleware'];
         foreach($globalMiddlewares as $middleware) {
            $className = getNameClass($middleware);
            $path = 'app/middlewares/'.$className.'.php';
            if(file_exists($path)) {
               $middlewareObject = new $middleware();
               if(!empty($this->__db)) {
                  $middlewareObject->db = $this->__db;
               }
               $middlewareObject->handle();
               break;
            }
         }
      }
   }

   public function handleAppServiceProvider() {
      global $config;
      if(!empty($config['app']['boot'])) {
         $boots = $config['app']['boot'];
         foreach($boots as $boot) {
            $className = getNameClass($boot);
            $path = 'app/core/'.$className.'.php';
            if(file_exists($path)) {
               $bootObject = new $boot();
               if(!empty($this->__db)) {
                  $bootObject->db = $this->__db;
               }
               $bootObject->boot();
               break;
            }
         }
      }
   }
}