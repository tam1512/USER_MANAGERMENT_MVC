<?php
namespace App\Core;

class Paginate {
   private static function render($numberPage, $page, $limitPagination, $isQuery) {
      $isDisablePrev = false;
      if($page <= 1) {
         $linkPrev = $this->getLinkPage(1, $isQuery);
         $isDisablePrev = true;
      } else {
         $linkPrev = $this->getLinkPage($page-1, $isQuery);
      }

      if($page >= $numberPage) {
         $linkNext = $this->getLinkPage(1, $isQuery);
      } else {
         $linkNext = $this->getLinkPage($page+1, $isQuery);
      }

      $begin = $page - 2;
      if($begin < 1) {
         $begin = 1;
      }
      $end = $begin + $limitPagination - 1;
      if($end >= $numberPage) {
         $end = $numberPage;
         $begin = $end - $limitPagination + 1;
      }


      $html = '<nav class="d-flex justify-content-end"><ul class="pagination pagination-sm'.($numberPage <=1 ? ' d-none': false).'"><li class="page-item'.($isDisablePrev ? ' disabled' : false).'"><a class="page-link" href="'.$linkPrev.'">Trước</a></li>';
      
      if($numberPage <= $limitPagination) {
         for($i = 1; $i <= $numberPage; $i++) {
            $html .= '<li class="page-item'.($page==$i ? ' active' : false).'"><a class="page-link" href="'.$this->getLinkPage($i, $isQuery).'">'.$i.'</a></li>';
         }
      } else {
         for($i = $begin; $i <= $end; $i++) {
            $html .= '<li class="page-item'.($page==$i ? ' active' : false).'"><a class="page-link" href="'.$this->getLinkPage($i, $isQuery).'">'.$i.'</a></li>';
         }
      }


      $html .= '<li class="page-item"><a class="page-link" href="'.$linkNext.'">Sau</a></li></ul> </nav>';
      return $html;
   }

   private static function getLinkPage($page, $isQuery) {
      $pathInfo = trim($_SERVER['PATH_INFO'], '/');
      $uri = '/'.$pathInfo;
      if($isQuery && !empty($_SERVER['QUERY_STRING'])) {
         $queryStr = $_SERVER['QUERY_STRING'];
         parse_str($queryStr, $params);
      }
      $params['page'] = $page;

      $link = http_build_query($params);
      $link = preg_match('/\?/', $link) ? '/'.$link : '/?'.$link; 
      $uri.=$link;
      return _WEB_HOST_ROOT.$uri;
   }

}