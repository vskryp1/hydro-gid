@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/calculator.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="calculator page--line">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="page__title">
                <div class="container">
                    {{ $page->name }}
                </div>
            </div>
            <div class="calculator__items">
                @forelse($page->children_active as $i => $child)
                    @php(++$i)
                    <a href="{{ route('frontend.page', ['alias' => $child->getOriginal('alias')]) }}" class="calculator__item">
                        <div class="calculator__img">
                            {!! Html::image('/assets/frontend/images/calc/item-' . $i . '.png', $child->name, ['title' => $child->name]) !!}
                        </div>
                        <div class="calculator__text">
                            {{ $child->name }}
                        </div>
                    </a>
                @empty
                @endforelse
            </div>
        </div>
    </main>
@endsection