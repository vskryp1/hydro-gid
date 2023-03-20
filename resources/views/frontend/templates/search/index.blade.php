@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/searchresult.min.css')) !!}
@endsection

@section('scripts')
    <script>
        window.shop                = {};
        window.shop.filters        = {};
        window.shop.more_url       = '{{ route('ajax.page.more', ['alias' => $page->getOriginal('alias'), 'search' => $search]) }}';
        window.shop.filters.offset = 0;
        window.shop.filters.limit  = {!! config('app.limits.frontend.products') !!};
    </script>
    @parent

    {!! Html::script(mix('/assets/frontend/js/searchresult.js')) !!}
@endsection

@section('content')
    <main class="searchresult">
        <div class="blog">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="blog__title page--line">
                <div class="container">
                    @lang(trans_choice('frontend/product/index.found_products', $products_count +  $articles->count())) "{{ request()->search }}"
                </div>
            </div>
            <div class="tab-general-box tab-area">
                <div class="container">
                    <ul class="tab-navigation flex-wrap tab-fill">
                        <li>
                            <a href="#feature-all-1" class="active">
                                <span class="tab-item">@lang('frontend.products') ({{ $products_count }})</span>
                            </a>
                        </li>
                        <li>
                            <a href="#feature-all-2">
                                <span class="tab-item">@lang('frontend.articles') ({{ $articles->count() }})</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-container">
                        <div id="feature-all-2" class="tab-box">
                            <div class="search-container">
                                <aside class="list-menu">
                                    @include('frontend.templates.search.include.filter_items')
                                </aside>
                                <div class="row search-container__items category-product js_height-block js-items">
                                    @include('frontend.templates.search.include.items')
                                </div>
                            </div>
                            <div class="btn-see-more js_show_more @unless($showMoreAvailable) display-none @endunless">
                                <span class="icon icon-rotate"></span>
                                <a href="#">@lang('frontend/product/index.show_more')</a>
                            </div>
                        </div>
                        <div id="feature-all-1" class="tab-box">
                            <div class="flex-container">
                                <div class="main_container">
                                    @include('frontend.templates.blog.include.items')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
