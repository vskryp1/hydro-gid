@extends('backend.layouts.backend')

@section('title', __('backend.faq_category_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.faqs.categories.store'),'method'=>'POST','autocomplete'=>'off', 'files' => true, 'class'=>'form-horizontal form-label-left']) !!}
            @include('backend.faq-categories.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Faq\FaqCategoryRequest')->ignore('') !!}
@endsection

@section('styles')
@endsection