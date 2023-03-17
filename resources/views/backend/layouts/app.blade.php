<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', __('Гидро Гид')) }} - @yield('title')</title>
    {{--Styles--}}
    {{ Html::style(mix('assets/backend/css/backend.css')) }}
    @yield('styles')
    {{--Head--}}
    @yield('head')
    {{ Html::script('assets/backend/modules/ckeditor/ckeditor.js') }}
</head>
<body class="@if(isset($_COOKIE['sidebar_sm']) && $_COOKIE['sidebar_sm'] == 1) nav-sm @else nav-md @endif @yield('body_class')">
    {{--Page--}}
    @yield('page')
    {{--Common Scripts--}}
    <script>
        window.general_var = {
          date_format: '{{ config('app.formats.js.date') }}'
        };
    </script>
    {!! Html::script(mix('assets/backend/js/backend.js')) !!}
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    {{--Scripts--}}
    @yield('scripts')

    @include('backend.elements.messages')
</body>
</html>