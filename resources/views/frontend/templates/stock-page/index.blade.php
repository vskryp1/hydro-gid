@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent
    {!! Html::style(mix('/assets/frontend/css/stock-page.min.css')) !!}
@endsection

@section('scripts')
    @parent
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="page--line stock-page__top">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
        </div>
        <div class="stock-page__inner">
            <div class="container">
                <div class="stock-page__item">
                    <div class="stock-page__title">
                        {{ $stock->name }}
                    </div>
                    <div class="stock-page__info">
                        <span class="icon-time icon"></span>
                        @lang('frontend/stock/index.stocks_is_active_from')
                        {{ $stock->start_date->translatedFormat('j F Y') }}
                        @lang('frontend/stock/index.till')
                        {{ $stock->expiration_date->translatedFormat('j F Y') }}
                    </div>
                    <div class="stock-page__item-content">
                        <div class="stock-page__item-img">
                            <picture>
                                <source type="image/webp" srcset="{{ $stock->getImageUrl('stocks', true) }}">
                                <img src="{{ $stock->getImageUrl() }}"
                                     alt="{{ $stock->name }}"
                                     title="{{ $stock->name }}"/>
                            </picture>
                        </div>
                        <div class="stock-page__item-text">
                            {{ $stock->description }}
                            <div class="stock-page__item-btn">
                                <a href="#stock-products">@lang('frontend/stock/index.watch_stock_products')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="stock-products" class="stock-page__title-product">
                    @lang('frontend/stock/index.stock_products')
                </div>
                <div class="row category-product js_height-block">
                    @foreach($stock->products as $product)
                        @include('frontend.templates.category.include.product_item')
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
