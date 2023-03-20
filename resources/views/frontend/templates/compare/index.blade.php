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
    <script>
        window.compare_list_url = "{{ route('frontend.page', PageAlias::PAGE_COMPARE_CART) }}";
    </script>
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
        <div id="table-scroll" class="table-scroll">
            <div class="table-wrap">
                <table class="main-table js_height-block">
                    <thead>
                    <tr>
                        <th class="fixed-side height" scope="col">
                            {{ Form::open(['url' => route('frontend.forms.user.remove.category.from.comparelist', [
                                     'user_id'       => auth('web')->id() ?? 'guest',
                                     'category_id'   => $products->first()->categoryId
                                 ])]) }}
                            <a href="#" class="js-compare-delete btn-delete">
                                <i class="icon icon-delete"></i>
                                @lang('frontend/compare/index.delete_whole_comparision')
                            </a>
                            <a href="{{ route('frontend.page', PageAlias::PAGE_COMPARE_CART) }}" class="btn-back">
                                <i class="icon icon-arrow-long"></i>

                            </a>
                            <div class="filter__items checkbox">
                                <div class="filter-area">
                                    <input type="checkbox" id="js-difference">
                                    <label for="js-difference" class="js-difference-label">
                                        @lang('frontend/compare/index.show_only_diff')
                                    </label>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </th>
                        @foreach($products as $product)
                            <th scope="col" class="col">
                                <i data-action="{{ route('ajax.user.remove.from.comparelist',
                                 [
                                     'user_id' => auth('web')->id() ?? 'guest',
                                     'rowId'   => $comparelist->firstWhere('id', $product->id)->rowId
                                 ]) }}"
                                   class="icon icon-delete js-btn-close js-btn-remove"></i>
                                @include('frontend.templates.compare.include.item')
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($filters as $filter)
                        @if($filter->filter_values->count())
                            <tr>
                                <th class="fixed-side js-filter"><span>{{ $filter->name }}</span></th>
                                @foreach($products as $product)
                                    <td>
                                        <span class="js-filter-value">
                                            {{ $product->filter_values->getFilterValueName($filter->id) }}
                                        </span>
                                    </td>
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection