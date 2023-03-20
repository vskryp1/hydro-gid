@extends('backend.layouts.backend')

@section('title', __('backend.faq_category_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model( $category, ['url' => route('backend.faqs.categories.update', ['category' => $category]),'method'=>'PUT','autocomplete'=>'off', 'files' => true, 'class'=>'form-horizontal form-label-left']) !!}
            @include('backend.faq-categories.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection