<nav class="d-flex justify-content-end">
   <ul class="pagination pagination-sm{{$numberPage <=1 ? ' d-none': false}}">
      <li class="page-item{{$isDisablePrev ? ' disabled' : false}}">
         <a class="page-link" href="{{$linkPrev}}">Trước</a>
      </li>
      
      @if($numberPage <= $limitPagination)
         @for($i = 1; $i <= $numberPage; $i++)
            <li class="page-item{{($page==$i ? ' active' : false)}}">
               <a class="page-link" href="{{$self::getLinkPage($i, $isQuery)}}">{{$i}}</a>
            </li>
         @endfor
      @else
         @if($begin != 1) 
            <li class="page-item{{($page==1 ? ' active' : false)}}">
               <a class="page-link" href="{{$self::getLinkPage(1, $isQuery)}}">1</a>
            </li>
         @endif
         @if($begin > 2)
            <li class="page-item disabled">
               <span>...</span>
            </li>
         @endif
         @for($i = $begin; $i <= $end; $i++)
            <li class="page-item{{($page==$i ? ' active' : false)}}">
               <a class="page-link" href="{{$self::getLinkPage($i, $isQuery)}}">{{$i}}</a>
            </li>
         @endfor
         @if($end < $numberPage - 1)
            <li class="page-item disabled">
               <span>...</span>
            </li>
         @endif
         @if($end < $numberPage) 
            <li class="page-item{{($page==$numberPage ? ' active' : false)}}">
               <a class="page-link" href="{{$self::getLinkPage($numberPage, $isQuery)}}">{{$numberPage}}</a>
            </li>
         @endif
      @endif


      <li class="page-item"><a class="page-link" href="{{$linkNext}}">Sau</a></li>
   </ul>
</nav>