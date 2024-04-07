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
         @for($i = $begin; $i <= $end; $i++)
            <li class="page-item{{($page==$i ? ' active' : false)}}">
               <a class="page-link" href="{{$self::getLinkPage($i, $isQuery)}}">{{$i}}</a>
            </li>';
         @endfor
      @endif


      <li class="page-item"><a class="page-link" href="{{$linkNext}}">Sau</a></li>
   </ul>
</nav>;