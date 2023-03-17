@extends('backend.layouts.backend')

@section('title', __('backend.create_template'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                {!! Form::open([
                    'id'     => 'template-form',
                    'class'  => "template form-horizontal form-label-left",
                    'route'  => 'backend.templates.store',
                    'method' => 'POST',
                ]) !!}
                    @include('backend.page-templates.fields')
                    @include('backend.elements.save_buttons', ['back_link' => route('backend.pages.index')])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Page\PageTemplateRequest', '#template-form') !!}
@endsection