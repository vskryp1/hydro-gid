@extends('backend.layouts.backend')

@section('title')
    @lang('backend.newsletter_settings')
@endsection

@section('content')
<div class="">
    <div class="row">
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
                    <div class="root-tab tab-pane fade active in" id="base" role="tabpanel"
                         aria-labelledby="base">
                        {!! Form::open(['url' => route('backend.subscribers.settings.update'),'method'=>'PUT','autocomplete'=>'off']) !!}
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label for="template-name">@lang('backend.send_one_time')</label>
                                    {!! Form::text('mail_count', Setting::get('mail_count'),['class'=>'form-control','placeholder'=>'Number...','required']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="template-alias">@lang('backend.newsletter_timeout')</label>
                                    {!! Form::text('timeout', Setting::get('timeout'),['class'=>'form-control','placeholder'=>'Minutes ...','required']) !!}
                                </div>
                                <button type="submit" class="btn btn-primary text-uppercase">@lang('backend.submit')</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Subscribers\SubscribersRequest')->ignore('') !!}
@endsection
