<?php 
define("_WEB_PATH_ROOT", __DIR__);

//xử lý lấy ra web root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
   $protocol = 'https://';
} else {
   $protocol = 'http://';
}

$docRoot =  str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);
$pathRoot = str_replace('\\','/',_WEB_PATH_ROOT);
$path = preg_replace('~^'.$docRoot.'~', '', $pathRoot);
define("_WEB_HOST_ROOT", $protocol.$_SERVER['HTTP_HOST'].$path);

//load all config
$dataConfig = scandir('configs');
if(!empty($dataConfig)) {
   unset($dataConfig[0]);
   unset($dataConfig[1]);

   foreach($dataConfig as $item) {
      $path = "configs/$item";
      if(file_exists($path)) {
         require_once $path;
      }
   }
}

//load config Database and core database
if(!empty($config['database'])) {
   $config_data = $config['database'];
   
   if(!empty($config_data)) {
      require_once('core/Connection.php');
      require_once('core/QueryBuilder.php');
      require_once('core/Database.php');
      require_once('core/DB.php');
   }
}

//load all helpers
$dataHelper = scandir('app/helpers');
if(!empty($dataHelper)) {
   unset($dataHelper[0]);
   unset($dataHelper[1]);

   foreach($dataHelper as $item) {
      $path = "app/helpers/$item";
      if(file_exists($path)) {
         require_once $path;
      }
   }
}

//load all services
if(!empty($config['app']['services'])) {
   $allServices = $config['app']['services'];
   if(!empty($allServices)) {
      foreach($allServices as $service) {
         $className = getNameClass($service);
         $path = 'app/core/'.$className.'.php';
         if(file_exists($path)) {
            require_once($path);
      }
   }
}
}


// load core hash
require_once('core/Hash.php');

// load core routes
require_once('core/Routes.php');

//load core session
require_once('core/Session.php');

//load core helper
require_once('core/Helper.php');

//load core request
require_once('core/Request.php');

//load core response
require_once('core/Response.php');

//load core model
require_once('core/Model.php');

//load core template
require_once('core/Template.php');

//load core controller
require_once('core/Controller.php');

//load core load
require_once('core/Load.php');

//load core load
require_once('core/View.php');

//load core load
require_once('core/ServiceProvider.php');

//load core load
require_once('app/core/AppServiceProvider.php');

//load core middlewares
require_once('core/Middlewares.php');

//load all middlewares
$dataMiddlewares = scandir('app/middlewares');
if(!empty($dataMiddlewares)) {
   unset($dataMiddlewares[0]);
   unset($dataMiddlewares[1]);

   foreach($dataMiddlewares as $item) {
      $path = "app/middlewares/$item";
      if(file_exists($path)) {
         require_once $path;
      }
   }
}

//load app
require_once('app/App.php');