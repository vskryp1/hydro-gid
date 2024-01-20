@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@section('seo_content')
    {!! $seo_meta['seo_content'] !!}
@endsection
@section('h1')
    <h1>
        {!! $seo_meta['seo_h1'] !!}
    </h1>
@endsection
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/contacts.min.css')) !!}
@endsection

@section('scripts')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api.key') }}"></script>
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="certificates">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="page__title page--line">
                <div class="container">
                    @lang('frontend/content/index.contacts')
                </div>
            </div>
            <div class="container">
                <div class="contacts__inner">
                    <div class="contacts__info">
                        <div class="contacts__title">
                            {{ ShopHelper::setting('site_name') }}
                        </div>
                        <div class="contacts__title-sup">
                            @lang('frontend/content/index.our_address'):
                        </div>
                        <div class="contacts__text">
                            {{ ShopHelper::setting('site_address') }}
                        </div>
                        <div class="contacts__title-sup">
                            @lang('frontend/content/index.schedule'):
                        </div>
                        <div class="contacts__text">
                            @foreach(ShopHelper::getSchedule() as $item)
                                <div class="contacts__text-line">
                                    <div class="contacts__day">{{ $item['full_day'] }}:</div>
                                    <div class="contacts__time">{{ $item['time'] }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="contacts__title-sup">
                            @lang('frontend/content/index.phones'):
                        </div>
                        <div class="d-flex" style="gap:10px">
                        <a class="contacts__phone" href="tel:+38{{ ShopHelper::setting('phone_number_first') }}">+38 {{ ShopHelper::setting('phone_number_first') }}</a><a href="https://telegram.im/@hydrogid" target="_blank">
                                        <img src="https://skr-hydraulic.com.ua/assets/frontend/images/social/telegram.svg" alt="">
                                    </a><a href="viber://chat?number=+380962696508" target="_blank">
                                        <img src="https://skr-hydraulic.com.ua/assets/frontend/images/social/viber.svg" alt="">
                                    </a>
                        </div>
                         <div class="d-flex" style="gap:10px">
                        <a class="contacts__phone" href="tel:+38{{ ShopHelper::setting('phone_number_first') }}">+38 {{ ShopHelper::setting('phone_number_second') }}</a><a href="https://telegram.im/@hydrogid" target="_blank">
                                        <img src="https://skr-hydraulic.com.ua/assets/frontend/images/social/telegram.svg" alt="">
                                    </a><a href="viber://chat?number=+380962696508" target="_blank">
                                        <img src="https://skr-hydraulic.com.ua/assets/frontend/images/social/viber.svg" alt="">
                                    </a>
                        </div>            
                        <div class="d-flex">            
                        <a class="contacts__phone" href="mailto:{{ ShopHelper::setting('phone_number_third') }}"> {{ ShopHelper::setting('phone_number_third')}}</a>
                        </div>
                        <div class="contacts__social">
                            <ul>
                                <li>
                                    <a href="{{ ShopHelper::setting('facebook_link') }}" target="_blank">
                                        <img src="{{ asset('/assets/frontend/images/social/facebook.svg') }}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ ShopHelper::setting('instagram_link') }}" target="_blank">
                                        <img src="{{ asset('/assets/frontend/images/social/instagram.svg') }}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ ShopHelper::setting('linkedin_link') }}" target="_blank">
                                        <img src="{{asset('/assets/frontend/images/social/linkedin.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ ShopHelper::setting('telegram_link') }}" target="_blank">
                                        <img src="{{asset('/assets/frontend/images/social/telegram.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ ShopHelper::setting('skype_link') }}" target="_blank">
                                        <img src="{{asset('/assets/frontend/images/social/skype.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ ShopHelper::setting('viber_link') }}" target="_blank">
                                        <img src="{{asset('/assets/frontend/images/social/viber.svg')}}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @include('frontend.elements.forms.callback')
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        window.hydrogidGeo = {!! json_encode(Setting::get('site_geo')) !!};
    </script>
@stop
