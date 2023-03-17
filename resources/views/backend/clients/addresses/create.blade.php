@extends('backend.layouts.backend')

@section('title', __('backend.create_address'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open([
                'id'     => 'address-form',
                'url'    => route('backend.clients.addresses.store', ['client' => $client]),
                'method' => 'POST',
            ]) !!}
            @include('backend.clients.addresses.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.shop = {
            cart: {
                urls: {
                    delivery_place        : '{{ route('ajax.cart.delivery_place', ['delivery' => null]) }}',
                }
            }
        }
    </script>
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Addresses\SaveFormRequest', '#address-form') !!}
@endsection