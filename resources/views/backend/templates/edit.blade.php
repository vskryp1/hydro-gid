@extends('backend.layouts.backend')

@section('title')
    @lang('backend.edit_template')
@endsection

@section('content')
<div class="panel panel-default user-panel panel-flat">
    <div class="panel-body">
        <div class="col-11 col-sm-11 col-md-11 col-lg-11">
            <div class="bgc-white p-20 bd">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="base-tab" data-toggle="tab" href="#locale" data-tab="#locale" role="tab"
                           aria-controls="home" aria-selected="true">
                            @lang('backend.locale') </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="locale" role="tabpanel"
                         aria-labelledby="locale    ">
                        {!! Form::model($template, ['url' => route('backend.mail.templates.update',['template' => $template]),'method'=>'PUT','autocomplete'=>'off']) !!}
                            @include('backend.templates.fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Template\TemplateRequest')->ignore('') !!}
@endsection
