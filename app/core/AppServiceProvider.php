<?php
namespace App\Core;
class AppServiceProvider extends ServiceProvider {
   public function boot() {
      $data['userInfo'] = $this->db->table('users')->where('id', '=', 1)->first();
      $data['copyright'] = 'Copyright (c) 2024';
      View::share($data);
   }
}