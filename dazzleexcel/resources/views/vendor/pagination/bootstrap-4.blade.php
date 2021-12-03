@if ($paginator->hasPages())
<nav class="pagination">
    @if ($paginator->onFirstPage())
        <a class="prev page-numbers"><i class="fa fa-angle-left"></i></a>
    @else
      <a class="prev page-numbers" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <a class="prev page-numbers"><i class="fa fa-angle-left"></i></a>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                 @if ($page == $paginator->currentPage())
                 <span class="page-numbers current">{{ $page }}</span>
                 @else
                  <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                 @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
    @else
     <a class="next page-numbers"><i class="fa fa-angle-right"></i></a>
    @endif


</nav>
@endif




