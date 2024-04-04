<?php
namespace App\Core;
abstract class ServiceProvider {
   public $db;
   abstract function boot();
}