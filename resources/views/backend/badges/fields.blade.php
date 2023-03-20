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
                            <label>@lang('backend.position')</label>
                            {!! Form::number('position',  null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('is_filter', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.use_as_filter')
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.active')
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
                                {!! Form::text( $lang . '[name]', (isset($badge)) ? $badge->{'name:'.$lang} : null,['class'=>'form-control','placeholder'=>__('backend.name').' '.$lang,'data-validation'=>'required', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.description') <span class="required">*</span></label>
                                {!! Form::textarea( $lang . '[description]', (isset($badge)) ? $badge->{'description:'.$lang} : null,['class'=>'form-control ck-editor','placeholder'=>__('backend.description').' '.$lang]) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.image')</label>
                                @if(isset($badge) && $badge->{'image:'.$lang} != '')
                                    <br>
                                    <div class="text-center">
                                        <img src="/cache/badge_md/{{$badge->{'image:'.$lang} }}" width="250px">
                                    </div>
                                    <br>
                                @endif
                                {!! Form::file($lang . '[image]', ['class'=>'form-control','placeholder'=>__('backend.image')]) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.image_sm')</label>
                                @if(isset($badge) && $badge->{'image_sm:'.$lang} != '')
                                    <br>
                                    <div class="text-center">
                                        <img src="/cache/badge_md/{{$badge->{'image_sm:'.$lang} }}" width="250px">
                                    </div>
                                    <br>
                                @endif
                                {!! Form::file($lang . '[image_sm]', ['class'=>'form-control','placeholder'=>__('backend.image_sm')]) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.save_buttons', ['back_link' => route('backend.products.badges.index')])