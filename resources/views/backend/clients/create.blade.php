@extends('backend.layouts.backend')

@section('title', __('backend.create_client'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open([
                'id'     => 'clients-form',
                'route'  => 'backend.clients.store',
                'method' => 'POST',
            ]) !!}
            @include('backend.clients.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Clients\SaveFormRequest', '#clients-form') !!}
    {!! Html::script(mix('/assets/backend/js/clients.js')) !!}
@endsection