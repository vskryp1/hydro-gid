@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')
@section('seo_content')
    {!! $seo_meta['seo_content'] !!}
@endsection

@section('styles')
    @parent
    {!! Html::style(mix('/assets/frontend/css/service.min.css')) !!}
@endsection

@section('scripts')
    @parent
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="page--line">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
        </div>
        <div class="service__inner">
            <div class="container">
                <div class="service__item">
                    <div class="service__title">
                        {{ $page->name }}
                    </div>
                    <div class="service__item-content">
                        <div class="service__item-img">
                            <picture>
                                <source type="image/webp" srcset="{{ $page->getImageUrl('service', 'service_image', true) }}">
                                <img src="{{ $page->getImageUrl('service', 'service_image') }}"
                                     alt="{{ __('frontend.page_alt', ['name' => $page->name]) }}"
                                     title="{{ __('frontend.page_title', ['name' => $page->name]) }}">
                            </picture>
                        </div>
                        <div class="service__item-text">
                            {!! $page->introtext !!}
                            <div class="service__item-btn">
                                <a href="#service">@lang('frontend/service/index.to_order_service')</a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! $page->description !!}
                <div class="bottom__form">
                    <div class="bottom__form-title">
                        @lang('frontend/service/index.order_service')
                    </div>
                    @include('frontend.elements.forms.service-order')
                </div>
            </div>
        </div>
    </main>
@endsection