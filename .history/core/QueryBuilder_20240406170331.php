<?php
namespace App\Core;
trait QueryBuilder {
   private $tableName = '';
   private $where = '';
   private $field = '*';
   private $join = '';
   private $limit = '';
   private $orderBy = '';

   private $sqlPaginate = '';

   public function table($tableName) {
      $this->tableName = $tableName;
      return $this;
   } 

   public function select($field) {
      $this->field = $field;
      return $this;
   }

   public function where($field, $compare="", $value="") {
      if($field instanceof \Closure) {
         $this->where .= ' (';
         $callback = $field;
         call_user_func_array($callback, [$this]);
         $this->where .= ')';
      } else {
         if(empty($this->where) || $this->where == ' (') {
            $this->where .= " WHERE $field $compare '$value'";
         } else {
            $this->where .= " AND $field $compare '$value'";
         }
      }
      return $this;
   }

   public function orWhere($field, $compare='', $value='') {
      if($field instanceof \Closure) {
         $this->where .= ' (';
         $callback = $field;
         call_user_func_array($callback, [$this]);
         $this->where .= ')';
      } else {
         if(empty($this->where) || $this->where == ' (') {
            $this->where .= " WHERE $field $compare '$value'";
         } else {
            $this->where .= " OR $field $compare '$value'";
         }
      }
      return $this;
   }

   public function whereLike($field, $value) {
      if(empty($this->where) || $this->where == ' (') {
         $this->where .= " WHERE $field LIKE '$value'";
      } else {
         $this->where .= " AND $field LIKE '$value'";
      }
      return $this;
   }

   public function limit($number, $offset = 0) {
      $this->limit = " LIMIT $offset, $number";
      return $this;
   }

   public function orderBy($field, $type='ASC') {
      $fieldArr = array_filter(explode(',', $field));
      if(!empty($fieldArr) && count($fieldArr) >= 2) {
         //ORDER BY id ASC, fullname DESC (multi order by)
         $this->orderBy = " ORDER BY ".implode(', ', $fieldArr);
      } else {
         //ORDER BY id ASC
         $this->orderBy = " ORDER BY $field $type";
      }
      return $this;
   }
   public function join($name, $condition) {
         $this->join .= " INNER JOIN $name ON $condition";
         return $this;
   }

   public function leftJoin($name, $condition) {
         $this->join .= " LEFT JOIN $name ON $condition";
         return $this;
   }

   public function rightJoin($name, $condition) {
         $this->join .= " RIGHT JOIN $name ON $condition";
         return $this;
   }

   public function fullJoin($name, $condition) {
         $this->join .= " FULL OUTER JOIN $name ON $condition";
         return $this;
   }

   public function paginate($limit) {
      $request = new Request();
      $fields = $request->getFields();
      $page = !empty($fields['page']) && $fields['page'] > 0 ? $fields['page'] : 1;
      $pathInfo = trim($_SERVER['PATH_INFO'], '/');
      $queryStr =  $_SERVER['QUERY_STRING'];
      if(filter_var($page, FILTER_VALIDATE_INT)) {
         $offset = ($page - 1) * $limit;
         $data = $this->limit($limit, $offset)->get();         
         $paginateView = $this->getPaginateView($limit, $page);
         if(empty($data)) {
            $queryStr = preg_replace('/page\s*=\s*'.$page.'/', 'page=1', $queryStr);
            $uri = $pathInfo.'/?'.$queryStr;
            // echo $uri;
            $response = new Response();
            $response->redirect($uri);
         }
         return  [
                     'data' => $data,
                     'links' => $paginateView
                  ];
      } else {
            $queryStr = preg_replace('/page\s*=\s*'.$page.'/', 'page=1', $queryStr);
            $uri = $pathInfo.'/?'.$queryStr;
            // echo $uri;
            $response = new Response();
            $response->redirect($uri);
      }
   }

   private function getPaginateView($limit, $page) {
      var_dump($page);  
      $pathInfo = trim($_SERVER['PATH_INFO'], '/');
      $queryStr =  $_SERVER['QUERY_STRING'];
      preg_match('/page\s*=\s*('.$page.')/', $queryStr, $matches);
      if(empty($matches[0])) {
         if(empty($queryStr)) {
            $queryStr = "page=$page";
         } else {
            $queryStr .= "&page=$page";
         }
      }

      $count = $this->getRows($this->sqlPaginate);
      $this->sqlPaginate = '';
      $isDisablePrev = false;
      
      $numberPage = ceil($count / $limit);
      if($page <= 1 && $page >= $numberPage) {
         $queryStrPrev = preg_replace('/page\s*=\s*'.$page.'/', 'page=1', $queryStr);
         $queryStrNext = preg_replace('/page\s*=\s*'.$page.'/', 'page=1', $queryStr);
         $isDisablePrev = true;
      } else {
         $queryStrPrev = preg_replace('/page\s*=\s*'.$page.'/', 'page='.($page-1), $queryStr);
         $queryStrNext = preg_replace('/page\s*=\s*'.$page.'/', 'page='.($page+1), $queryStr);
      }

      $uriPrev = '/'.$pathInfo.'/?'.$queryStrPrev;
      $uriNext = '/'.$pathInfo.'/?'.$queryStrNext;

      $html = '<nav class="d-flex justify-content-end '.($isDisablePrev ? 'disabled' : false).'"><ul class="pagination"><li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT.$uriPrev.'">Trước</a></li>';
         
      for($i = 1; $i < $numberPage; $i++) {
         $html .= '<li class="page-item"><a class="page-link" href="'.$this->getLinkPage($page, $i).'">'.$i.'</a></li>';
      }

      $html .= '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT.$uriNext.'">Sau</a></li></ul> </nav>';
      return $html;
   }

   private function getLinkPage($page, $pageChange) {
      $pathInfo = trim($_SERVER['PATH_INFO'], '/');
      $queryStr =  $_SERVER['QUERY_STRING'];
      $uri = '/'.$pathInfo;
      if(!empty($page)) {
         $queryStr = preg_replace('/page\s*=\s*'.$page.'/', 'page='.$pageChange, $queryStr);
         $uri .= '/?'.$queryStr;
      } else {
         if(!empty($queryStr)) {
            $uri .= '/?'.$queryStr.'&page=1';
         } else {
            $uri .= '/?page=1';
         }

      }
      return _WEB_HOST_ROOT.$uri;
   }
   public function get() {
      $sql = "SELECT $this->field FROM $this->tableName $this->join $this->where $this->orderBy $this->limit;";
      $this->sqlPaginate = "SELECT $this->field FROM $this->tableName $this->join $this->where;";
      $sql = $this->handleWhereGroup($sql);
      $this->resetQueryBuilder();
      return $this->getRaw($sql);
   }

   public function first() {
      $sql = "SELECT $this->field FROM $this->tableName $this->join $this->where $this->orderBy $this->limit;";
      $sql = $this->handleWhereGroup($sql);
      $this->resetQueryBuilder();
      return $this->firstRaw($sql);
   }

   public function insert($data) {
      return $this->insertData($this->tableName, $data);
   }

   public function lastId() {
      return $this->lastInsertId();
   }

   public function update($data) {
      $condition = trim(trim($this->where), 'WHERE');
      return $this->updateData($this->tableName, $data, $condition);
   }

   public function delete() {
      $condition = trim(trim($this->where), 'WHERE');
      return $this->deleteData($this->tableName, $condition);
   }

   public function count() {
      $sql = "SELECT $this->field FROM $this->tableName $this->join $this->where $this->orderBy $this->limit;";
      $sql = $this->handleWhereGroup($sql);
      $this->resetQueryBuilder();
      return $this->getRows($sql);
   }
   private function resetQueryBuilder() {
      $this->tableName = '';
      $this->where = '';
      $this->field = '*';
      $this->join = '';
      $this->limit = '';
      $this->orderBy = '';
   }

   private function handleWhereGroup($sql) {
     $sql = preg_replace('~\( OR~', 'OR (', $sql);
     $sql =preg_replace('~\( AND~', 'AND (', $sql);
     $sql = preg_replace('~\( WHERE~', 'WHERE (', $sql);

     return $sql;
   }
}
//26/10/2020