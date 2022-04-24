


@if ($paginator->hasPages())
    <ul class="pagination">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a><span aria-hidden="true">上一页</span></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span aria-hidden="true">上一页</span></a></li>
        @endif

        @if($paginator->currentPage() >= 5)

            @if(($paginator->lastPage() - $paginator->currentPage()) >= 2)

                <li><a href="{{ $paginator->url($paginator->currentPage()-2) }}">{{ $paginator->currentPage()-2 }}</a></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()-1) }}">{{ $paginator->currentPage()-1 }}</a></li>
                <li class="active"><span>{{ $paginator->currentPage() }}</span></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()+1) }}">{{ $paginator->currentPage()+1 }}</a></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()+2) }}">{{ $paginator->currentPage()+2 }}</a></li>
            @elseif(($paginator->lastPage() - $paginator->currentPage()) >= 1)

                <li><a href="{{ $paginator->url($paginator->currentPage()-3) }}">{{ $paginator->currentPage()-3 }}</a></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()-2) }}">{{ $paginator->currentPage()-2 }}</a></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()-1) }}">{{ $paginator->currentPage()-1 }}</a></li>
                <li class="active"><span>{{ $paginator->currentPage() }}</span></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()+1) }}">{{ $paginator->currentPage()+1 }}</a></li>
            @else

                <li><a href="{{ $paginator->url($paginator->currentPage()-4) }}">{{ $paginator->currentPage()-4 }}</a></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()-3) }}">{{ $paginator->currentPage()-3 }}</a></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()-2) }}">{{ $paginator->currentPage()-2 }}</a></li>
                <li><a href="{{ $paginator->url($paginator->currentPage()-1) }}">{{ $paginator->currentPage()-1 }}</a></li>
                <li class="active"><span>{{ $paginator->currentPage() }}</span></li>
            @endif



        @else
            @if($paginator->lastPage() >= 5)
                @for($i = 1; $i <= 5; ++$i)
                    @if($paginator->currentPage() == $i)
                        <li class="active"><span>{{ $paginator->currentPage() }}</span></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
            @else
                @for($i = 1; $i <= $paginator->lastPage(); ++$i)
                    @if($paginator->currentPage() == $i)
                        <li class="active"><span>{{ $paginator->currentPage() }}</span></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
            @endif


        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><span aria-hidden="true">下一页</span></a></li>
        @else
            <li class="disabled"><a><span aria-hidden="true">下一页</span></a></li>
        @endif

    </ul>
@endif


