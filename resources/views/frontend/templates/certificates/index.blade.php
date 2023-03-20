@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent
    {!! Html::style(mix('/assets/frontend/css/certificates.min.css')) !!}
@endsection

@section('scripts')
    @parent
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="certificates">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="page__title page--line">
                <div class="container">
                    @lang('frontend/content/index.certificates')
                </div>
            </div>
            <div class="container">
                <div class="certificates__inner">
                    @if($slider )
                        @foreach($slider->slider_items as $item)
                            <div class="certificates__item-img">
                                <a href="{{ $item->getUrl() }}" data-fancybox="images">
                                    <img src="{{ $item->getUrl() }}" alt="{{ empty($item->alt) ? $page->name : $item->alt }}" title="{{ empty($item->title) ? $page->name : $item->title }}"/>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
