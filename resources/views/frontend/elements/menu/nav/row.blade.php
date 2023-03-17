@if($children != '')
    <li class="header__menu-item header__menu-item-dropbtn">
        <div class="nav__menu-dropdown">
                                    <span class="header__menu-dropdowntext">
                                        {{ $title }}
                                    </span>
            <span class="icon icon-arrow-down header__menu-dropdowndown"></span>
        </div>
        <ul class="menu__dropdown">
            {!! $children !!}
        </ul>
    </li>
@else
    <li class="header__menu-item">
        <a href="{{ $link }}" {{ $properties }}>
            {{ $title }}
        </a>
    </li>
@endif





