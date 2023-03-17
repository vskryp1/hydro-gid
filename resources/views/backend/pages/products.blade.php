@extends('backend.layouts.backend')

@section('title', __('backend.save_sort'))
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::open(array('url' => URL::route('backend.pages.update.product.sort'),'method' => 'POST')) !!}
        <div class="table-responsive">
            <table class="table-index table table-striped">
                <thead>
                <tr>
                    <th width="2%"><i class="fa fa-sort-numeric-asc"></i></th>
                    <th width="12%">@lang('backend.cover')</th>
                    <th width="12%">@lang('backend.sku')</th>
                    <th width="12%">@lang('backend.name')</th>
                    <th width="10%">@lang('backend.price')</th>
                    <th width="8%">@lang('backend.active')</th>
                    <th width="8%">@lang('backend.status')</th>
                    <th width="8%">@lang('backend.categories')</th>
                </tr>
                </thead>
                <tbody id="category_products">
                @forelse($products as $product)
                    <tr>
                        {{Form::hidden("products[]", $product->id)}}
                        <td>
                            <div class="">
                                <br>
                                <i class="fa fa-arrows-v"></i>
                            </div>
                        </td>
                        <td><img width="35px" src="/cache/prod_sm/{{$product->cover->image??''}}" alt="{{$product->cover->alt??''}}"></td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{ShopHelper::price_format($product->original_price, true)}} {{$product->currency->sign??''}}</td>
                        <td>
                            @if($product->active)
                                <span class="label label-success">@lang('backend.yes')</span>
                            @else
                                <span class="label label-danger">@lang('backend.no')</span>
                            @endif
                        </td>
                        <td>{{$product->product_status->name??''}}</td>
                        <td>{{$product->pages->pluck('name')->toArray()[0]}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="bg-warning">
                            <h3 class="text-center">
                                @lang('backend.nothing_found')
                            </h3>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @include('backend.elements.save_buttons', [
                'save_order'       => route('backend.pages.update.product.sort'),
            ])
        {{Form::hidden("page", $page->id)}}
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    {{ Html::script(mix('assets/backend/js/pages/products_sort.js')) }}
@endsection