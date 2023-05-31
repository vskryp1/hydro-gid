@extends('frontend.layout')
@php
    $start_title = '';
    $start_description = '';
    $end_h1 = '';
    if (isset($_GET['page']) && $_GET['page'] > 1):
       $start_title =  app()->getLocale() == 'ru' ? 'Страница ' . $_GET['page']  .': ' : 'Сторінка ' . $_GET['page']  .': ';
       $start_description = app()->getLocale() == 'ru' ? 'Страница ' . $_GET['page']  .': ' : 'Сторінка ' . $_GET['page']  .': ';
       $end_h1 = app()->getLocale() == 'ru' ? ' - страница ' . $_GET['page'] : ' - cторінка ' . $_GET['page'];
    endif;

@endphp

@section('title', $start_title . $seo_meta['seo_title'])
@section('description', $start_description . $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('h1', $seo_meta['seo_h1'] . $end_h1)
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@section('seo_content')
    {!! $seo_meta['seo_content'] !!}
@endsection
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/category.min.css')) !!}
@endsection

@section('scripts')
    @parent

    <script>
        window.shop = {};
        window.shop.more_url = '{{ route('ajax.catalog.more', ['alias' => $page->getOriginal('alias')]) }}';
        window.shop.filters = {
            start: '{{ config('app.separators.filters.start') }}',
            filter_filter: '{{ config('app.separators.filters.filter_filter') }}',
            filter_value: '{{ config('app.separators.filters.filter_value') }}',
            value_value: '{{ config('app.separators.filters.value_value') }}',
            page: '{{ config('app.separators.category.pages') }}',
            ajax_url: '{{ route('ajax.catalog.filter.block', ['alias' => $page->getOriginal('alias')]) }}',
            price: "{{ Filter::PRICE }}",
            sort: "{{ Filter::SORT }}",
            slider: "{{ Filter::SLIDER }}",
            offset: {{ $defaultLimit *  ($_GET['page'] ?? 0)}},
            limit: '{{ $defaultLimit }}',
            url: window.location.pathname.replace(/{{ config('app.separators.filters.start') != '' ? '\/' . config('app.separators.filters.start') . '\/(.*)' :  '(\/[A-Za-z0-9\-_:]+\\' . config('app.separators.filters.filter_value') . '.+){1,}' }}/ig, '')
        };
        window.shop.messages = {
            already_added: `<p>{{ __('frontend.already_added') }}</p>`,
        };
    </script>
    {!! Html::script(mix('/assets/frontend/js/category.js')) !!}
@endsection
@include('frontend.elements.buyOneClickSeo')
@section('content')
    <main class="main not-hover">
        <div class="products" style="background-image: url('{{ url('/assets/frontend/images/serv-bg-comp.png') }}');">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="container">
                <div class="products__title">
                    <h1 class="products__title">
                        {{ $page->name.$end_h1 }}
                    </h1>
                </div>
                @if($page->children_active->count() > 0)
                    <div class="products__list-wrapper">
                        @foreach($page->children_active as $i => $child)
                            <a href="{{ $child->alias }}">
                                <div class="products__list">
                                    <div class="products__item--hover"></div>
                                    <picture>
                                        <source type="image/webp" class="lazy-srcset"
                                                data-srcset="{{ $child->getImageUrl('category', 'page_image', true) }}">
                                        <img class="lazy" data-src="{{ $child->getImageUrl('category', 'page_image') }}"
                                             alt="{{ __('frontend.page_alt', ['name' => $child->name]) }}"
                                             title="{{ __('frontend.page_title', ['name' => $child->name]) }}">
                                    </picture>
                                    <div class="products__list-text">
                                        {{ $child->name }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="two-column-wrapper">
                <aside class="column-right filters-wrap">
                    @include('frontend.templates.category.include.filters')
                </aside>
                <div class="container-main">
                    <div class="sorting-top">
                        <button class="open_filter js-openFilter">
                            <i class="icon icon-filter"></i>
                        </button>
                        <div class="sort-holder">
                            <label>@lang('frontend/product/index.to_sort'):</label>
                            {{ Form::select(
                                'sort',
                                [
                                    ''           => 'Выберите',
                                    'price_asc'  => __('frontend/product/index.price_asc'),
                                    'price_desc' => __('frontend/product/index.price_desc'),
                                    'popular'    => __('frontend/product/index.by_popular')
                                ],
                                $sort,
                                [
                                    'class'            => 'sort-select js_sort_select',
                                ]
                             ) }}
                        </div>
                        <div class="choice-holder">
                            <label>@lang('frontend/product/index.products_on_page'):</label>
                            @foreach(config('app.filters.products_count_on_page') as $productsOnPage)
                                <a class="item sort-limit-accept @if($productsOnPage == $limit) active @endif"
                                   data-limit="{{ $productsOnPage }}">
                                    {{ $productsOnPage }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="row category-product js_height-block js-products-block js-items">
                        @include('frontend.templates.category.include.product_items')
                    </div>
                    <div data-page-ajax="{{  $_GET['page'] ?? 1 }}" class="btn-see-more js_show_more @unless($showMoreAvailable) display-none @endunless">
                        <span class="icon icon-rotate"></span>
                        <a href="#">@lang('frontend/product/index.show_more')</a>
                    </div>
                        {{ $products->render()  }}
                </div>
            </div>
        </div>
        @unless(empty($recently_viewed_products))
            <div class="benefits">
                <div class="benefits__gradient"></div>
                <div class="container">
                    <div class="benefits__title">
                        @lang('frontend/product/index.viewed_earlier')
                    </div>
                    <div class="slider-prod js-slider-prod">
                        @foreach($recently_viewed_products as $product)
                            <div class="item">
                                @include('frontend.elements.productItem')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endunless
    </main>
@endsection
