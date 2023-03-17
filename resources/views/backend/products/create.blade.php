@extends('backend.layouts.backend')

@section('title', __('backend.product_create_new'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
            'url' => route('backend.products.store'),
            'method'=>'POST',
            'files'=> true,
            'autocomplete'=>'off',
             "novalidate" => 'novalidate',
            'class'=>'form-horizontal validate form-label-left']) !!}
                @include('backend.products.include.fields')
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
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\StoreRequest')->ignore('') !!}
    <script>
        window.custom_var = {
            image_size: '{{config('app.image_size')/1024}}',
            previewTemplate: `\ @include("backend.products.include.galleryItem")\ `,
            text_least_category: '<h4 class="text-center"><i class="fa fa-info-circle"></i> @lang('backend.category_select_one')</h4>',
            text_nothing_found: '<h4 class="text-center"><i class="fa fa-info-circle"></i> @lang('backend.nothing_found')</h4>',
            old_main: '{{old('main_category')??''}}',
            url_filters_category: '{{route('backend.filters.categories')}}',
            product_id: null,
            product_search_url  : '{{route('backend.products.search')}}',
            placeholder_products: '@lang('backend.placeholder_products')',
        };
    </script>
    {{ Html::script('assets/backend/modules/iCheck/icheck.min.js') }}
    {{ Html::script(mix('assets/backend/js/product.js')) }}
@endsection