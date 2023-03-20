<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link"
               id="base-tab"
               data-toggle="tab"
               href="#base"
               data-tab="#base"
               role="tab"
               aria-controls="home"
               aria-selected="true">
                @lang('backend.base')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="locale-tab"
               data-toggle="tab"
               href="#locale"
               data-tab="#locale"
               role="tab"
               aria-controls="profile"
               aria-selected="false">
                @lang('backend.locale')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="api-tab"
               data-toggle="tab"
               href="#api"
               data-tab="#api"
               role="tab"
               aria-controls="profile"
               aria-selected="false">
                @lang('backend.api')
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="root-tab tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="type">@lang('backend.type') <span class="required">*</span></label>
                        {!! Form::select('type', PaymentType::toSelectArray(), null, [
                            'class'       => 'form-control select2',
                            'required'    => true,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="type">@lang('backend.regions') <span class="required">*</span></label>
                        {!! Form::select('regions[]', $regions, null, [
                            'class'       => 'form-control select2',
                            'multiple'    => true,
                            'required'    => true,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.position')</label>
                        {!! Form::number('position', null, ['class'=>'form-control', 'required', 'min' => 0]) !!}
                    </div>
                    <div class="form-group">
                        <label for="active">@lang('backend.active')</label><br>
                        {!! Form::hidden('is_active', 0) !!}
                        {!! Form::checkbox('is_active', 1, null, ['id' => 'active', 'class' => 'js-switch']) !!}
                    </div>
                    <div class="form-group">
                        <label for="default">@lang('backend.default')</label><br>
                        {!! Form::hidden('is_default', 0) !!}
                        {!! Form::checkbox('is_default', 1, null, ['id' => 'default', 'class' => 'js-switch']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="locale" role="tabpanel" aria-labelledby="home-tab">
            <div class="row tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical" id="locales-tab" role="tablist" aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class="@if($loop->first) active @endif">
                            <a class="nav-link"
                               id="locale-{{ $lang }}-tab"
                               data-toggle="pill"
                               href="#locales-{{ $lang }}"
                               role="tab"
                               aria-controls="locales-{{ $lang }}"
                               aria-selected="true">
                                {{ strtoupper($lang) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="locales-tabContent">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane fade @if($loop->first) in active @endif" id="locales-{{ $lang }}"
                             role="tabpanel" aria-labelledby="locales-{{ $lang }}-tab">
                            <div class="form-group">
                                <label>@lang('backend.name') <span class="required">*</span></label>
                                {!! Form::text($lang . '[name]', $payment->{'name:' . $lang} ?? null, [
                                    'class'       => 'form-control',
                                    'placeholder' => __('backend.name') . ' ' . $lang,
                                    'required'    => true,
                                ]) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="api" role="tabpanel" aria-labelledby="api-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="api_key_public">@lang('backend.api_key_public')</label><br>
                        {!! Form::text('api_key_public', null, ['id' => 'api_key_public', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="api_key_private">@lang('backend.api_key_private')</label><br>
                        {!! Form::text('api_key_private', null, ['id' => 'api_key_private', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="active">@lang('backend.sandbox_mode')</label><br>
                        {!! Form::hidden('api_key_sandbox', 0) !!}
                        {!! Form::checkbox('api_key_sandbox', 1, null, ['id' => 'api_key_sandbox', 'class' => 'js-switch']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.payments.index')])