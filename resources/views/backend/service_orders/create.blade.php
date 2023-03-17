@extends('backend.layouts.backend')

@section('title', __('backend/service/index.create'))

@section('content')
    <div class="panel">
        <div class="panel-default">
            <div class="panel-body">
                {!! Form::open([
                    'route'  => 'backend.service-orders.store',
                    'method' => 'POST',
                    'files'  => true,
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