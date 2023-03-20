@extends('backend.layouts.backend')

@section('title', __('backend.products'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.products.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
        'create_link'  => route('backend.products.create'),
        'name'         => __('backend.create_product'),
    ])
    <div class="table-responsive">
        <table class="table-index table table-striped">
            <thead>
            <tr>
                <th width="12%">@lang('backend.cover')</th>
                <th width="12%">@lang('backend.sku')</th>
                <th width="12%">@lang('backend.name')</th>
                <th width="10%">@lang('backend.price')</th>
                <th width="8%">@lang('backend.active')</th>
                <th width="8%">@lang('backend.status')</th>
                <th width="8%">@lang('backend.categories')</th>
                <th width="30%"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        {!! Html::image($product->cover->getUrl('prod_md'), $product->cover->alt, ['width' => 100]) !!}
                    </td>
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
                    <td>{{implode(', ', $product->pages->pluck('name')->toArray())}}</td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                            'edit_link'    => route('backend.products.edit', $product->id),
                            'destroy_link' => route('backend.products.destroy', $product),
                        ])
                    </td>
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
        {{ $products->links('backend.elements.pagination') }}
    </div>
@endsection
