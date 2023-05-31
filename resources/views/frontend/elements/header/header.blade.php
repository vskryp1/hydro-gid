<div id="wrapper" class="page-wrapper trans">
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="header__top-inner">
                    <nav class="header__top-menu">
                        <ul>
                            @foreach($topHeadLinks as $link)
                                <li>
                                    @if(isset($page) && $page->getOriginal('alias') === $link['alias'])
                                        <span>{{ $link['name'] }}</span>
                                    @else
                                        <a href="{{ $link['href'] }}">
                                            {{ $link['name'] }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                    <div class="header-right">
                        <div class="header__time">
                            <div class="icon icon-time"></div>
                            {{ ShopHelper::getSchedule(true) }}
                        </div>
                        <div class="header__languages">
                            @foreach(ShopHelper::languages(false, true) as $locale => $lang)
                                @if(App::getLocale() === $locale)
                                    <a class="active">
                                        {{ $locale }}
                                    </a>
                                @else
                                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">
                                        {{ $locale }}
                                    </a>
                                @endif
                                @if($loop->count !== $loop->iteration)|@endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__content">
            <div class="container">
                <div class="header__content-inner">
                    <div class="header__logo header__logo--bg">
                        @if($current_url === $localized_url)
                            <a class="header__logo-link">
                                {!! Html::image(app()->getLocale() == 'ru' ? asset('assets/frontend/images/logo-ru.png') : asset('assets/frontend/images/logo-uk.png'), 'header-logo') !!}
                            </a>
                        @else
                            <a class="header__logo-link" href="{{ $localized_url }}">
                                {!! Html::image(app()->getLocale() == 'ru' ? asset('assets/frontend/images/logo-ru.png') : asset('assets/frontend/images/logo-uk.png'), 'header-logo') !!}
                            </a>
                        @endif
                    </div>
                    <div class="header__search">
                        {!! Form::open([
                            'url'    => route('frontend.page', PageAlias::PAGE_SEARCH),
                            'method' => 'GET',
                        ]) !!}
                        {!! Form::search('search') !!}
                        {!! Form::button(null, ['type' => 'submit', 'class' => 'icon icon-search']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="header__phone">
                        <a class="header__phone-number"
                           href="tel:{{ ShopHelper::getFormatPhone('phone_number_first') }}">
                            {{ ShopHelper::setting('phone_number_first') }}
                        </a>
                        <a class="header__phone-number"
                           href="tel:{{ ShopHelper::getFormatPhone('phone_number_second') }}">
                            {{ ShopHelper::setting('phone_number_second') }}
                        </a>
                        <a class="header__phone-text" data-fancybox data-src="#modal-call" href="javascript:;">
                            {{ __('frontend.request_a_call') }}
                        </a>
                    </div>
                    <div class="header__panel-list">
                        <ul>
                            <li>
                                <a class="js-comparelist-link"
                                    @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_COMPARE_CART)
                                        href="{{ route('frontend.page', PageAlias::PAGE_COMPARE_CART) }}"
                                    @endunless>
                                    {!! Html::image('/assets/frontend/images/balanced.svg', 'balanced', [
                                        'class' => 'header__pannel-link',
                                    ]) !!}
                                    @if(Cart::instance('comparelist')->count() || (auth()->user() && auth()->user()->comparelist->count()))
                                        <span class="preview-tip counter">
                                            {{ Cart::instance('comparelist')->count() ? : auth()->user()->comparelist->count() }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a @auth('web') href="{{ route('frontend.page', PageAlias::PAGE_ACCOUNT . '#wishlist-tab') }}"
                                   @else data-fancybox data-src="#modal"
                                   @endauth class="button-reset js_wishlist_counter">
                                    @if(Cart::instance('wishlist')->count() || (auth()->user() && auth()->user()->wishlist->count()))
                                        <span class="preview-tip js_wishlist_count">
                                            {{ Cart::instance('wishlist')->count() ? : auth()->user()->wishlist->count() }}
                                        </span>
                                    @endif
                                    <span class="header__pannel-link icon icon-bookmarks"></span>
                                </a>
                            </li>
                            <li>
                                @auth('web')
                                    <div class="dropdown show">
                                        <a role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <span class="header__pannel-link icon icon-user"></span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_ACCOUNT)
                                                {!! Form::open([
                                                'url'    => route('frontend.page', PageAlias::PAGE_ACCOUNT),
                                                'method' => 'POST',
                                                ]) !!}
                                                @method('GET')
                                                {!! Form::button(__('frontend.profile'), [
                                                    'type'  => 'submit',
                                                    'class' => 'dropdown-item',
                                                ]) !!}
                                                {!! Form::close() !!}
                                            @endunless
                                            {!! Form::open([
                                                'url'    => route('logout'),
                                                'method' => 'POST',
                                            ]) !!}
                                            {!! Form::button(__('frontend.logout'), [
                                                'type'  => 'submit',
                                                'class' => 'dropdown-item',
                                            ]) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                @else
                                    <a href="javascript:;" data-fancybox data-src="#modal" class="button-reset">
                                        <span class="header__pannel-link icon icon-user"></span>
                                    </a>
                                @endauth
                            </li>
                            <li>
                                <a @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_BASKET)
                                       href="{{ route('frontend.page', PageAlias::PAGE_BASKET) }}"
                                    @endunless>
                                        <span class="preview-tip js-head-cart-items-count js_hidden
                                            @if(!Cart::instance('default')->count())
                                                hidden
                                            @endif"
                                              data-count="{{ Cart::instance('default')->count() }}"></span>
                                    <span class="header__pannel-link icon icon-shopping-cart"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="container">
                <div class="header__bottom-inner">
                    <nav class="header__menu">
                        <ul>
                            <li class="header__menu-item header__menu-dropbtn">
                                <div class="header__menu-dropdown">
                                    <span class="icon icon-menu-btn header__menu-dropdownicon"></span>
                                    <span class="header__menu-dropdowntext">
                                        {{ __('frontend.categories') }}
                                    </span>
                                    <span class="icon icon-arrow-down header__menu-dropdowndown"></span>
                                </div>

                                <div class="menu__dropdown">
                                    <div class="menu__gropdown-inner">
                                        <div class="scroll-menu__wrap">
                                            <ul class="menu__dropdown-top">
                                                {!! MenuHelper::getMenu('catalog-menu',
                                                ['template' => 'catalog',
                                                 'current_id' => isset($page) ? $page->id : '']) !!}
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            @if($services->isNotEmpty())
                                <li class="header__menu-item header__menu-item-dropbtn">
                                    <div class="nav__menu-dropdown">
                                        <span class="header__menu-dropdowntext">
                                            {{ __('frontend.services') }}
                                        </span>
                                        <span class="icon icon-arrow-down header__menu-dropdowndown"></span>
                                    </div>
                                    <ul class="menu__dropdown">
                                        @foreach($services as $service)
                                            <li class="header__menu-item">
                                                @if(isset($page) && $page->getOriginal('alias') == basename($service->alias))
                                                    <span class="menu__dropdown-item active">{{ $service->name }}</span>
                                                @else
                                                    <a class="menu__dropdown-item" href="{{ $service->alias }}">
                                                        {{ $service->name }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                            @foreach($bottomHeadLinks as $link)
                                <li class="header__menu-item">
                                    @if(isset($page) && $page->getOriginal('alias') === $link['alias'])
                                        <span  class="header__menu-link active">{{ $link['name'] }}</span>
                                    @else
                                        <a class="header__menu-link"
                                           href="{{ $link['href'] }}">
                                            {{ $link['name'] }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                    <a class="header__calculate"
                        @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_CALCULATORS)
                            href="{{ route('frontend.page', PageAlias::PAGE_CALCULATORS) }}"
                        @endunless>
                        <span>{{ __('frontend.calculate') }}</span>
                    </a>
                </div>
            </div>
        </div>
        @handheld
            <div class="header__mobile">
                <div class="container">
                    <div class="header__mobile-icon">
                        <div class="icon icon-menu"></div>
                        <div class="header__mobile-menu">
                            <div class="header__mobile-title mobmenu__title">
                                <span class="title">
                                    {{ __('frontend.menu') }}
                                </span>
                                <a class="icon icon-x-circle"></a>
                            </div>
                            <div class="header__mobile-menu-wrapper">
                                <div class="header__languages header__mobile-menu-item">
                                    <div class="container">
                                        @foreach(ShopHelper::languages(false, true) as $locale => $language)
                                            @if(App::getLocale() === $locale)
                                                <a class="active">
                                                    {{ $locale }}
                                                </a>
                                            @else
                                                <a href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">
                                                    {{ $locale }}
                                                </a>
                                            @endif
                                            @if($loop->count !== $loop->iteration)|@endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="header__panel-list">
                                    <ul>
                                        <li class="header__mobile-menu-item">
                                            <div class="container">
                                                <a @auth('web')
                                                   @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_ACCOUNT)
                                                   href="{{ route('frontend.page', PageAlias::PAGE_ACCOUNT) }}"
                                                   @endunless
                                                   @endauth data-fancybox data-src="#modal" class="button-reset header__mobile-menu-link">
                                                    <span class="title">
                                                        {{ __('frontend.favourites') }}
                                                    </span>
                                                    @if(Cart::instance('wishlist')->count() !== 0 || (auth()->user() && auth()->user()->wishlist->count()))
                                                        <span class="preview-tip">
                                                            {{ Cart::instance('wishlist')->count() ? : auth()->user()->wishlist->count() }}
                                                        </span>
                                                    @endif
                                                    <span class="header__pannel-link icon icon-bookmarks"></span>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="header__mobile-menu-item">
                                            <div class="container">
                                                <a @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_COMPARE_CART)
                                                   href="{{ route('frontend.page', PageAlias::PAGE_COMPARE_CART) }}"
                                                   @endunless class="header__mobile-menu-link">
                                                    <span class="title">
                                                        {{ __('frontend.compare_list') }}
                                                    </span>
                                                    @if(Cart::instance('comparelist')->count() !== 0 || (auth()->user() && auth()->user()->comparelist->count()))
                                                        <span class="preview-tip">
                                                            {{ Cart::instance('comparelist')->count() ? : auth()->user()->comparelist->count() }}
                                                        </span>
                                                    @endif
                                                    <span class="header__pannel-link icon icon-compare"></span>
                                                </a>
                                            </div>
                                        </li>
                                        @auth('web')
                                            <li class="header__mobile-menu-item">
                                                <div class="container">
                                                    <a @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_ACCOUNT)
                                                       href="{{ route('frontend.page', PageAlias::PAGE_ACCOUNT) }}"
                                                       @endunless class="header__mobile-menu-link">
                                                        <span class="title">
                                                            {{ __('frontend.profile') }}
                                                        </span>
                                                        <span class="header__pannel-link icon icon-user"></span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="header__mobile-menu-item">
                                                <div class="container">
                                                    {!! Form::open([
                                                        'url'    => route('logout'),
                                                        'method' => 'POST',
                                                        'class' => 'btn-logout-style'
                                                    ]) !!}
                                                    {!! Form::button(__('frontend.logout'), [
                                                        'type'  => 'submit',
                                                        'class' => 'dropdown-item title',

                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </li>
                                        @else
                                            <li class="header__mobile-menu-item">
                                                <div class="container">
                                                    <a href="javascript:;" data-fancybox data-src="#modal"
                                                       class="button-reset header__mobile-menu-link">
                                                        <span class="title">
                                                            {{ __('frontend.profile') }}
                                                        </span>
                                                        <span class="header__pannel-link icon icon-user"></span>
                                                    </a>
                                                </div>
                                            </li>
                                        @endauth
                                    </ul>
                                </div>
                                <div class="header__mobile-menu-main header__mobile-menu-item">
                                    <div class="container">
                                        <nav class="header__menu">
                                            <ul>
                                                @foreach($topHeadLinks as $link)
                                                    <li>
                                                        @if(isset($page) && $page->getOriginal('alias') === $link['alias'])
                                                            <span class="header__mobile-menu-link active">{{ $link['name'] }}</span>
                                                        @else
                                                            <a class="header__mobile-menu-link" href="{{ $link['href'] }}">
                                                                {{ $link['name'] }}
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </nav>
                                        <a class="header__calculate"
                                           @unless(isset($page) && $page->getOriginal('alias') === PageAlias::PAGE_CALCULATORS)
                                           href="{{ route('frontend.page', PageAlias::PAGE_CALCULATORS) }}"
                                                @endunless>
                                            <span>{{ __('frontend.calculate') }}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="header__mobile-menu-main header__mobile-menu-item">
                                    <div class="container">
                                        <nav class="header__top-menu">
                                            <ul>
                                                @if($services->isNotEmpty())
                                                    <li class="header__menu-item header__menu-item-dropbtn">
                                                        <div class="nav__menu-dropdown">
                                                            <span class="header__menu-dropdowntext">
                                                                {{ __('frontend.services') }}
                                                            </span>
                                                            <span class="icon icon-arrow-down header__menu-dropdowndown services-icon"></span>
                                                        </div>
                                                        <ul class="menu__dropdown">
                                                            @foreach($services as $service)
                                                                <li class="header__menu-item">
                                                                    @if(isset($page) && $page->getOriginal('alias') === basename($service->alias))
                                                                        <span class="header__menu-link active">{{ $service->name }}</span>
                                                                    @else
                                                                        <a href="{{ $service->alias }}">
                                                                            {{ $service->name }}
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                                @foreach($bottomHeadLinks as $link)
                                                    <li class="header__menu-item">
                                                        @if(isset($page) && $page->getOriginal('alias') === $link['alias'])
                                                            <span class="header__menu-link active">{{ $link['name'] }}</span>
                                                        @else
                                                            <a class="header__menu-link"
                                                               href="{{ $link['href'] }}">
                                                                {{ $link['name'] }}
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="header__mobile-menu-footer header__mobile-menu-item">
                                    <div class="container">
                                        <div class="header__phone">
                                            <a class="header__phone-number"
                                               href="tel:{{ ShopHelper::getFormatPhone('phone_number_first') }}">
                                                {{ ShopHelper::setting('phone_number_first') }}
                                            </a>
                                            <a class="header__phone-number"
                                               href="tel:{{ ShopHelper::getFormatPhone('phone_number_second') }}">
                                                {{ ShopHelper::setting('phone_number_second') }}
                                            </a>
                                            <a class="header__phone-text" data-fancybox data-src="#modal-call" href="#">
                                                {{ __('frontend.request_a_call') }}
                                            </a>
                                        </div>
                                        <div class="header__city">

                                        </div>
                                        <div class="header__time">
                                            <div class="icon icon-time"></div>
                                            {{ ShopHelper::getSchedule(true) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header__mobile-logo">
                        <div class="header__logo">
                            @if($current_url === $localized_url)
                                <a>
                                    {!! Html::image(ShopHelper::getLogoUrl('header'), 'header-logo') !!}
                                </a>
                            @else
                                <a href="{{ $localized_url }}">
                                    {!! Html::image(ShopHelper::getLogoUrl('header'), 'header-logo') !!}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="header__mobile-icons">
                        <div class="phone">
                            <a class="icon icon-phone" data-fancybox="" data-src="#modal-phone"></a>
                        </div>
                        <div class="search">
                            <div class="icon icon-search"></div>
                            <div class="header__search">
                                <div class="header__mobile-title mobmenu__title">
                                    <span class="title">@lang('frontend.search')</span>
                                    <div class="icon icon-x-circle"></div>
                                </div>
                                {!! Form::open([
                                    'url'    => route('frontend.page', PageAlias::PAGE_SEARCH),
                                    'method' => 'GET',
                                ]) !!}
                                {!! Form::search('search') !!}
                                {!! Form::button(null, ['type' => 'submit', 'class' => 'icon icon-search']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="cart">
                            <a @unless(isset($page) && $page->getOriginal('alias') == PageAlias::PAGE_BASKET)
                               href="{{ route('frontend.page', PageAlias::PAGE_BASKET) }}"
                                    @endunless>
                                <span class="preview-tip js-head-cart-items-count js_hidden"
                                      data-count="{{ Cart::instance('default')->count() }}"></span>
                                <span class="header__pannel-link icon icon-shopping-cart"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__mobile-bottom">
                <div class="header__menu-item header__menu-dropbtn">
                    <div class="header__menu-dropdown">
                        <span class="header__menu-dropdowntext">{{ __('frontend.categories') }}</span>
                        <span class="icon icon-arrow-down header__menu-dropdowndown"></span>
                    </div>
                    <div class="header__mobile-category-menu">
                        <div class="header__mobile-title mobmenu__title">
                            <div class="icon icon-arrow-long"></div>
                            <span class="title">{{ __('frontend.categories') }}</span>
                            <div class="icon icon-x-circle"></div>
                        </div>
                        <div class="menu__dropdown">
                            <div class="container">
                                <div class="menu__gropdown-inner">
                                    <ul class="menu__dropdown-top">
                                        {!! MenuHelper::getMenu('catalog-menu',
                                                ['template' => 'catalog',
                                                 'current_id' => isset($page) ? $page->id : '']) !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhandheld
    </header>

    @unless(Auth::guard('web')->check())
        <div id="modal">
            <div class="modal__inner">
                <div class="modal__tabs header__tabs">
                    <div id="login" class="modal__tab active">
                        {{ __('frontend.login') }}
                    </div>
                    <div id="registration" class="modal__tab">
                        {{ __('frontend.registration') }}
                    </div>
                </div>
                <div class="modal__content content__tabs">
                    <div class="login modal__tab-content">
                        @include('frontend.elements.forms.login')
                        <div class="registration__link">
                            {{ __('frontend.or') }}
                            <a id="js-register-link" class="modal__change" href="#">
                                {{ __('frontend/auth/index.buttons.register') }}
                            </a>
                        </div>
                    </div>
                    <div class="registration modal__tab-content">
                        @include('frontend.elements.forms.register')
                        <div class="registration__link">
                            {{ __('frontend.or') }}
                            <a id="js-login-link" class="modal__change" href="#">
                                {{ __('frontend/auth/index.buttons.login') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endunless


    <div id="modal-call">
        <div class="modal__inner">
            <div class="modal__title">
                @lang('frontend/service/index.we_will_call_you')
            </div>
            <div class="modal__content">
                {!! Form::open([
                    'route'  => 'frontend.forms.callback',
                    'method' => 'POST',
                    'files'  => true,
                    'id'     => 'callback-form',
                    'class'  => 'login__form modal__form'
                ]) !!}
                <label>
                    {!! Form::text('phone', auth('web')->check() ? auth('web')->user()->phone : null, [
                         'placeholder' => __('frontend/service/index.phone'),
                    ]) !!}
                </label>
                {!! Form::button(__('frontend/content/index.call_me'), [ 'type' => 'submit', 'class' => 'main-btn main-btn--green main-btn--center' ]) !!}
                {!! Form::hidden('call_me', true) !!}
                {!! Form::hidden('type', ServiceType::CALLBACK) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div id="modal-phone">
        <div class="modal__inner">
            <div class="modal__content">
                <div class="header__phone">
                    <a class="header__phone-number"
                       href="tel:{{ preg_replace('/[^0-9]/', '', ShopHelper::setting('phone_number_first')) }}">
                        {{ ShopHelper::setting('phone_number_first') }}
                    </a>
                    <a class="header__phone-number"
                       href="tel:{{ preg_replace('/[^0-9]/', '', ShopHelper::setting('phone_number_second')) }}">
                        {{ ShopHelper::setting('phone_number_second') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="fancybox-content" id="modal-pass-new">
        @csrf
        <div class="modal__inner">
            {{ Form::open(['route'  => 'password.email',
                               'class'  => 'pass-new__form modal__form',
                               'id'     => 'modal-pass-form',
                               'method' => 'POST',
                ]) }}
            {{ csrf_field() }}
            <div class="modal__title">
                {{ __('frontend/auth/index.forgotten_password') }}
            </div>
            <div class="modal__content">
                {{ __('frontend/auth/index.email_forgotten_password') }}
                {{ Form::email('email', null, ['id' => 'f_email', 'class' => 'form-field']) }}
            </div>
            <div class="form-group form-group--btn pass_container">
                {{ Form::button(__('passwords.recover'), ['type' => 'submit']) }}
            </div>
            {!! Form::close() !!}
            </div>

        </div>
    </div>

    <div class="fancybox-content" id="modal-pass">
        <div class="modal__inner">
            <div class="modal__title">
                Замена пароля
            </div>
            <div class="modal__content">
                {{ Form::open(['route' => 'frontend.forms.change_password', 'class' => 'order__form pass-new__form modal__form js_change_password', 'id' => 'change-password', 'method' => 'POST']) }}
                <div class="form-field input-field" data-error="{{ __('frontend/profile/index.required_field') }}">
                    {{ Form::password('oldPassword', ['class' => 'form-control validate password', 'placeholder' => __('frontend/profile/index.old_password'), 'required']) }}
                    <i class="icon icon-checkerror error-input"></i>
                    <i class="icon icon-checkpass pass-input"></i>
                </div>
                <div class="form-field input-field" data-error="{{ __('frontend/profile/index.required_field') }}">
                    {{ Form::password('newPassword', ['class' => 'form-control validate password', 'placeholder' => __('frontend/profile/index.new_password'), 'required']) }}
                    <i class="icon icon-checkerror error-input"></i>
                    <i class="icon icon-checkpass pass-input"></i>
                </div>
                <div class="form-field input-field" data-error="{{ __('frontend/profile/index.required_field') }}">
                    {{ Form::password('newPassword_confirmation', ['class' => 'form-control validate password_1', 'placeholder' => __('frontend/profile/index.confirmation_password'), 'required']) }}
                    <i class="icon icon-checkerror error-input"></i>
                    <i class="icon icon-checkpass pass-input"></i>
                </div>
                {{ Form::button(__( 'frontend/profile/index.send'), ['class' => 'main-btn main-btn--purple', 'placeholder' => __( 'frontend/profile/index.send'), 'type' => 'submit', 'required']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script>
        window.global_var = {
            legalEntityTemplate: `@include('frontend.elements.forms.legal-entity')`,
        };
    </script>

    @guest('web')
        @if(session()->has('open-modal'))
            <script>
                $(document).ready(function () {
                    $('a[data-src="#modal"]').click();
                });
            </script>
        @endif
        <!-- Laravel Javascript Validation -->
        {!! JsValidator::formRequest('App\Http\Requests\Frontend\Auth\LoginRequest', '#login-form') !!}
        {!! JsValidator::formRequest('App\Http\Requests\Frontend\Auth\RegisterRequest', '#register-form') !!}
        {!! JsValidator::formRequest('App\Http\Requests\Frontend\ServiceOrder\SaveFormRequest', '#callback-form') !!}
        {!! JsValidator::formRequest('App\Http\Requests\Frontend\Auth\ForgotPasswordRequest', '#modal-pass-form') !!}
    @endguest
@endsection
