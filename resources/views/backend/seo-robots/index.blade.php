@extends('backend.layouts.backend')

@section('title', __('backend.robots_txt_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.seo-robots.update'), 'method'=>'PUT', 'data-parsley-validate','autocomplete' => 'off']) !!}
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
                         aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label>@lang('backend.robots_txt_content')</label>
                                    {!! Form::textarea('contents', $robotsContent, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @can('edit seo robots')
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <button type="submit" class="btn btn-primary text-uppercase pull-right"><i
                                class="fa fa-save"></i> @lang('backend.save')</button>
                </div>
            @endcan
            {!! Form::close() !!}
        </div>
    </div>
@endsection
