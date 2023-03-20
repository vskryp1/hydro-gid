@extends('backend.layouts.backend')

@section('title', __('backend/faq/index.edit_faq'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($faq, [
                'url'          => route('backend.faqs.update', $faq),
                'method'       => 'PUT',
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