<footer class="footer">
    {!! Setting::get('seo-footer', '') !!}
    <div class="container">
        <div class="footer__inner">
            <div class="footer__column footer__column-1">
                <div class="footer__logo">
                    @if(Request::url() === LaravelLocalization::getLocalizedURL(app()->getLocale(), url(DIRECTORY_SEPARATOR)))
                        <a>
                            {!! Html::image(app()->getLocale() == 'ru' ? asset('assets/frontend/images/_logo-ru-footer.png') : asset('assets/frontend/images/_logo-footer-uk.png'), 'footer-logo') !!}
                        </a>
                    @else
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), url(DIRECTORY_SEPARATOR)) }}">
                            {!! Html::image(app()->getLocale() == 'ru' ? asset('assets/frontend/images/_logo-ru-footer.png') : asset('assets/frontend/images/_logo-footer-uk.png'), 'footer-logo') !!}
                        </a>
                    @endif
                </div>
                <div class="footer__phone">
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', ShopHelper::setting('phone_number_first')) }}">
                        {{ ShopHelper::setting('phone_number_first') }}
                    </a>
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', ShopHelper::setting('phone_number_second')) }}">
                        {{ ShopHelper::setting('phone_number_second') }}
                    </a>
                </div>
                <div class="footer__social">
                    @if(ShopHelper::setting('facebook_link'))
                        <a href="{{ ShopHelper::setting('facebook_link') }}" target="_blank" rel="noreferrer nofollow">
                            {!! Html::image('/assets/frontend/images/facebook.svg', 'facebook') !!}
                        </a>
                    @endif
                    @if(ShopHelper::setting('instagram_link'))
                        <a href="{{ ShopHelper::setting('instagram_link') }}" target="_blank" rel="noreferrer nofollow">
                            {!! Html::image('/assets/frontend/images/instagram.svg', 'instagram') !!}
                        </a>
                    @endif
                    @if(ShopHelper::setting('linkedin_link'))
                        <a href="{{ ShopHelper::setting('linkedin_link') }}" target="_blank" rel="noreferrer nofollow">
                            {!! Html::image('/assets/frontend/images/linkedin.svg', 'linkedin') !!}
                        </a>
                    @endif
                </div>
                <div class="footer__subscribe">
                    <div class="footer__subscribe-title">
                        {{ __('frontend.subscribe_for_the_newsletter') }}
                    </div>
                    @include('frontend.elements.forms.subscribe-footer')
                </div>
            </div>
            @if($categories->isNotEmpty())
                <div class="footer__column footer__column-2">
                    <div class="footer__column-title">
                        {{ __('frontend.categories') }}
                        <span class="footer-symbol"></span>
                    </div>
                    <ul class="footer__column-list">
                        @foreach($categories as $category)
                            <li>
                                @if(isset($page) && $page->getOriginal('alias') == basename($category->alias))
                                    <span class="footer__column-item active">{{ $category->name }}</span>
                                @else
                                    <a class="footer__column-item" href="{{ $category->alias }}">
                                        {{ $category->name }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div class="footer-column-more">
                        <div>
                            <span>{{ __('frontend.view_more') }} <i class="icon icon-arrow-down"></i></span>
                            <span>{{ __('frontend.view_less') }} <i class="icon icon-arrow-down"></i></span>
                        </div>
                    </div>
                </div>
            @endif
            @if($services->isNotEmpty())
                <div class="footer__column footer__column-3">
                    <div class="footer__column-title">
                        {{ __('frontend.services') }}
                        <span class="footer-symbol"></span>
                    </div>
                    <ul class="footer__column-list">
                        @foreach($services as $service)
                            <li>
                                @if(isset($page) && $page->getOriginal('alias') == basename($service->alias))
                                    <span class="footer__column-item active">{{ $service->name }}</span>
                                @else
                                    <a class="footer__column-item" href="{{ $service->alias }}">
                                        {{ $service->name }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="footer__column footer__column-4">
                <div class="footer__column-title">
                    {{ __('frontend.for_clients') }}
                    <span class="footer-symbol"></span>
                </div>
                <ul class="footer__column-list">
                    @foreach($forClients as $forClient)
                            <li>
                                @if(isset($page) && $page->getOriginal('alias') == $forClient['alias'])
                                    <span class="footer__column-item active">{{ $forClient['name'] }}</span>
                                @else
                                    <a class="footer__column-item" href="{{ $forClient['href'] }}" class="disabled">
                                        {{ $forClient['name'] }}
                                    </a>
                                @endif
                            </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer__column footer__column-5">
                <div class="footer__column-title">
                    {{ __('frontend.about_company') }}
                    <span class="footer-symbol"></span>
                </div>
                <ul class="footer__column-list">
                    @foreach($aboutCompany as $item)
                            <li>
                                @if(isset($page) && $page->getOriginal('alias') == $item['alias'])
                                    <span class="footer__column-item active">{{ $item['name'] }}</span>
                                @else
                                    <a class="footer__column-item" href="{{ $item['href'] }}">
                                        {{ $item['name'] }}
                                    </a>
                                @endif
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="footer__copy-inner">
            <div class="footer__copy">
                {{ collect([
                    'Ⓒ',
                    date('Y'),
                    __('frontend.app_name'),
                    __('frontend.all_rights_reserved')
                ])->implode(' ') }}
            </div>
            <div class="footer-link">
                <a class="logo-company" href="https://artjoker.ua/" target="_blank" rel="noreferrer nofollow">
                    {{ __('frontend.development_support') }} - {!! Html::image('/assets/frontend/images/footer-artjoker.svg', 'ooter-artjoker') !!}
                </a>
            </div>
        </div>
    </div>
</footer>
