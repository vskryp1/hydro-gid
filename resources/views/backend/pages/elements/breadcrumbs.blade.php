<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.pages.edit', ['id' => 1]) }}">@lang('backend.main_page')</a></li>
        @foreach($breadcrumbs as $key => $item)
            @if ($key != 1)
                <li class="breadcrumb-item">
                    <a @if(!$loop->last) href="{{ route('backend.pages.edit', ['id' => $key]) }}" @endif> {{$item}}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>