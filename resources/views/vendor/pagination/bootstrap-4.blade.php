@if ($paginator->hasPages())
    <ul class="pagination" role="navigation" style="overflow: auto">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if($page == 1)
                        @php
                            $url = str_replace('?page=1', '', $url);
                        @endphp
                    @endif
                    @if ($page === 1 && $paginator->currentPage() > 1)
                        <li class="page-item">
                            <a href="{{ $url }}" class="page-link  page-first">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <line x1="8.8" y1="9.10352" x2="8.8" y2="0.103516" stroke="black"
                                          stroke-width="0.9"/>
                                    <path d="M3.79375 8.37227L0.41875 4.99727C0.30625 4.88477 0.25 4.77227 0.25 4.60352C0.25 4.43477 0.30625 4.32227 0.41875 4.20977L3.79375 0.834766C4.01875 0.609766 4.35625 0.609766 4.58125 0.834766C4.80625 1.05977 4.80625 1.39727 4.58125 1.62227L1.6 4.60352L4.58125 7.58476C4.80625 7.80977 4.80625 8.14727 4.58125 8.37227C4.35625 8.59727 4.01875 8.59727 3.79375 8.37227Z"
                                          fill="black"/>
                                </svg>
                            </a>
                        </li>
                    @endif
                    @if ($page == 1 && $paginator->currentPage() > 1)
                        <li class="page-item">
                            @if($page == 1)
                                @php
                                    $previousPageUrl = str_replace('?page=1', '', $paginator->previousPageUrl());
                                @endphp
                            @endif
                            <a class="page-link" href="{{ $previousPageUrl }}" rel="prev"
                               aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif
                    @if ($paginator->currentPage() > 3 && $page === 2)
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                    @endif

                    @if (  $paginator->currentPage() - $page < 3 && $page < $paginator->currentPage() )
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @endif
                    @if (  $page - $paginator->currentPage() < 3 && $page > $paginator->currentPage())
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                    @if ($paginator->currentPage() < $paginator->lastPage() - 2 && $page === $paginator->lastPage() - 1)
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                   aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
        @if ($paginator->hasMorePages() && $paginator->currentPage() != $paginator->lastPage())
            <li class="page-item">
                <a href="{{ $paginator->lastPageUrl() }}" class="page-link page-last">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <line x1="0.7" y1="0.90332" x2="0.7" y2="9.90332" stroke="black"
                              stroke-width="0.9"/>
                        <path
                                d="M5.70625 1.63457L9.08125 5.00957C9.19375 5.12207 9.25 5.23457 9.25 5.40332C9.25 5.57207 9.19375 5.68457 9.08125 5.79707L5.70625 9.17207C5.48125 9.39707 5.14375 9.39707 4.91875 9.17207C4.69375 8.94707 4.69375 8.60957 4.91875 8.38457L7.9 5.40332L4.91875 2.42207C4.69375 2.19707 4.69375 1.85957 4.91875 1.63457C5.14375 1.40957 5.48125 1.40957 5.70625 1.63457Z"
                                fill="black"/>
                    </svg>
                </a>
            </li>
        @endif
    </ul>
@endif
