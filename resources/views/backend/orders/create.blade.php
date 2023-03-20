@extends('backend.layouts.backend')

@section('title', __('backend.order_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.orders.store'),'method'=>'POST','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
            @include('backend.orders.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/orders.css')) }}
    {{ Html::style('assets/backend/modules/iCheck/skins/flat/green.css') }}
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Orders\OrderRequest')->ignore('') !!}
    <script>
        window.custom_var = {
            product_template: `\ @include('backend.orders.product')\ `,
            product_search_url: '{{route('backend.products.search')}}',
            client_search_url: '{{route('backend.clients.search')}}',
            address_search_url: '{{route('backend.clients.addresses',['client' => ''])}}',
            placeholder_clients: '@lang('backend.placeholder_clients')',
            placeholder_products: '@lang('backend.placeholder_products')'
        };
        window.shop = {
            cart: {
                urls: {
                    delivery_place: '{{ route('ajax.cart.delivery_place', ['delivery' => null]) }}',
                    nova_poshta_warehouses: JSON.parse('{!! json_encode($warehouse_routes) !!}'),
                }
            }
        };
    </script>

    {{ Html::script('assets/backend/modules/iCheck/icheck.min.js') }}
    {{ Html::script(mix('assets/backend/js/order.js')) }}
@endsection
