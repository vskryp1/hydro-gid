@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', 'noindex')
@section('canonical', $seo_meta['seo_canonical'])
@section('seo_content')
    {!! $seo_meta['seo_content'] !!}
@endsection
@section('h1')
    <h1>
        {!! $seo_meta['seo_h1'] !!}
    </h1>
@endsection
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/blog-one.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="blog content-page">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="page--line">
                <div class="page__title page--line">
                    <div class="container">
                        {{ $page->name }}
                    </div>
                </div>
            </div>
            <div class="container content">
                <div class="content__introtext">
                    {!! $page->introtext !!}
                </div>
                <div class="content__description">
                    {!! $page->description !!}
                </div>
            </div>
        </div>
    </main>
@endsection
