DANH SÁCH SẢN PHẨM
{!$title!}
@if (!empty($fullname))
<p>Họ và tên {{$fullname}}</p>
@elseif (!empty($title))
<p>title {{$title}}</p>
@else
<p>Không có gì</p>
@endif
@php
$i = 0;
@endphp
@while ($i < count($products))
<p>{!$products[$i]!}</p>
@php
$i++;
@endphp
@endwhile