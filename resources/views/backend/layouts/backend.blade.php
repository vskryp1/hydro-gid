@extends('backend.layouts.app')

@section('page')
    <div class="container body">
        <div class="main_container">
            @section('header')
                @include('backend.sections.navigation')
                @include('backend.sections.header')
            @show
            @yield('left-sidebar')
            <div class="right_col" role="main">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>@yield('title')
                                    <small class="badge badge-info">@yield('title_sm')</small>
                                </h3>
                            </div>
                            @yield('search')
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if(Breadcrumbs::exists() && !Request::is(config('app.backend_uri')))
                        <div class="col-md-12">
                            <div class="pull-left">
                                {!! Breadcrumbs::view('backend.partials.breadcrumbs') !!}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @yield('content')
                    </div>
                </div>
            </div>
            <footer>
                @include('backend.sections.footer')
            </footer>
        </div>
    </div>
@endsection
