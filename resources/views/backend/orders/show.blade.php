@extends('backend.layouts.backend')

@section('title')
    @lang('backend.order') #{{$order->unique_id}}
@endsection

@section('content')
    <div class="x_content">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="table-responsive">
                    <table class="table table-small table-bordered table-sm">
                        <tr>
                            <th>@lang('backend.client_email')</th>
                            <td>{{ $order->client->email}}</td>
                        </tr>

                        <tr>
                            <th>@lang('backend.uni')</th>
                            <td>{{ $order->unique_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('backend.status')</th>
                            <td>{{ isset($order->orderStatus) ? $order->orderStatus->name : null}}</td>
                        </tr>
                    </table>
                    <table class="table table-small table-bordered table-sm">
                        <thead>
                        <tr role="row">
                            <th>@lang('backend.name')</th>
                            <th>@lang('backend.quantity')</th>
                            <th>@lang('backend.price')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <h2>@lang('backend.products')</h2>
                        @foreach($order->products as $product)
                            <tr role="row">
                                <td>{{$product->name}}</td>
                                <td>{{$product->pivot->quantity}}</td>
                                <td>{{$product->price}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h1>@lang('backend.total_price') : {{$order->total_price}}</h1>
                </div>
                @include('backend.elements.edit_buttons', [
                                'edit_link'    => route('backend.orders.edit',['order'=> $order]),
                                'permission'   => 'orders'
                        ])
            </div>
        </div>
    </div>
@endsection