<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-left">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{url('/')}}" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('backend.go_to_site')">
                        <i class="fa fa-home" aria-hidden="true"></i> @lang('backend.go_to_site')
                    </a>
                </li>

                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{ auth()->user()->avatar }}" alt="">{{ auth()->user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="{{ route('backend.users.profile') }}">
                                {{ __('backend.profile') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('backend.logout') }}">
                                <i class="fa fa-sign-out pull-right"></i> {{ __('backend.logout') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown hover-line language-switcher">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {!! Html::image('/assets/backend/images/' . config('lang')['icon'], config('lang')['icon'], [
                            'height' => 15,
                        ]) !!}
                        {{ config('lang')['name'] }}
                    </a>

                    <ul class="dropdown-menu languages">
                        @foreach(ShopHelper::languages(false, true) as $locale => $lang)
                            <li>
                                <a href="{{ route('backend.setLanguage', ['locale' => $locale]) }}">
                                    {!! Html::image('/assets/backend/images/' . $lang['icon'], $lang['icon'], [
                                        'height' => 15,
                                    ]) !!}
                                    {{ $lang['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>