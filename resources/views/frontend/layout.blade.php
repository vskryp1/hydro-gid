<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        {!! Html::tag('meta', '', ['charset' => 'UTF-8']) !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1.0') !!}
        {!! Html::meta('csrf-token', csrf_token()) !!}
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="robots" content="@yield('robots')">
        <link rel="canonical" href="@yield('canonical')"/>
        @foreach(ShopHelper::languages(false, true) as $locale => $lang)
            <link rel="alternate" hreflang="{{ $locale }}" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}"/>
        @endforeach
        <meta property="og:image" content="@yield('og_image')" >
        <meta property="og:locale" content="@yield('og_locale')">
        <meta property="og:title" content="@yield('og_title')">
        <meta property="og:description" content="@yield('og_description')">
        <meta property="og:url" content="@yield('og_url')">
        {!! Html::favicon('favicon.ico') !!}
        @yield('styles')
        {!! Setting::get('seo-head', '') !!}
        @env('production')
            @include('frontend.elements.localBusiness')
        @endenv
        @yield('productSeo')
        @yield('blogSeo')
        @env('production')
            <!-- Global site tag (gtag.js) - Google Ads: 627401891 -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=AW-627401891"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'AW-627401891');
            </script>
            @yield('pageEvent')
            @hasSection('facebookEvent')
                @yield('facebookEvent')
            @else
                <script>
                    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                        document,'script','https://connect.facebook.net/en_US/fbevents.js');
                    fbq('init', '3289447984432890');
                    fbq('track', 'PageView');
                </script>
                <noscript>
                    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=3289447984432890&ev=PageView&noscript=1"/>
                </noscript>
            @endif
        @endenv
    </head>
    <body>

        {!! Setting::get('seo-afterHead', '') !!}
        @include('frontend.elements.preloader.preloader')
        @include('frontend.elements.header.header')
        @yield('content')
        @include('frontend.elements.seo')
        @include('frontend.elements.footer.footer')
        <div class="page-overlay"></div>
        @yield('scripts')
        @include('sweetalert::alert')


    </body>
</html>
