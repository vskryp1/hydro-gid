<!DOCTYPE html>
<html lang="EN">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/vuetifyFix.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/admin/app.js') }}" defer></script>

    <!-- Map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places"></script>
</head>
<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        '//connect.facebook.net/en_US/fbevents.js');
    fbq('init', '185425124483639');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=185425124483639&ev=PageView&noscript=1"
    /></noscript>
<!-- End Meta Pixel Code -->
<meta name="facebook-domain-verification" content="1a2ynhzz1qqn70y5bf44l6yn4c4r1p" />
<body style="background-color: #eaeef2;">
<div id="app">
    <v-app>
        <admin-app :default-data="{{ json_encode($default_data) }}">
            <template slot="content">@yield('content')</template>
        </admin-app>
    </v-app>
</div>

</body>
</html>
