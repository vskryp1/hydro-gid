@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/404-page.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="page-404">
            <div class="container">
                <div class="page-404__inner">
                    <div class="page-404__content">
                        <div class="page-404__title">
                            @lang('frontend/404/index.error_404_oops')
                        </div>
                        <div class="page-404__text">
                            @lang('frontend/404/index.error_404_not_found')
                        </div>
                        <div class="page-404__code">
                            @lang('frontend/404/index.error_404_status') <span>{{ getStatus() }}</span>
                        </div>
                        <a class="page-404__link" href="#">@lang('frontend/404/index.error_404_back')</a>
                    </div>
                    <div class="page-404__images">
                        <img src="{{asset('assets/frontend/images/404-page.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
