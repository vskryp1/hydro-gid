@extends('frontend.layout')

@section('image',$page->getImageUrl('page_blog_one'))
@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')
@section('blogSeo')
    @include('frontend.templates.blog_one.include.blogSeo')
@endsection

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
        <div class="blog blog-one__page">
            <div class="page--line">
                <div class="container">
                    <div class="row">
                        @include('frontend.elements.breadcrumbs')
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="blog-one__inner">
                    <div class="blog-one__content article">
                        <div class="article__title">
                            {{ $page->name }}
                        </div>
                        @include('frontend.templates.blog_one.include.info')
                        <picture>
                            <source type="image/webp" srcset="{{ $page->getImageUrl('page_blog_one', 'image', true) }}">
                            <img src="{{ $page->getImageUrl('page_blog_one') }}"
                                 alt="{{ $page->name }}"
                                 title="{{ $page->name }}">
                        </picture>
                        {!!  $page->description !!}
                        @include('frontend.templates.blog_one.include.info')
                    </div>
                    <div class="blog-one__aside">
                        @if($page->products->isNotEmpty())
                            <div class="blog-one__aside-checkout">
                                <div class="checkout__aside-title">
                                    @lang('frontend/content/index.used_product_in_article'):
                                </div>
                                @foreach($page->products as $product)
                                    <a href="{{ $product->alias }}" target="_blank">
                                        <div class="checkout__aside-item">
                                            <picture>
                                                <source type="image/webp" srcset="{{ $product->cover->getUrl('prod_md', true) }}">
                                                <img class="checkout__aside-img"
                                                     src="{{ $product->cover->getUrl('prod_md') }}"
                                                     alt="{{ $product->cover->getImageAlt() }}"
                                                     title="{{ $product->cover->getImageAlt() }}">
                                            </picture>
                                            <div class="checkout__aside-info">
                                                <div class="checkout__aside-text">{{ $product->name }}</div>
                                                <div class="checkout__aside-number">
                                                    <div class="checkout__aside-prise">
                                                        {{ $product->format_price }} <span>@lang('frontend/product/index.uah')</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        <div class="latest-publications">
                            <div class="latest-publications__title">
                                @lang('frontend/content/index.last_published'):
                            </div>
                            @foreach($articles as $article)
                                @if( $article->alias != $page->alias )
                                    <a href="{{ $article->alias }}">
                                        <div class="latest-publications__item">
                                            <div class="latest-publications__date">
                                                <i class="icon icon-calendar"></i>
                                                {{ $article->updated_at->translatedFormat('j F Y') }}
                                            </div>
                                            <div class="latest-publications__text">
                                                {{ $article->name }}
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        @include('frontend.elements.forms.subscribe-blog')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
