@extends('backend.layouts.backend')

@section('title', __('backend.manage_product_group'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
            'url' => route('backend.products.group.update', $product),
            'method'=>'POST',
            'autocomplete'=>'off',
             "novalidate" => 'novalidate',
            'class'=>'form-horizontal validate form-label-left']) !!}

            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="group-tab" data-toggle="tab" href="#group" data-tab="#group"
                           role="tab"
                           aria-controls="group" aria-selected="false">
                            @lang('backend.group_product') </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="root-tab tab-pane fade active in" id="group" role="tabpanel"
                         aria-labelledby="group-tab">
                        <div class="row">
                            <table class="table-index table table-striped">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-sort-numeric-asc"></i></th>
                                    <th width="10%">@lang('backend.cover')</th>
                                    <th width="50%">@lang('backend.name')</th>
                                    <th width="20%">@lang('backend.sku')</th>
                                    <th width="20%">@lang('backend.main_of_group')</th>
                                    <th width="25px"></th>
                                    <th width="25px"></th>
                                </tr>
                                </thead>
                                <tbody id="group_products">
                                @foreach($group_products as $group_product)
                                    @include('backend.products.include.product', [
                                        'cover' => $group_product->cover->image,
                                        'name' => $group_product->full_name,
                                        'sku' => $group_product->sku,
                                        'parent' => $group_product->parent_id == $group_product->id,
                                        'id' => $group_product->id,
                                    ])
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            {!! Form::select('query', [], null, ['class' => 'form-control js_products_search has-feedback-left'])!!}
                        </div>
                    </div>

                </div>
            </div>

            @include('backend.elements.save_buttons', ['back_link' => route('backend.products.edit', $product).'#group',
            ])

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/products_group.css')) }}
    {{ Html::style('assets/backend/modules/iCheck/skins/flat/green.css') }}
@endsection

@section('scripts')
    <script>
        window.custom_var = {
            url_filters_category: '{{route('backend.filters.categories')}}',
            product_id: '{{$product}}',
            product_template    : `\ @include('backend.products.include.product')\ `,
            product_search_url  : '{{route('backend.products.search')}}',
            product_remove_url  : '{{route('backend.products.group.remove', ['product' => ''])}}',
            placeholder_products: '@lang('backend.placeholder_products')',
        };
    </script>
    {{ Html::script('assets/backend/modules/iCheck/icheck.min.js') }}
    {{ Html::script(mix('assets/backend/js/product_group.js')) }}
@endsection