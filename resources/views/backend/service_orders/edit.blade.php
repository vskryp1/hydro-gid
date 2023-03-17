@extends('backend.layouts.backend')

@section('title', __('backend/service/index.edit'))

@section('content')
    <div class="panel">
        <div class="panel-default">
            <div class="panel-body">
                {!! Form::model($serviceOrder, [
                    'route'  => ['backend.service-orders.update', $serviceOrder],
                    'method' => 'PUT',
                    'files'  => true
                ]) !!}
                @include('backend.service_orders.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Backend\ServiceOrder\SaveFormRequest') !!}
@endsection