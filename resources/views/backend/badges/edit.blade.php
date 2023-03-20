@extends('backend.layouts.backend')

@section('title', __('backend.badges_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model( $badge, ['url' => route('backend.products.badges.update', ['badge' => $badge]),'method'=>'PUT','autocomplete'=>'off', 'files' => true, 'class'=>'form-horizontal form-label-left']) !!}
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