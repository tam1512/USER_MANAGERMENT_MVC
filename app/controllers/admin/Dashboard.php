<?php 
namespace App\Controllers\Admin;
class Dashboard {
   public function index() {
      echo "Dashboard Index";
   }

   public function detail($id=0) {
      echo "Dashboard Detail - Id : $id";
   }
}