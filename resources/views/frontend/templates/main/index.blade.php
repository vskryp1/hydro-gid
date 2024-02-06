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
        {!! __('frontend.seo_h1_main') !!}
    </h1>
@endsection
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/main.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="top">
            <div class="container">
                <div class="top__inner">
                    <div class="row">
                        <div class="top__slider">
                            @isset($slider->slider_items)
                                @foreach($slider->slider_items as $item)
                                    <div class="top__slider-item">
                                        <div class="top__slider-content">
                                            <div class="top__slider-info" style="display:none">
                                                <div class="top__slider-pretitle">
                                                    {{ $item->title }}
                                                </div>
                                                <div class="top__slider-title">
                                                    <span>{{ $item->name }}</span>
                                                </div>
                                                <div class="top__slider-text">
                                                    {{ $item->description }}
                                                </div>
                                                @if($item->link)
                                                    <div class="top__slider-link">
                                                        <a href="{{ $item->link }}">@lang('frontend/stock/index.details')</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="top__slider-images">
                                                <picture>
                                                    <source type="image/webp" class="lazy-srcset" data-srcset="{{ $item->getUrl() }}">
                                                    <img class="lazy" data-src="{{ $item->getUrl('sliders') }}"
                                                         alt="{{ empty($item->alt) ? $page->name : $item->alt }}"
                                                         title="{{ empty($item->title) ? $page->name : $item->title }}">
                                                </picture>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                        <div class="top__banners">
                            @foreach($stocks as $stock)
                                <div class="dropdown__banner-item">
                                    <div class="banner__info">
                                        <div class="banner__pretitle">
                                            {{ $stock->page ?  $stock->page->name : ''}}
                                        </div>
                                        <div class="banner__title">
                                            {{ Str::limit($stock->name, 20) }}
                                        </div>
                                        <div class="banner__text">
                                            {{ Str::limit($stock->description, 100) }}
                                        </div>
                                        <a href="{{ route('frontend.stock', $stock) }}" class="banner__link">
                                            @lang('frontend/stock/index.details')
                                        </a>
                                    </div>
                                    <div class="banner__images">
                                        <picture>
                                            <source type="image/webp" class="lazy-srcset" data-srcset="{{ $stock->getImageUrl('stocks_sm', true) }}">
                                            <img class="lazy" data-src="{{ $stock->getImageUrl('stocks_sm') }}"
                                                 alt="{{ $stock->name ?? $page->name }}"
                                                 title="{{ $stock->name ?? $page->name }}"/>
                                        </picture>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($bigCategories->count() || $smallCategories->count())
            <div class="products">
                <div class="container">
                    <div class="products__title">
                        {{ __('frontend.categories') }}
                    </div>
                    <div class="product--bg"></div>
                    @if($bigCategories->count())
                        <div class="products__items">
                            @foreach($bigCategories as $i => $category)
                                <a href="{{ $category->alias }}" class="products__item">
                                    <div class="products__item--hover"></div>
                                    <div class="products__item-inner">
                                        <picture>
                                            <source type="image/webp" class="lazy-srcset" data-srcset="{{ $category->getImageUrl('main_big_category', 'page_image', true) }}">
                                            <img class="lazy" data-src="{{ $category->getImageUrl('main_big_category', 'page_image') }}"
                                                 alt="{{ __('frontend.page_alt', ['name' => $category->name]) }}"
                                                 title="{{ __('frontend.page_title', ['name' => $category->name]) }}">
                                        </picture>
                                        <div class="products__item-title">
                                            {{ $category->name }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                    @if($smallCategories->count())
                        <div class="products__list-wrapper">
                            @foreach($smallCategories as $i => $category)
                                <a href="{{ $category->alias }}" class="products__list">
                                    <div class="products__item--hover"></div>
                                    <picture>
                                        <source type="image/webp" class="lazy-srcset" data-srcset="{{ $category->getImageUrl('main_small_category', 'page_image', true) }}">
                                        <img class="lazy" data-src="{{ $category->getImageUrl('main_small_category', 'page_image') }}"
                                             alt="{{ __('frontend.page_alt', ['name' => $category->name]) }}"
                                             title="{{ __('frontend.page_title', ['name' => $category->name]) }}">
                                    </picture>
                                    <div class="products__list-text">
                                        {{ $category->name }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                    @if($mainServices->count())
                        <div class="services__title">
                            {{ __('frontend.services') }}
                        </div>
                        <div class="services__items">
                            @foreach($mainServices as $i => $service)
                                <div class="services__item">
                                    <div class="services__item-inner" style="background-image: url({{ $service->getImageUrl('main_service', 'service_image') }});">
                                        <a href="{{ $service->alias }}">
                                            <div class="services__item--hover"></div>
                                        </a>
                                        <div class="services__item-text">
                                            {!! $service->name !!}
                                            <div class="benefits__line"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if($advantages->count() > 0)
            <div class="benefits">
                <div class="benefits__gradient"></div>
                <div class="container">
                    <div class="benefits__title">
                        {{ __('frontend.benefits') }}
                    </div>
                    <div class="benefits__items">
                        @foreach($advantages as $advantage)
                            <div class="benefits__item">
                                <picture>
                                    <source type="image/webp" class="lazy-srcset" data-srcset="{{ $advantage->getImageUrl('page_md', 'img', true) }}">
                                    <img class="lazy" data-src="{{ $advantage->getImageUrl('page_md', 'img') }}"
                                         alt="{{ $advantage->name }}"
                                         title="{{ $advantage->name }}">
                                </picture>
                                <div class="benefits__item-title">
                                    {{ $advantage->name }}
                                </div>
                                <div class="benefits__item-text">
                                    {!! $advantage->description !!}
                                </div>
                                <div class="benefits__line"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
