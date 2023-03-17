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

{!! Html::style(mix('/assets/frontend/css/blog.min.css')) !!}
@endsection

@section('scripts')
@parent

{!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
<main>
<div class="sitemap">
<div class="container">
<div class="row">
@include('frontend.elements.breadcrumbs')
</div>
</div>
<div class="sitemap__title page--line">
<div class="container">
{{ $page->name }}
</div>
</div>
<div class="container">
{!! $page_list !!}
</div>
</div>
</main>
@endsection