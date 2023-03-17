<div class="root-tab tab-pane fade" id="locale" role="tabpanel" aria-labelledby="profile-tab">
    <div class="row tabs-vertical-env tabs-vertical-bordered">
        <ul class="nav tabs-vertical" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @foreach(Setting::get('locales') as $lang => $locale)
                <li class="@if ($loop->first) active @endif">
                    <a class="nav-link"
                       id="v-pills-{{ $lang }}-tab"
                       data-toggle="pill"
                       href="#v-pills-{{ $lang }}-locale"
                       aria-controls="v-pills-{{ $lang }}"
                       aria-selected="true">{{ strtoupper($lang) }}
                    </a>
                </li>
            @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content" id="v-pills-tabContent-locale">
            @foreach(Setting::get('locales') as $lang => $locale)
                <div class="tab-pane  @if ($loop->first) active @endif" id="v-pills-{{ $lang }}-locale">
                    <div class="form-group">
                        <label for="roleName">@lang('backend.page_title')</label>
                        {!! Form::text($lang . '[name]', isset($page) && $page->translate($lang) ? $page->translate($lang)->name : null  ,['class'=>'form-control','data-validation'=>'required', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="roleName">@lang('backend.introtext')</label>
                        {!! Form::textarea($lang . '[introtext]',  isset($page) && $page->translate($lang) ? $page->translate($lang)->introtext : null ,['class'=>'form-control, ck-editor']) !!}
                    </div>
                    <div class="form-group">
                        <label for="roleName">@lang('backend.description')</label>
                        {!! Form::textarea($lang . '[description]', isset($page) && $page->translate($lang) ? $page->translate($lang)->description : null,['class'=>'form-control, ck-editor']) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clearfix"></div>
</div>