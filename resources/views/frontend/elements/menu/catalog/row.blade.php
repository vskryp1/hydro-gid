@if($children != '')
    <li>
        @if(empty($link))
            <span class="active">
                {{ $title }}
            </span>
        @else
            <a href="{{ $link }}" {{ $properties }}>
                {{ $title }}
            </a>
        @endif
        <ul class="menu__dropdown-list">
            {!! $children !!}
        </ul>
    </li>
@else
    <li>
        @if(empty($link))
            <span class="active">
                {{ $title }}
            </span>
        @else
            <a href="{{ $link }}" {{ $properties }}>
                {{ $title }}
            </a>
        @endif
    </li>
@endif
