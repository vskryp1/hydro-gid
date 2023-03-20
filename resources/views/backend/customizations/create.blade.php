@extends('backend.layouts.backend')

@section('title', __('backend.customizations_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.pages.customizations.store'),'method'=>'POST','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
                @include('backend.customizations.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Page\CustomizationStoreRequest')->ignore('') !!}
@endsection

@section('styles')
@endsection