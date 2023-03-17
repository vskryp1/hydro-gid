@extends('backend.layouts.backend')

@section('title', __('backend/faq/index.create_faq'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url'          => route('backend.faqs.store'),
                'method'       => 'POST',
                'autocomplete' => 'off',
                'class'        => 'form-horizontal form-label-left',
            ]) !!}
            @include('backend.faqs.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Faq\FaqRequest')->ignore('') !!}
@endsection