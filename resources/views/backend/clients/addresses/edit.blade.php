@extends('backend.layouts.backend')

@section('title', __('backend.edit_address'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::model($address, [
                'id'     => 'address-form',
                'url'    => route('backend.clients.addresses.update', ['client' => $client, 'address' => $address]),
                'method' => 'PUT',
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