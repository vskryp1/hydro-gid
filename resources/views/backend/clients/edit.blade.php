@extends('backend.layouts.backend')

@section('title', __('backend.edit_client'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::model($client, [
                'id'     => 'clients-form',
                'route'  => ['backend.clients.update', $client],
                'method' => 'PUT',
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