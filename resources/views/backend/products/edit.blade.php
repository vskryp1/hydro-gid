@extends('backend.layouts.backend')

@section('title', __('backend.product_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($product, [
                'url' => route('backend.products.update',
                ['product' => $product->id]),
                'method'=>'PUT',
                'files'=> true,
                "novalidate" => 'novalidate',
                'autocomplete'=>'off',
                'class'=>'form-horizontal validate form-label-left',
                'id'=>'form-product'
            ]) !!}
            <div class="row">
                @include('backend.products.include.fields')
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('backend.products.include.uploadGalleryModal')
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/products.css')) }}
    {{ Html::style('assets/backend/modules/iCheck/skins/flat/green.css') }}
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\UpdateRequest')->ignore('') !!}
    <script>
        window.custom_var = {
            image_size: '{{config('app.image_size')/1024}}',
            previewTemplate: `\ @include("backend.products.include.galleryItem")\ `,
            text_least_category: '<h4 class="text-center"><i class="fa fa-info-circle"></i> @lang('backend.category_select_one')</h4>',
            text_nothing_found: '<h4 class="text-center"><i class="fa fa-info-circle"></i> @lang('backend.nothing_found')</h4>',
            old_main: '{{old('main_category')??$product->main_category->id??''}}',
            url_filters_category: '{{route('backend.filters.categories')}}',
            product_id: '{{$product->id}}',
            product_search_url  : '{{route('backend.products.search')}}',
            placeholder_products: '@lang('backend.placeholder_products')',
            text_manage_group_btn: '@lang('backend.save_to_manage_group')',
        };
    </script>
    {{ Html::script('assets/backend/modules/iCheck/icheck.min.js') }}
    {{ Html::script(mix('assets/backend/js/product.js')) }}
@endsection