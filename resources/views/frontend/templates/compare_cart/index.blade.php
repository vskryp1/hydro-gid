@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent
    {!! Html::style(mix('/assets/frontend/css/compare.min.css')) !!}
@endsection

@section('scripts')
    @parent
    {!! Html::script(mix('/assets/frontend/js/compare.js')) !!}
@endsection

@section('content')
    <main class="main compare-page">
        <div class="products" style="background-image: url('{{ url('/assets/frontend/images/serv-bg-comp.png') }}');">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
                <div class="page__title">@lang('frontend/compare/index.compare_products')</div>
            </div>
        </div>
        <section class="category__box container">
            @forelse($comparelist as $categoryId => $cartItems)
                <div class="category__box--parent">
                    <div class="h3">{{ $cartItems->first()->model->mainCategory->name }}</div>
                    <div class="category__box--item row">
                        @foreach($cartItems as $item)
                            <div class="col-md-4 col-sm-6 col-xs-12 compare-item__wrap">
                                <div class="checkout__aside-item">
                                    <picture>
                                        <source type="image/webp" srcset="{{ $item->model->cover->getUrl('prod_cart', true) }}">
                                        <img class="checkout__aside-img"
                                             src="{{ $item->model->cover->getUrl('prod_cart') }}"
                                             alt="{{ $item->model->cover->getImageAlt() }}"
                                             title="{{ $item->model->cover->getImageTitle() }}">
                                    </picture>
                                    <div class="checkout__aside-info">
                                        <div class="checkout__aside-text">{{ $item->model->name }}
                                        </div>
                                        <div class="checkout__aside-number">
                                            @if($item->model->inStock())
                                                <div class="prod-cart__prise-old">
                                                    {{ $item->model->format_price_old }}
                                                    <span>@lang('frontend/product/index.uah')</span>
                                                </div>
                                            @endif
                                            <div class="checkout__aside-prise">
                                                {{ $item->model->format_price }}
                                                <span>@lang('frontend/product/index.uah')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="main-btn main-btn--green" href="{{ route('frontend.page', [PageAlias::PAGE_COMPARE, 'category_id' => $categoryId]) }}">
                        @lang('frontend/compare/index.to_compare_products')
                        <i class="icon icon-balance"></i></a>
                </div>
            @empty
                <div class="empty">
                    @lang('frontend.no_products')
                </div>
            @endforelse
        </section>
    </main>
@endsection
