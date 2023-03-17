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
        {!! $seo_meta['seo_h1'] !!}
    </h1>
@endsection
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/category.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/category.js')) !!}
@endsection

@section('content')
    <main class="main">
        <div class="products" style="background-image: url('{{ url('/assets/frontend/images/serv-bg-comp.png') }}');">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="container">
                <div class="products__title">
                    {{ $page->name }}
                </div>
                @if($page->children_active->count() > 0)
                    <div class="products__list-wrapper">
                        @foreach($page->children_active as $child)
                            <a href="{{ $child->alias }}">
                                <div class="products__list">
                                    <div class="products__item--hover"></div>
                                    <picture>
                                        <source type="image/webp" class="lazy-srcset" data-srcset="{{ $child->getImageUrl('category', 'page_image', true) }}">
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
    </main>
@endsection