<?php
namespace App\Core;

class Paginate {
   public static function render($numberPage, $page, $limitPagination, $isQuery) {
      $isDisablePrev = false;
      if($page <= 1) {
         $linkPrev = self::getLinkPage(1, $isQuery);
         $isDisablePrev = true;
      } else {
         $linkPrev = self::getLinkPage($page-1, $isQuery);
      }

      if($page >= $numberPage) {
         $linkNext = self::getLinkPage(1, $isQuery);
      } else {
         $linkNext = self::getLinkPage($page+1, $isQuery);
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

      $data = [
         'page' =>$page,
         'numberPage' => $numberPage,
         'isDisablePrev' => $isDisablePrev,
         'linkPrev' => $linkPrev,
         'linkNext' => $linkNext,
         'limitPagination' => $limitPagination,
         'begin' => $begin,
         'end' => $end,
         'isQuery' => $isQuery,
         'self' => __CLASS__
      ];

      Load::render('paginate/paginate', $data);
   }

   public static function getLinkPage($page, $isQuery) {
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