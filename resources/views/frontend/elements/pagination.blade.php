@isset($paginator)
    @if($paginator->hasPages())
        <ul class="pagination" style="overflow: scroll;">
            @if(!$paginator->onFirstPage())
                <li class="disabled">
                    <span class="arrow" aria-hidden="true">
                        &lsaquo;
                        <span>
                            {{ __('pagination.previous') }}
                        </span>
                    </span>
                </li>
            @endif
            @foreach($elements as $element)
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true">
                        <span>
                            {{ $element }}
                        </span>
                    </li>
                @endif
                @if(is_array($element))
                    @foreach($element as $page => $url)
                        @if($page === $paginator->currentPage())
                            <li class="active">
                                <span>
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if($paginator->hasMorePages())
                <li>
                    <a class="arrow" href="#" rel="next">
                        <span>
                            {{ __('pagination.next') }}
                        </span>
                        &rsaquo;
                    </a>
                </li>
            @endif
        </ul>
    @endif
@endisset