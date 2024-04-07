<?php
namespace App\Controllers;
use App\Core\{Controller, Request, Response, Session, View};
class Home extends Controller {
   private $model, $data = [];
   public function __construct() {
      $this->model = $this->model("Home");
   }
   public function index() {
      
   }
}