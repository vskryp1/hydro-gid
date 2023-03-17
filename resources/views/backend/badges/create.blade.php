@extends('backend.layouts.backend')

@section('title', __('backend.badges_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.products.badges.store'),'method'=>'POST','autocomplete'=>'off', 'files' => true, 'class'=>'form-horizontal form-label-left']) !!}
                @include('backend.badges.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\BadgeStoreRequest')->ignore('') !!}
@endsection

@section('styles')
@endsection