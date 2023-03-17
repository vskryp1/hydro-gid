<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
               aria-controls="home" aria-selected="true">
                @lang('backend.base') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="locale-tab" data-toggle="tab" href="#locale" data-tab="#locale"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.locale') </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel"
             aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <div class="form-group">
                            <label>@lang('backend.color')</label>
                            {!! Form::text('color',  null, ['class'=>'form-control colorpicker-element']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.class')</label>
                            {!! Form::text('class',  null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.active')
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('in_stock', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.in_stock')
                        </div>
                        <div class="checkbox">
                            {{Form::checkbox('default', 1, null, ['class' => 'js-switch'])}}
                            @lang('backend.default')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="locale" role="tabpanel" aria-labelledby="home-tab">
            <br>
            <div class="row tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class=" @if ($loop->first) active @endif"><a class="nav-link"
                                                                         id="v-pills-{{ $lang }}-tab"
                                                                         data-toggle="pill"
                                                                         href="#v-pills-{{ $lang }}"
                                                                         role="tab"
                                                                         aria-controls="v-pills-{{ $lang }}"
                                                                         aria-selected="true">{{ strtoupper($lang) }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="v-pills-tabContent">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane fade @if ($loop->first)in active @endif"
                             id="v-pills-{{ $lang }}" role="tabpanel"
                             aria-labelledby="v-pills-{{ $lang }}-tab">
                            <div class="form-group">
                                <label>@lang('backend.name') <span class="required">*</span></label>
                                {!! Form::text( $lang . '[name]', (isset($product_status)) ? $product_status->{'name:'.$lang} : null,['class'=>'form-control','placeholder'=>__('backend.name').' '.$lang,'data-validation'=>'required', 'required']) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.save_buttons', ['back_link' => route('backend.products.statuses.index')])