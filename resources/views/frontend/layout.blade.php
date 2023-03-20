<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @env('production')
            <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-PVVFC6M');
            </script>
            <!-- End Google Tag Manager -->
        @endenv
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
        @env('production')
            @yield('transactionTrack')
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PVVFC6M"
                              height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        @endenv
        {!! Setting::get('seo-afterHead', '') !!}
        @include('frontend.elements.preloader.preloader')
        @include('frontend.elements.header.header')
        @yield('content')
        @include('frontend.elements.seo')
        @include('frontend.elements.footer.footer')
        <div class="page-overlay"></div>
        @yield('scripts')
        @include('sweetalert::alert')
        @env('production')
            <script type="text/javascript">
                (function(d, w, s) {
                    var widgetHash = 'd4gq46pvt98apcej75jh', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
                    gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
                    var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
                })(document, window, 'script');
            </script>
        <script src="//code.jivosite.com/widget/JoYPd7uIN6" async></script>
        @endenv
    </body>
</html>
