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
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label>@lang('backend.position')</label>
                        {!! Form::number('position', old('position'), ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="active">@lang('backend.active')</label><br>
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active', 1, null, ['id' => 'active', 'class' => 'js-switch']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="locale" role="tabpanel" aria-labelledby="home-tab">
            <div class="row tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical" id="locales-tab" role="tablist" aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class="@if($loop->first) active @endif">
                            <a class="nav-link" id="locale-{{ $lang }}-tab" data-toggle="pill"
                               href="#locales-{{ $lang }}" role="tab" aria-controls="locales-{{ $lang }}"
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
                                <label>@lang('backend/faq/index.question') <span class="required">*</span></label>
                                {!! Form::text($lang . '[question]', $faq->{'question:' . $lang} ?? null, [
                                    'class'       => 'form-control',
                                    'placeholder' => __('backend/faq/index.question') . ' ' . $lang,
                                    'maxLength'=>'1000',
                                    'required'    => true,
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend/faq/index.answer') <span class="required">*</span></label>
                                {!! Form::textarea($lang . '[answer]', $faq->{'answer:' . $lang} ?? null, [
                                    'class'       => 'form-control ck-editor',
                                    'placeholder' => __('backend/faq/index.answer') . ' ' . $lang,
                                    'maxLength'=>'1000',
                                    'required'    => true,
                                ]) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.faqs.index')])