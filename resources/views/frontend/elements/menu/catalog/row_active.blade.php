@if($children != '')
    <li>
        <a href="{{ $link }}" {{ $properties }}>
            {{ $title }}
        </a>
        <ul class="menu__dropdown-list">
            {!! $children !!}
        </ul>
    </li>
@else
    <li>
        <a href="{{ $link }}" {{ $properties }}>
            {{ $title }}
        </a>
    </li>
@endif