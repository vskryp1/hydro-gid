@extends('backend.layouts.backend')

@section('title', __('backend.menu_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url' => route('backend.menus.store'),
                'method'=>'POST',
                'autocomplete'=>'off',
                'class'=>'form-horizontal form-label-left'
            ]) !!}
                @include('backend.menus.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection