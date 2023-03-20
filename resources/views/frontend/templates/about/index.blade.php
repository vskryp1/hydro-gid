@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/about.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="about">
            <div class="container">
                @include('frontend.elements.breadcrumbs')
            </div>
            <div class="page--line">
                <div class="container">
                    <div class="about__head">
                        <div class="about__title">
                            @lang('frontend.leadership')
                        </div>
                        <div class="about__logo">
                            <img src="{{ asset('/assets/frontend/images/logo@2.png') }}" alt="{{ $page->name }}" title="{{ $page->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="about__content">
                <div class="about__text">
                    {!! $page->introtext !!}
                </div>
                <div class="about__content-images"></div>
                <div class="about__content-box">
                    {!! $page->description !!}
                </div>
            </div>
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
                                        <source type="image/webp" srcset="{{ $advantage->getImageUrl('page_md', 'img', true) }}">
                                        <img src="{{ $advantage->getImageUrl('page_md', 'img') }}"
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
            @isset($slider_about)
            <div class="partners">
                <div class="container">
                    <div class="pertners__title">
                        @lang('frontend.our_partner')
                    </div>
                    <div class="partners__items">
                        @foreach($slider_about->slider_items as $item)
                            <div class="partners__items-img">
                                <picture>
                                    <source type="image/webp" srcset="{{ $item->getUrl('', true) }}">
                                    <img src="{{ $item->getUrl() }}"
                                         alt="{{ empty($item->alt) ? $page->name : $item->alt }}"
                                         title="{{ empty($item->title) ? $page->name : $item->title }}">
                                </picture>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="about__gallery">
                <div class="container">
                    <div class="about__gallery-inner">
                        @foreach($slider_gallery->slider_items as$key => $item)
                            @switch($key)
                                @case(0)
                                <a href="{{ $item->getUrl() }}" data-fancybox="images">
                                    <picture>
                                        <source type="image/webp" srcset="{{ $item->getUrl('slider_lg', true) }}">
                                        <img src="{{ $item->getUrl('slider_lg') }}"
                                             alt="{{ empty($item->alt) ? $page->name : $item->alt }}"
                                             title="{{ empty($item->title) ? $page->name : $item->title }}">
                                    </picture>
                                </a>

                                @break
                                @case(7)
                                <a href="{{ $item->getUrl() }}" data-fancybox="images">
                                    <picture>
                                        <source type="image/webp" srcset="{{ $item->getUrl('slider_slim', true) }}">
                                        <img src="{{ $item->getUrl('slider_slim') }}"
                                             alt="{{ empty($item->alt) ? $page->name : $item->alt }}"
                                             title="{{ empty($item->title) ? $page->name : $item->title }}">
                                    </picture>
                                </a>

                                @break
                                @default
                                <a href="{{ $item->getUrl() }}" data-fancybox="images">
                                    <picture>
                                        <source type="image/webp" srcset="{{ $item->getUrl('slider_sm', true) }}">
                                        <img src="{{ $item->getUrl('slider_sm') }}"
                                             alt="{{ empty($item->alt) ? $page->name : $item->alt }}"
                                             title="{{ empty($item->title) ? $page->name : $item->title }}">
                                    </picture>
                                </a>
                            @endswitch
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </main>
@endsection