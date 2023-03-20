@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent
    {!! Html::style(mix('/assets/frontend/css/stock.min.css')) !!}
@endsection

@section('scripts')
    <script>
        window.shop                = {};
        window.shop.filters        = {};
        window.shop.more_url       = '{{ route('ajax.page.more', PageAlias::PAGE_PROMOTIONS) }}';
        window.shop.filters.offset = 0;
        window.shop.filters.limit  = {!! config('app.limits.frontend.stock') !!};
    </script>
    @parent
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="stock">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="stock__title page--line">
                <div class="container">
                    @lang('frontend/stock/index.stocks')
                </div>
            </div>
            <div class="container">
                <div class="stock__inner">
                    <div class="stock__items js-items">
                        @include('frontend.templates.stock.include.items')
                    </div>
                    <div class="btn-see-more js_show_more @unless($showMoreAvailable) display-none @endunless">
                        <span class="icon icon-rotate"></span>
                        <a href="#">@lang('frontend/product/index.show_more')</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
