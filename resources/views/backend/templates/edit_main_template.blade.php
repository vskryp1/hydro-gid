@extends('backend.layouts.backend')

@section('title')
    @lang('backend.edit_main_template')
@endsection

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.update.main.template'),'method'=>'PUT','autocomplete'=>'off']) !!}
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">

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
                        <div class="form-group">
                            <label for="template-body">@lang('backend.body')</label>
                            {!! Form::textarea('body', (isset($body)) ? $body : null, ['class'=>'form-control','placeholder'=>'Body...','required','id'=>'template-body']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <button type="submit" class="btn btn-primary text-uppercase pull-right"><i
                            class="fa fa-save"></i> @lang('backend.save')</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection