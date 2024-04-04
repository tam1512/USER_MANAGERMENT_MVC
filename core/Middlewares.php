<?php
namespace App\Core;
abstract class Middlewares {
   public $db;
   abstract function handle();
}