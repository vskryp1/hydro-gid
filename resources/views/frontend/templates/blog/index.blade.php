@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/blog.min.css')) !!}
@endsection

@section('scripts')
    @parent
    <script>
        window.shop                = {};
        window.shop.filters        = {};
        window.shop.more_url       = '{{ route('ajax.page.more', ['alias' => PageAlias::PAGE_BLOG, 'category' => !is_countable($current_category) ? $current_category->id : null]) }}';
        window.shop.filters.offset = 0;
        window.shop.filters.limit  = {!! ShopHelper::setting('count-article', '', false) !!};
    </script>
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="blog">
            <div class="container">
                @include('frontend.elements.breadcrumbs')
            </div>
            <div class="blog__title page--line">
                <div class="container">
                    @lang('frontend/content/index.blog')
                </div>
                {{ Form::open(['url' => route('frontend.page', PageAlias::PAGE_BLOG), 'method' => 'GET']) }}
                <div class="sort-holder">
                    {{ Form::select('category', $categories, !is_countable($current_category) ? $current_category->id : null, ['class' => 'sort-select js-blog-select']) }}
                </div>
                {{ Form::close() }}
            </div>
            <div class="container">
                <div class="blog__items">
                    <div class="blog__items row js-items">
                        @include('frontend.templates.blog.include.items')
                    </div>
                    <div class="btn-see-more js_show_more @unless($showMoreAvailable) display-none @endunless">
                        <span class="icon icon-rotate"></span>
                        <a href="#">@lang('frontend/product/index.show_more')</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
