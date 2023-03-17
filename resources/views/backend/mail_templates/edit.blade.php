@extends('backend.layouts.backend')

@section('title')
    @lang('backend.edit_mail_template')
@endsection

@section('content')
<div class="panel panel-default user-panel panel-flat">
    <div class="panel-body">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="bgc-white p-20 bd">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
                           aria-controls="home" aria-selected="true">
                            @lang('backend.base') </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="base" role="tabpanel"
                             aria-labelledby="base">
                        {!! Form::model($template, ['url' => route('backend.mail.email.templates.update',['template' => $template]),'method'=>'PUT','autocomplete'=>'off']) !!}
                        {!! Form::hidden('id', $template->id) !!}
                            @include('backend.mail_templates.fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Template\MailTemplatesRequest')->ignore('') !!}
@endsection