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
                    <div>
                        <div class="form-group">
                            <label>@lang('backend.code') <span class="required">*</span></label>
                            {{Form::text('code', null, ["class" => "form-control"] )}}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.title') <span class="required">*</span></label>
                            {{Form::text('name', null, ["class" => "form-control"] )}}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.sign') <span class="required">*</span></label>
                            {{Form::text('sign', null, ["class" => "form-control"] )}}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.course')</label>
                            {{Form::number('course', isset($currency) && $currency->course ? $currency->course->course : 1, ["class" => "form-control", "step" => "0.1", "min" => "0.1"] )}}
                        </div>
                        <div class="checkbox">
                            {{Form::checkbox('default', 1, null, ['class' => 'js-switch'])}}
                            @lang('backend.default')
                        </div>
                        <div class="checkbox">
                            {{Form::checkbox('active', 1, null, ['class' => 'js-switch'])}}
                            @lang('backend.active')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.save_buttons', ['back_link' => route('backend.settings.currencies.index')])